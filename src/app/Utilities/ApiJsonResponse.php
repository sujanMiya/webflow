<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;
use function response;

class ApiJsonResponse
{
    protected int $httpCode = 200;
    protected int $code = 20000;
    protected string $message;
    protected mixed $data;
    protected ?string $details = '';
    protected array $headers = [];

    public function __construct(mixed $data)
    {
        $this->data = $data;
    }

    public function setHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function details(?string $data = ''): self
    {
        $this->details = $data;

        return $this;
    }

    public function setHeaders(array $headers): self
    {
        foreach ($headers as $key => $value) {
            $this->setHeader($key, $value);
        }

        return $this;
    }

    public function success(mixed $message = '', int $httpCode = Response::HTTP_OK, ?int $code = null): JsonResponse
    {

        $this->httpCode = $httpCode;

        /**
         * @var int $code
         */
        $this->code = $code ?? $httpCode * 100;
        $this->message = $message;
        $response = [
            'status' => 'SUCCESS',
            'code' => $this->code,
            'message' => $message,
            'details' => $this->details,
            'locale' => app()->getLocale(),
            'data' => $this->data
        ];

        return response()->json($response, $this->httpCode, $this->headers);
    }

    public function fails(mixed $message = '', int $httpCode = Response::HTTP_BAD_REQUEST, ?int $code = null): JsonResponse
    {
        $this->httpCode = $httpCode;

        /**
         * @var int $code
         */
        $this->code = $code ?? $httpCode * 100;
        $this->message = $message;
        $response = [
            'status' => 'ERROR',
            'code' => $this->code,
            'message' => $message,
            'details' => $this->details,
            'locale' => app()->getLocale(),
            'data' => $this->data
        ];

        return response()->json($response, $this->httpCode, $this->headers);
    }

    /*
     * When we throw exception from api it cause to LCP increase, so we need to handle it
     */
    public function storeFrontFails(mixed $message = '', int $httpCode = Response::HTTP_OK, ?int $code = null): JsonResponse
    {
        $this->httpCode = $httpCode;

        /**
         * @var int $code
         */
        $this->code = $code ?? $httpCode * 100;
        $this->message = $message;
        $response = [
            'status' => 'FAIL',
            'code' => $this->code,
            'message' => $message,
            'details' => $this->details,
            'locale' => app()->getLocale(),
            'data' => $this->data
        ];

        return response()->json($response, $this->httpCode, $this->headers);
    }

    /**
     * @param string|\Exception $exception
     * @param mixed ...$params
     * @throws Throwable
     */
    public function throw(string|\Exception $exception, mixed ...$params): void
    {
        if ($exception instanceof \Exception) {
            throw $exception;
        }

        throw_if(class_exists($exception), $exception, ...$params);
    }

    public function exception(\Exception $exception): JsonResponse
    {
        $code = Response::HTTP_BAD_REQUEST;
        $data = "Something went wrong";
        $details = 'System throw an exception : ' . get_class($exception);

        if (is_object($exception)) {
            $code = (int)$exception->getCode();
            if ($code < 100 || $code > 600) {
                $code = Response::HTTP_BAD_REQUEST;
            }

            $data = get_class($exception) . ' | Something went wrong';
            $message = $exception->getMessage();
            $message = blank($message) ? $data : $message;
        }


        if (app()->environment() != 'production') {
            $data = $exception->getTraceAsString();
        }

        if ($exception instanceof ValidationException) {
            $data = $exception->validator->errors();
            $code = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        $this->data = $data;

        return $this->details($details)->fails($message, $code);
    }
}

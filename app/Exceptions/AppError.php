<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AppError extends Exception
{
    protected $message, $httpCode, $shouldLog, $customMessage;

    public function __construct(string $message, int $httpCode = 400, bool $shouldLog = true, string $customMessage = null)
    {
        $this->message = $message;
        $this->httpCode = $httpCode;
        $this->shouldLog = $shouldLog;
        $this->customMessage = $customMessage;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function getShouldLog(): int
    {
        return $this->shouldLog;
    }

    public function getCustomMessage(): string
    {
        if (is_null($this->customMessage)) {
            return 'Erro do Sistema. Tente novamente mais tarde';
        }

        return $this->customMessage;
    }
}
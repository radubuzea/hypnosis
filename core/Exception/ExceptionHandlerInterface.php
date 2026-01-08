<?php

namespace Hypnosis\Core\Exception;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ExceptionHandlerInterface
{
    /**
     * Handles any exception thrown during the request lifecycle.
     * This component is responsible for converting exceptions into an HTTP response representation.
     */
    public function handle(\Throwable $exception, ServerRequestInterface $request): ResponseInterface;
}
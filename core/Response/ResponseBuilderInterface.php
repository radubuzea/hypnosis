<?php

namespace Hypnosis\Core\Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ResponseBuilderInterface
{
    /**
     * Builds an HTTP response from controller data.
     *
     * This is the only component allowed to create ResponseInterface instances.
     * Representation and formatting logic is centralized here.
     * Any exception thrown here is propagated to the Kernel.
     */
    public function build(mixed $data, ServerRequestInterface $request): ResponseInterface;
}
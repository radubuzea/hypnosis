<?php

namespace Hypnosis\Core\Middleware;

use Psr\Http\Message\ServerRequestInterface;

interface MiddlewarePipelineInterface
{
    /**
     * Processes the request through the configured middleware pipeline.
     * The pipeline must:
     * - Execute middleware in a deterministic order.
     * - Never create or return a Response.
     * - Never interrupt the execution flow.
     * Any exception thrown during processing is propagated to the Kernel.
     */
    public function process(ServerRequestInterface $request): ServerRequestInterface;
}
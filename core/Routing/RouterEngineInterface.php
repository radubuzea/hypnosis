<?php

namespace Hypnosis\Core\Routing;

use Psr\Http\Message\ServerRequestInterface;

interface RouterEngineInterface
{
    /**
     * Resolves the incoming request and executes the matched controller.
     * The returned value represents controller data and must not be an HTTP response.
     * Any exception thrown here is propagated to the Kernel.
     */
    public function dispatch(ServerRequestInterface $request): mixed;
}
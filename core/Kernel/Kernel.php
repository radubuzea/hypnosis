<?php
declare(strict_types=1);

namespace Hypnosis\Core\Kernel;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Hypnosis\Core\Routing\RouterEngineInterface;
use Hypnosis\Core\Middleware\MiddlewarePipelineInterface;
use Hypnosis\Core\Response\ResponseBuilderInterface;
use Hypnosis\Core\Exception\ExceptionHandlerInterface;

final class Kernel
{
    private RouterEngineInterface $router;
    private MiddlewarePipelineInterface $middleware;
    private ResponseBuilderInterface $responseBuilder;
    private ExceptionHandlerInterface $exceptionHandler;

    /**
     * The Kernel coordinates the HTTP request lifecycle.
     *
     * It acts strictly as an orchestrator and must not contain
     * business logic, response formatting, or emission concerns.
     */
    public function __construct(
        RouterEngineInterface $router,
        MiddlewarePipelineInterface $middleware,
        ResponseBuilderInterface $responseBuilder,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $this->router = $router;
        $this->middleware = $middleware;
        $this->responseBuilder = $responseBuilder;
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * Handles an incoming PSR-7 ServerRequest and returns a PSR-7 Response.
     *
     * This is the single public entry point of the Kernel.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            // Pass the request through the middleware pipeline
            $request = $this->middleware->process($request);

            // Resolve routing and execute the matched controller
            $routeResult = $this->router->dispatch($request);

            // Build the final HTTP response from controller data
            return $this->responseBuilder->build($routeResult, $request);
        } catch (\Throwable $exception) {
            // Delegate all errors to the centralized exception handler
            return $this->exceptionHandler->handle($exception, $request);
        }
    }
}
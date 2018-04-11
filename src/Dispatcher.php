<?php
declare(strict_types=1);

namespace Polus\MiddlewareDispatcher\Ellipse;

use Polus\MiddlewareDispatcher\AbstractDispatcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ellipse\Dispatcher as EllipseDispatcher;
use Ellipse\Handlers\Exceptions\MiddlewareTypeException;
use Ellipse\Handlers\FallbackRequestHandler;

class Dispatcher extends AbstractDispatcher
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws MiddlewareTypeException
     */
    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        $dispatcher = new EllipseDispatcher(new FallbackRequestHandler($this->responseFactory->createResponse(404)), $this->middlewares->toArray());
        return $dispatcher->handle($request);
    }
}

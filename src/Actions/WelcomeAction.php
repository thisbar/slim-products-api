<?php

namespace App\Actions;

use App\Actions\Action;
use OpenApi\Annotations as OA;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 *
 * @OA\Get(
 *     path="/",
 *     @OA\Response(
 *      response=200,
 *      description="Index of the Products API.",
 *     )
 * )
 */
final class WelcomeAction extends Action
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * Returns welcome message
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $response->getBody()->write("Welcome to Products API");

        return $response;
    }
}

<?php

namespace App\Actions\Swagger;

use App\Actions\Action;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 *
 * @OA\Get(
 *     path="/api-docs",
 *     summary="Swagger UI for API Docs.",
 *     tags={"api-docs"},
 *     @OA\ExternalDocumentation(
 *      description="Find out more about Swagger",
 *      url="https://swagger.io"
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Swagger UI for API Docs.",
 *      @OA\MediaType(mediaType="text/html", example="")
 *     )
 * )
 */
class ViewSwaggerUIAction extends Action
{
    /**
     * Handle swagger requests
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function __invoke(
        Request $request,
        Response $response,
    ): Response {
        return $this->view->render($response, '/swagger.php');
    }
}

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
 *     path="/api-docs/schema",
 *     summary="Download API Docs Schema (openapi.yaml).",
 *     tags={"api-docs"},
 *     @OA\ExternalDocumentation(
 *      description="Find out more about OpenAPI Specification",
 *      url="https://www.openapis.org/"
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Download API Docs Schema (openapi.yaml).",
 *      @OA\MediaType(mediaType="text/yaml", example="")
 *     )
 * )
 */
class GetSwaggerSchemaAction extends Action
{
    /**
     * Handle swagger requests
     *
     * @param  ServerRequestInterface  $request
     * @param  ResponseInterface  $response
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $newResponse = $response->withHeader('Content-Type', 'application/x-yaml');
        $newResponse->getBody()->write(file_get_contents(PUBLIC_PATH.'/openapi.yaml'));

        return $newResponse;
    }
}

<?php

namespace App\Actions\Swagger;

use App\Actions\Action;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetSwaggerSchemaAction extends Action
{
    /**
     * Handle swagger requests
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $newResponse = $response->withHeader('Content-Type', 'application/x-yaml');
        $newResponse->getBody()->write(file_get_contents(PUBLIC_PATH . '/openapi.yaml'));

        return $newResponse;
    }
}

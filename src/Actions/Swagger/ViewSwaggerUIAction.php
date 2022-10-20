<?php

namespace App\Actions\Swagger;

use App\Actions\Action;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

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

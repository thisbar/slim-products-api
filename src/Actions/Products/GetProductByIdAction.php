<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use OpenApi\Annotations as OA;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 *
 * @OA\Get(
 *     path="/products/{id}",
 *     summary="Return a product by ID.",
 *     tags={"products"},
 *     @OA\PathParameter(
 *      ref="#/components/parameters/ProductID",
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Return one product.",
 *       @OA\JsonContent(ref="#/components/schemas/Product", ),
 *     ),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 * )
 */
class GetProductByIdAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var \App\Entities\ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * Returns welcome message
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, int $id = null): Response
    {
        /**
         * Product domain
         *
         * @var \App\Entities\Product
         */
        $product = $this->productRepository->getById($id);

        $response->getBody()->write($product->toJSON());
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}

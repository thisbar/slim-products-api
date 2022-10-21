<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use OpenApi\Annotations as OA;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 *
 * @OA\Delete(
 *     path="/deleteProduct/{id}",
 *     summary="Delete a product.",
 *     tags={"products"},
 *     @OA\PathParameter(
 *      ref="#/components/parameters/ProductID",
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Product deleted successfully by ID.",
 *       @OA\JsonContent(example="Product deleted successfully"),
 *     ),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 * )
 */
class DeleteProductAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    public function __invoke(Request $request, Response $response, $id): Response
    {
        /**
         * Product domain
         *
         * @var \App\Entities\Product
         */
        $this->productRepository->destroy($id);

        $response->getBody()->write("Product deleted successfully");

        return $response;
    }
}

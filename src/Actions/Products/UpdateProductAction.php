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
 * @OA\Put(
 *     path="/updateProduct/{id}",
 *     summary="Updates all fields of a product by ID.",
 *     tags={"products"},
 *     @OA\PathParameter(
 *      ref="#/components/parameters/ProductID",
 *     ),
 *     @OA\RequestBody(
 *      required=true,
 *      @OA\JsonContent(ref="#/components/schemas/Product"),
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Product updated successfully by ID.",
 *       @OA\JsonContent(example="Product created successfully"),
 *     ),
 *     @OA\Response(response=400, ref="#/components/responses/BadRequest"),
 *     @OA\Response(response=404, ref="#/components/responses/NotFound"),
 * )
 */
class UpdateProductAction extends Action
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
        $data = $request->getParsedBody();

        $this->productRepository->update($id, $data);

        $response->getBody()->write("Product update succesfully");

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}

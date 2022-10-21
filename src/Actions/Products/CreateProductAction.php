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
 * @OA\Post(
 *     path="/createProduct",
 *     summary="Create a new product.",
 *     tags={"products"},
 *     @OA\RequestBody(
 *      required=true,
 *      @OA\JsonContent(ref="#/components/schemas/Product"),
 *     ),
 *     @OA\Response(
 *      response=201,
 *      description="Product deleted successfully by ID.",
 *       @OA\JsonContent(example="Product created successfully"),
 *     ),
 *     @OA\Response(response=400, ref="#/components/responses/BadRequest"),
 * )
 */
class CreateProductAction extends Action
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

    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $this->productRepository->create($data);

        $response->getBody()->write("Product created successfully");

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}

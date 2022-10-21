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
 *     path="/search",
 *     summary="Search products by a set of criteria.",
 *     tags={"products"},
 *     @OA\Parameter(ref="#components/parameters/Offset"),
 *     @OA\Parameter(ref="#components/parameters/Limit"),
 *     @OA\RequestBody(
 *      required=true,
 *       @OA\JsonContent(
 *         anyOf={
 *            @OA\Schema(ref="#/components/schemas/Product"),
 *         },
 *        examples={
 *          @OA\Examples(example="One field", value={"slug":"laptop-15"}),
 *          @OA\Examples(
 *              example="multiple fields",
 *              summary="With multiple fields the search will be more accurate.",
 *              value={"name": "laptop", "slug":"laptop-15"})
 *        }
 *       )
 *     ),
 *     @OA\Response(
 *      response=200,
 *      description="Return results of the search.",
 *      @OA\JsonContent(
 *          type="array",
 *          @OA\Items(
 *              ref="#/components/schemas/Product"
 *          )
 *      )
 *     ),
 *     @OA\Response(response=400, ref="#/components/responses/BadRequest"),
 * )
 */
class SearchProductAction extends Action
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

        $products = $this->productRepository->getByQuery($data);

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}

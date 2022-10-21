<?php



namespace App;

use Dotenv\Dotenv;
use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge;
use Doctrine\ORM\EntityManager;
use App\Providers\DoctrineProvider;
use App\Providers\ViewProvider;
use Odan\Session\PhpSession;
use Odan\Session\SessionInterface;
use OpenApi\Annotations as OA;
use Psr\Container\ContainerInterface;
use Slim\App;

/**
 * @OA\OpenApi(
 *    @OA\Info(
 *       title="Products API",
 *       version="1.0.0",
 *       summary="This is API is for the Products service.",
 *       description="This API allows to manipulate the products of the ecommerce.",
 *       @OA\Contact(
 *         name="API Support",
 *         url="https://shop.lautaroaguirre.com",
 *         email="api.shop@lautaroaguirre.com"
 *       ),
 *       @OA\License(
 *          name="Apache 2.0",
 *          url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *       )
 *    ),
 *    @OA\Server(
 *      description="Development server",
 *      url="https://localhost:8080/v1"
 *    ),
 *    @OA\Server(
 *      description="Production server",
 *      url="https://shop.lautaroaguirre.com/v1"
 *    ),
 *    @OA\Tag(name="products", description="Operations to create, read, update and delete Products."),
 *    @OA\Tag(name="api-docs", description="Endpoints of documentation of this API.",
 *     @OA\ExternalDocumentation(
 *      description="Find out more about Swagger and OpenAPI",
 *      url="https://swagger.io"
 *     )
 *    ),
 *    @OA\Tag(name="default", description="Miscellaneous routes."),
 * )
 */
class Application
{
    protected $container;

    protected $session;

    public App $application;

    public function __construct()
    {

        $config = Dotenv::createImmutable(
            APP_ROOT . DIRECTORY_SEPARATOR . '..'
        );

        $config->load();

        $builder = new ContainerBuilder();

        $this->container = $builder->build();

        $this->container->set('settings', $this->includeSettings());

        $this->container->set(
            SessionInterface::class,
            function (ContainerInterface $container) {
                $settings = $container->get('settings');
                $this->session = new PhpSession();
                $this->session->setOptions((array)$settings['session']);

                return $this->session;
            }
        );

        $this->container->set('session', $this->session);

        $this->container->set('view', ViewProvider::provide(null));

        $this->container->set(
            EntityManager::class,
            DoctrineProvider::provide($this->container)
        );

        $this->application = Bridge::create($this->container);
    }

    public function includeSettings(): array
    {
        return include __DIR__ . '/config/settings.php';
    }
}


<?php
namespace App\BlogModule;

use App\BlogModule\Controller\BlogModuleController;
use App\BlogModule\Controller\CategoryController;
use App\BlogModule\Entity\Post;
use App\BlogModule\Entity\Category;
use App\BlogModule\Table\CategoriesTable;
use App\BlogModule\Table\PostsTable;
use Cake\ORM\TableRegistry;
use Core\ApplicationInterface;
use Core\Router\Router;
use function DI\add;


/**
 * Class Application
 */
class Application implements ApplicationInterface
{

    /**
     * @return array
     */
    public function entites(): array
    {
        return [Post::class, Category::class];
    }

    /**
     * @param Router $router
     */
    public function getRoutes(Router $router): void
    {
        $router->get('/BlogModule', [BlogModuleController::class, 'index'], 'BlogModule.index');
        $router->get('/BlogModule/new', [BlogModuleController::class, 'create'], 'BlogModule.new');
        $router->get('/BlogModule/list', [BlogModuleController::class, 'listToArticles'], 'BlogModule.list.articles');
        $router->get('/BlogModule/{slug}', [BlogModuleController::class, 'show'], 'BlogModule.show');
        $router->post('/BlogModule/new', [BlogModuleController::class, 'create']);
        $router->get('/BlogModule/editer/{id}', [BlogModuleController::class, 'update'], 'BlogModule.update');
        $router->post('/BlogModule/editer/{id}', [BlogModuleController::class, 'update']);
        $router->post('/BlogModule/delete/{id}', [BlogModuleController::class, 'delete'], 'BlogModule.delete');
        $router->get('/BlogModule/categorie/new', [CategoryController::class, 'create'], 'BlogModule.category.new');
        $router->post('/BlogModule/categorie/new', [CategoryController::class, 'create']);
    }

    /**
     * Pour ajouter la configuration au container de son application
     *
     * @return array
     */
    public function addConfig(): array
    {
        return [
            'twig.path' => add([
                'BlogModule' => __DIR__ . '/views/'
            ]),
            'entities' => add([
                Post::class,
                Category::class
            ]),
            PostsTable::class => function ()  {
                return TableRegistry::get('Posts', ['className' => PostsTable::class]);
            },
            CategoriesTable::class => function ()  {
                return TableRegistry::get('Categories', ['className' => CategoriesTable::class]);
            }
        ];
    }

    public function getName(): string
    {
        return str_replace('\\Application', '', get_class($this));
    }
}
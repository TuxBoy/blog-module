<?php
namespace App\Blog\Controller;

use Core\Builder\Builder;
use Core\Controller\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Blog\Entity\Category;
use App\Blog\Repository\CategoryRepository;

class CategoryController extends Controller
{

    public function create(Request $request, CategoryRepository $categoryRepository)
    {
        if ($request->getMethod() === 'POST') {
            $data = $this->getParams($request, ['name', 'slug']);
            $category = Builder::create(Category::class, [$data]);
            $categoryRepository->insert($category);
            return $this->redirectTo('/');
        }
        return $this->twig->render('blog/category/create.twig');
    }

}
<?php

namespace App\Controllers;

use App\Models\Category;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

use App\Middleware\Authenticate;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $request = new \Core\Http\Request();
        (new Authenticate())->handle($request);
    }

    public function index(Request $request): void
    {
        $categories = Category::all();

        if ($request->acceptJson()) {
            $this->renderJson('categories/index', compact('categories'));
        } else {
            $this->render('categories/index', compact('categories'));
        }
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();
        $category = Category::findById($params['id']);

        if (!$category) {
            $this->redirectBack();
            return;
        }

        $this->redirectTo(route('subcategories.index', ['category_id' => $category->id]));
    }
}

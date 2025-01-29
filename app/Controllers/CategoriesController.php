<?php

namespace App\Controllers;

use App\Models\Category;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class CategoriesController extends Controller
{
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

        $subcategories = $category->subcategories;

        $this->render('subcategories/index', compact('category', 'subcategories'));
    }
}

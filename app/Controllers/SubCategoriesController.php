<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class SubCategoriesController extends Controller
{
    public function index(Request $request): void
    {
        $categoryId = $request->getParam('category_id');
        $category = Category::findById($categoryId);

        $subcategories = $category->subcategories;

        if ($request->acceptJson()) {
            $this->renderJson('subcategories/index', compact('subcategories', 'category'));
        } else {
            $this->render('subcategories/index', compact('subcategories', 'category'));
        }
    }

    public function new(Request $request): void
    {
        $categoryId = $request->getParam('category_id');
        $subcategory = new SubCategory();

        $this->render('subcategories/new', compact('subcategory', 'categoryId'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $subcategory = new SubCategory($params['subcategory']);
        $categoryId = $params['subcategory']['category_id'];

        if ($subcategory->validates()) {
            FlashMessage::danger('Existem dados incorretos! Por favor, verificar!');
            $this->render('subcategories/new', compact('subcategory', 'categoryId'));
            return;
        }

        if ($subcategory->save()) {
            FlashMessage::success('Categoria adiciona com sucesso!');
            $this->redirectTo(route('subcategories.index', ['category_id' => $categoryId]));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
            $this->render('subcategories/new', compact('subcategory'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $subcategory = SubCategory::findById($params['id']);
        if ($subcategory) {
            $categoryId = $subcategory->category_id;
            $subcategory->destroy();
        }

        FlashMessage::success('Categoria removida com sucesso!');
        $this->redirectTo(route('subcategories.index', ['category_id' => $categoryId]));
    }
}
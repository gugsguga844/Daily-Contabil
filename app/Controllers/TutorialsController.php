<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tutorial;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class TutorialsController extends Controller
{
    public function index(Request $request): void
    {
        $subcategoryId = $request->getParam('subcategory_id');
        $subcategory = SubCategory::findById($subcategoryId);

        $tutorials = $subcategory->tutorials;

        if ($request->acceptJson()) {
            $this->renderJson('tutorials/index', compact('tutorials', 'subcategory'));
        } else {
            $this->render('tutorials/index', compact('tutorials', 'subcategory'));
        }
    }
}

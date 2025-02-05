<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\TagTutorialFilter;
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

    public function show(Request $request): void
    {
        $params = $request->getParams();
        $tutorial = Tutorial::findById($params['id']);

        if (!$tutorial) {
            FlashMessage::danger('Tutorial não encontrado!');
            $this->redirectTo(route('tutorials.index'));
            return;
        }

        $tags = $tutorial->tutorial_tags;

        $this->render('tutorials/show', compact('tutorial', 'tags'));
    }

    public function new(Request $request): void
    {
        $subcategoryId = $request->getParam('subcategory_id');
        $tutorial = new Tutorial();
        $tags = Tag::all();

        $this->render('tutorials/new', compact('tutorial', 'subcategoryId', 'tags'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $tutorial = new Tutorial($params['tutorial']);
        $subcategoryId = $params['tutorial']['subcategory_id'];

        if ($tutorial->validates()) {
            FlashMessage::danger('Existem dados incorretos! Por favor, verificar!');
            $tags = Tag::all();
            $this->render('tutorials/new', compact('tutorial', 'subcategoryId', 'tags'));
            return;
        }

        if ($tutorial->save()) {
            if (!empty($params['tags'])) {
                foreach ($params['tags'] as $tagId) {
                    $tagTutorial = new TagTutorialFilter([
                        'tag_id' => $tagId,
                        'tutorial_id' => $tutorial->id
                    ]);
                    $tagTutorial->save();
                }
            }

            FlashMessage::success('Vídeo adicionado com sucesso!');

            $subcategory = SubCategory::findById($subcategoryId);
            $categoryId = $subcategory->category_id;
            $this->redirectTo(route('subcategories.index', ['category_id' => $categoryId]));
        } else {
            FlashMessage::danger('Existem dados incorretos! Por favor verifique!');
            $tags = Tag::all();
            $this->render('tutorials/new', compact('tutorial', 'subcategoryId', 'tags'));
        }
    }
}

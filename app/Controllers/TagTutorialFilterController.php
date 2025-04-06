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

class TagTutorialFilterController extends Controller
{
    public function destroy(Request $request): void
    {
        $params = $request->getParams();

        $tagTutorial = TagTutorialFilter::findBy([
            'tutorial_id' => $params['tutorial_id'],
            'tag_id' => $params['id']
        ]);

        $tagTutorial->destroy();
        FlashMessage::success('Tag removida com sucesso!');
        
        $this->redirectBack();
    }
}
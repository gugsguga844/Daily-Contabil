<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class TutorialsController extends Controller
{
    public function index(Request $request): void
    {
        $title = 'Tutorials';
        $this->render('tutorials/index', compact('title'));
    }
}
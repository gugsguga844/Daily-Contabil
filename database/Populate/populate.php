<?php

require __DIR__ . '/../../config/bootstrap.php';

use Core\Database\Database;
use Database\Populate\CategoriesPopulate;
use Database\Populate\SubCategoriesPopulate;
use Database\Populate\TutorialsPopulate;
use Database\Populate\UsersPopulate;

Database::migrate();

UsersPopulate::populate();
CategoriesPopulate::populate();
SubCategoriesPopulate::populate();
TutorialsPopulate::populate();
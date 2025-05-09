<?php

namespace Database\Populate;

use App\Models\Category;

class CategoriesPopulate
{
    public static function populate()
    {
        $data =  [
            'name' => 'Fiscal',
        ];
    
        $category = new Category($data);
        $category->save();

        $data =  [
            'name' => 'Contábil'
        ];

        $category = new Category($data);
        $category->save();

        $data =  [
            'name' => 'Diversos'
        ];

        $category = new Category($data);
        $category->save();

        $data =  [
            'name' => 'Trabalhista'
        ];

        $category = new Category($data);
        $category->save();

        $data =  [
            'name' => 'MEI'
        ];

        $category = new Category($data);
        $category->save();

        $numberOfCategories = 5;

        echo "Categories populated with $numberOfCategories registers\n";
    }
}
<?php

namespace Database\Populate;

use App\Models\SubCategory;

class SubCategoriesPopulate
{
    public static function populate()
    {
        $data =  [
            'name' => 'Extrato',
            'category_id' => 1
        ];
    
        $subcategory = new SubCategory($data);
        $subcategory->save();

        $data =  [
            'name' => 'Parcelamentos',
            'category_id' => 1
        ];

        $subcategory = new SubCategory($data);
        $subcategory->save();

        $data =  [
            'name' => 'Relatorios',
            'category_id' => 2
        ];

        $subcategory = new SubCategory($data);
        $subcategory->save();

        $numberOfSubCategories = 3;

        echo "SubCategories populated with $numberOfSubCategories registers\n";
    }
}
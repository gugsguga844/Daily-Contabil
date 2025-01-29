<?php

namespace Database\Populate;

use App\Models\Tutorial;

class TutorialsPopulate
{
    public static function populate()
    {
        $data =  [
            'title' => 'Primeiro Video',
            'description' => 'Fiscal',
            'link' => 'Fiscal',
            'recorded_at' => 'Fiscal',
            'subcategory_id' => 1
        ];
    
        $tutorial = new Tutorial($data);
        $tutorial->save();

        $data =  [
            'title' => 'Terceiro Video',
            'description' => 'Fiscal',
            'link' => 'Fiscal',
            'recorded_at' => 'Fiscal',
            'subcategory_id' => 1
        ];
    
        $tutorial = new Tutorial($data);
        $tutorial->save();

        $data =  [
            'title' => 'Segundo Video',
            'description' => 'Fiscal',
            'link' => 'Fiscal',
            'recorded_at' => 'Fiscal',
            'subcategory_id' => 2
        ];

        $tutorial = new Tutorial($data);
        $tutorial->save();

        $numberOfCategories = 2;

        echo "Tutorials populated with $numberOfCategories registers\n";
    }
}
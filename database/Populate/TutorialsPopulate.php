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
            'link' => 'https://www.youtube.com/embed/3zorNV-5Mac?si=qIvz2GZvfNmjYjTx',
            'recorded_at' => '02/04/2025',
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
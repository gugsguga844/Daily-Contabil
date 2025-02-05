<?php

namespace Database\Populate;

use App\Models\Tag;

class TagsPopulate
{
    public static function populate()
    {
        $data =  [
            'name' => 'Tag One',
        ];
        $tag = new Tag($data);
        $tag->save();

        $data =  [
            'name' => 'Tag Two',
        ];
        $tag = new Tag($data);
        $tag->save();

        $data =  [
            'name' => 'Tag Three',
        ];
        $tag = new Tag($data);
        $tag->save();

        $numberOfTags = 5;

        for ($i = 1; $i < $numberOfTags; $i++) {
            $data =  [
                'name' => 'Tag ' . $i,
            ];

            $tag = new Tag($data);
            $tag->save();
        }

        echo "Tags populated with $numberOfTags registers\n";
    }
}
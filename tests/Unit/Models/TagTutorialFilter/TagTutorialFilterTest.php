<?php

namespace Tests\Unit\Models\TagTutorialFilter;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Tutorial;
use App\Models\TagTutorialFilter;
use Tests\TestCase;

class TagTutorialFilterTest extends TestCase
{
    private Tag $tag;
    private Tutorial $tutorial;
    private TagTutorialFilter $tagTutorial;
    private Category $category;
    private SubCategory $subcategory;

    public function setUp(): void
    {
        parent::setUp();

        $this->tag = new Tag([
            'name' => 'Tag One'
        ]);

        $this->tag->save();

        $this->category = new Category([
            'name' => 'Contabil'
        ]);
        $this->category->save();

        $this->subcategory = new SubCategory([
            'name' => 'Parcelamentos',
            'category_id' => $this->category->id
        ]);
        $this->subcategory->save();

        $this->tutorial = new Tutorial([
            'title' => 'Tutorial One',
            'description' => 'Tutorial One',
            'link' => 'Tutorial One',
            'recorded_at' => 'Tutorial One',
            'subcategory_id' => 1,
        ]);
        $this->tutorial->save();

        $this->tagTutorial = new TagTutorialFilter([
            'tag_id' => $this->tag->id,
            'tutorial_id' => $this->tutorial->id
        ]);
        $this->tagTutorial->save();
    }

    public function test_tagtutorialfilter_should_have_both_ids(): void
    {
        $getId = TagTutorialFilter::findById($this->tagTutorial->id);
        $this->assertNotNull($getId, 'Não encontrado');
    }
}

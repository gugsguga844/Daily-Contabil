<?php

namespace Tests\Unit\Models\SubCategories;

use App\Models\SubCategory;
use App\Models\Category;
use Tests\TestCase;

class SubCategoryTest extends TestCase
{
    private Category $category;
    private SubCategory $subcategory;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = new Category([
            'name' => 'Contabil'
        ]);
        $this->category->save();

        $this->subcategory = new SubCategory([
            'name' => 'Parcelamentos',
            'category_id' => $this->category->id
        ]);
        $this->subcategory->save();

        $this->subcategory = new SubCategory([
            'name' => 'Extratos',
            'category_id' => $this->category->id
        ]);
        $this->subcategory->save();
    }

    public function test_subcategory_should_have_category_id(): void
    {
        $getId = SubCategory::findById($this->subcategory->id);
        $this->assertEquals($this->category->id, $getId->category_id);
    }

    public function test_destroy_category_should_remove_the_subcategory(): void
    {
        $this->category->destroy();
        $this->assertEquals(0, count(SubCategory::all()));
    }

    public function test_category_should_list_its_subcategories(): void
    {
        $getCategory = Category::findById($this->category->id);
        $this->assertCount(2, $getCategory->subcategories);
    }
}

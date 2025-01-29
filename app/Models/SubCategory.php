<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property Category $category
 * @property Tutorial[] $tutorials
 */

class SubCategory extends Model
{
    protected static string $table = 'subcategories';
    protected static array $columns = ['name', 'category_id'];

    public function tutorials(): HasMany
    {
        return $this->hasMany(Tutorial::class, 'subcategory_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function validates(): void
    {
    }
}

<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 */

class Category extends Model
{
    protected static string $table = 'categories';
    protected static array $columns = ['name'];

    public function subcategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function validates(): void
    {

    }
}
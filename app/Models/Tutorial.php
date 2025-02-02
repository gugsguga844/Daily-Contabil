<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $recorded_at
 * @property int $subcategory_id
 * @property SubCategory $subcategory
 */
class Tutorial extends Model
{
    protected static string $table = 'tutorials';
    protected static array $columns = ['title', 'description', 'link', 'recorded_at', 'subcategory_id'];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function validates(): void
    {
    }

    public static function findById(int $id): ?static
    {
        return Tutorial::findBy(['id' => $id]);
    }
}

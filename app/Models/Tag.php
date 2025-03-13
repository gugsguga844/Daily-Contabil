<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property Tutorial[] $tag_tutorials
 */

class Tag extends Model
{
    protected static string $table = 'tags';
    protected static array $columns = ['name'];

    public function tagTutorials(): BelongsToMany
    {
        return $this->belongsToMany(Tutorial::class, 'tag_tutorial_filter', 'tag_id', 'tutorial_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
    }

    public static function findById(int $id): ?static
    {
        return Tag::findBy(['id' => $id]);
    }
}

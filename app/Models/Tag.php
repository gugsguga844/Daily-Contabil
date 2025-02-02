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

class Tag extends Model
{
    protected static string $table = 'tags';
    protected static array $columns = ['name'];

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
    }

    public static function findById(int $id): ?static
    {
        return Tag::findBy(['id' => $id]);
    }
}

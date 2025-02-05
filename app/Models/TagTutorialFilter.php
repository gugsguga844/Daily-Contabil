<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $tag_id
 * @property int $tutorial_id
 */
class TagTutorialFilter extends Model
{
    protected static string $table = 'tag_tutorial_filter';
    protected static array $columns = ['tag_id', 'tutorial_id'];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function tutorial(): BelongsTo
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }

    public function validates(): void
    {
        Validations::uniqueness(['tag_id', 'tutorial_id'], $this);
    }
}

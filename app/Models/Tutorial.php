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
 * @property Tag[] $tutorial_tags
 */
class Tutorial extends Model
{
    protected static string $table = 'tutorials';
    protected static array $columns = ['title', 'description', 'link', 'recorded_at', 'subcategory_id'];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function tutorialTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_tutorial_filter', 'tutorial_id', 'tag_id');
    }

    public function validates(): void
    {
    }

    public static function findById(int $id): ?static
    {
        return Tutorial::findBy(['id' => $id]);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, TagTutorialFilter::class, 'tutorial_id', 'tag_id');
    }

}

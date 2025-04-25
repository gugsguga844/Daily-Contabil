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
 * @property string $participation
 * @property string $qualification
 * @property string $cpf
 * @property string $phone
 * @property string $email
 * @property int $company_id
 * @property Company $company
 */

class Associate extends Model
{
    protected static string $table = 'associates';
    protected static array $columns = [
        'name',
        'qualification',
        'participation',
        'cpf',
        'phone',
        'email',
        'company_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
        Validations::notEmpty('qualification', $this);
        Validations::notEmpty('participation', $this);
        Validations::notEmpty('cpf', $this);
        Validations::notEmpty('company_id', $this);
    }

    public static function findById(int $id): ?static
    {
        return Associate::findBy(['id' => $id]);
    }
}

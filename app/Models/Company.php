<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsToMany;
use Core\Database\ActiveRecord\HasMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $fantasy_name
 * @property string $cnpj
 * @property string $phone
 * @property string $tax_framework
 * @property string $description
 * @property string $link
 * @property string $status
 * @property string $accounting_fees
 * @property string $state_registration
 * @property string $recorded_at
 */

class Company extends Model
{
    protected static string $table = 'companies';
    protected static array $columns = ['name', 'fantasy_name', 'cnpj', 'phone', 'tax_framework', 'description', 'link', 'responsible', 'status', 'accounting_fees', 'state_registration', 'recorded_at'];

    public function associates(): HasMany
    {
        return $this->hasMany(Associate::class, 'company_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('name', $this);
    }

    public static function findById(int $id): ?static
    {
        return Company::findBy(['id' => $id]);
    }

    public function delete(): bool
    {
        // Primeiro, excluir todos os sócios associados
        $associates = $this->associates()->get();
        foreach ($associates as $associate) {
            $associate->destroy();
        }

        // Depois, excluir a empresa
        return $this->destroy();
    }
}
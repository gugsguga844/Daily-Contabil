<?php

namespace Lib;

use Core\Database\Database;
use PDO;

class Validations
{
    public static function notEmpty($attribute, $obj)
    {
        if ($obj->$attribute === null || $obj->$attribute === '') {
            $obj->addError($attribute, 'não pode ser vazio!');
            return false;
        }

        return true;
    }

    public static function passwordConfirmation($obj)
    {
        if ($obj->password !== $obj->password_confirmation) {
            $obj->addError('password', 'as senhas devem ser idênticas!');
            return false;
        }

        return true;
    }

    public static function uniqueness($fields, $object)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        $table = $object::table();
        $conditions = implode(' AND ', array_map(fn ($field) => "{$field} = :{$field}", $fields));
        if (!$object->newRecord()) {
            $conditions .= " AND id != :current_id";
        }

        $sql = <<<SQL
            SELECT id FROM {$table} WHERE {$conditions};
        SQL;

        $pdo = Database::getDatabaseConn();
        $stmt = $pdo->prepare($sql);

        foreach ($fields as $field) {
            $stmt->bindValue($field, $object->$field);
        }

        if (!$object->newRecord()) {
            $stmt->bindValue('current_id', $object->id, PDO::PARAM_INT);
        }

        $stmt->execute();

        if ($stmt->rowCount() !== 0) {
            foreach ($fields as $field) {
                $object->addError($field, 'já existe um registro com esse dado');
            }
            return false;
        }

        return true;
    }
}

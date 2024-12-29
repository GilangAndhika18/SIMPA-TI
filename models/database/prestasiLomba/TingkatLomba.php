<?php

namespace app\models\database\prestasiLomba;

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseModel;

class TingkatLomba extends BaseModel
{
    public const TABLE = "tingkat_lomba";
    public const ID = "id";
    public const TINGKAT_LOMBA = "tingkat_lomba";
    public const SKOR = "skor";

    public static function insert(array $data): array
    {
        return Schema::insertInto(self::TABLE, function (Blueprint $table) use ($data) {
            $table->insert([self::ID,self::TINGKAT_LOMBA,self::SKOR], $data);
            
        });
    }
        public static function displayTingkatLomba():array
    {
        return Schema::selectFrom(self::TABLE, function (Blueprint $table) {
            $table->select();
        });
    }

    public static function updateTingkatLomba($value, string $columnWhere, string $where): array
    {
        return Schema::update(self::TABLE, function (Blueprint $table) use ($value, $columnWhere, $where) {
            $table->update(self::SKOR, $value, $columnWhere, $where);
        });
    }

    public static function find(string $column, $value): array
    {
        return Schema::selectWhereFrom(self::TABLE, function (Blueprint $table) use ($column, $value) {
            $table->selectWhere([$column => $value], [self::ID, self::TINGKAT_LOMBA, self::SKOR]);
        });
    }

    public static function deleteData($id): array
    {
        return Schema::query("DELETE FROM " . self::TABLE . " WHERE " . self::ID . " = '$id';");
    }

    public static function deleteAll(): array
    {
        return Schema::deleteFrom(self::TABLE);
    }
}

?>

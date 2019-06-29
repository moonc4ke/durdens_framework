<?php

namespace Core\database;

use Exception;
use PDOException;

class Model extends abstracts\Model
{

    public function create()
    {
        $SQL_columns = [];

        foreach ($this->fields as $field) {
            $SQL_columns[] = strtr('@col_name @col_type @col_flags', [
                '@col_name' => SQLBuilder::column($field['name']),
                '@col_type' => $field['type'],
                '@col_flags' => isset($field['flags']) ? implode(' ', $field['flags']) : ''
            ]);
        }

        $sql = strtr('CREATE TABLE @table_name (@columns);', [
            '@table_name' => SQLBuilder::table($this->table_name),
            '@columns' => implode(', ', $SQL_columns)
        ]);

        try {
            return $this->pdo->exec($sql);
        } catch (\PDOException $e) {
            throw new Exception(
                strtr('Framework database error: Failed to create table: @e',
                    ['@e' => $e->getMessage()
                    ])
            );
        }
    }

    public function insert($row)
    {
        $row_columns = array_keys($row);
        $sql = strtr("INSERT INTO @table (@col) VALUES (@val)", [
            '@table' => SQLBuilder::table($this->table_name),
            '@col' => SQLBuilder::columns($row_columns),
            '@val' => SQLBuilder::binds($row_columns)
        ]);
        $query = $this->pdo->prepare($sql);

        foreach ($row as $key => $value) {
            $query->bindValue(SQLBuilder::bind($key), $value);
        }

        try {
            $query->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception(
                strtr('Framework database error: Failed to insert to table: @e',
                    ['@e' => $e->getMessage()
                    ])
            );
        }
    }

    public function insertIfNotExists($row, $unique_columns)
    {
        $load_conditions = [];

        foreach ($unique_columns as $column) {
            $load_conditions[$column] = $row[$column];
        }

        if (!$this->load($load_conditions)) {
            return $this->insert($row);
        }

        return false;
    }

    public function update($row = [], $conditions = [])
    {
        $row_columns = array_keys($row);
        $cond_columns = array_keys($conditions);

        if ($conditions) {
            $sql = strtr("UPDATE @table SET @col WHERE @condition", [
                '@table' => SQLBuilder::table($this->table_name),
                '@col' => SQLBuilder::columnsEqualBinds($row_columns),
                '@condition' => SQLBuilder::columnsEqualBinds($cond_columns, ' AND ', 'c_'),
            ]);
        } else {
            $sql = strtr("UPDATE @table SET @col", [
                '@table' => SQLBuilder::table($this->table_name),
                '@col' => SQLBuilder::columnsEqualBinds($row_columns)
            ]);
        }

        $query = $this->pdo->prepare($sql);

        foreach ($row as $row_key => $row_value) {
            $query->bindValue(SQLBuilder::bind($row_key), $row_value);
        }

        foreach ($conditions as $condition_idx => $condition) {
            $query->bindValue(SQLBuilder::bind($condition_idx, 'c_'), $condition);
        }

        try {
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception(
                strtr('Framework database error: Failed to update table: @e',
                    ['@e' => $e->getMessage()
                    ])
            );
        }
    }

    public function delete($conditions = [])
    {
        if ($conditions) {
            $cond_columns = array_keys($conditions);

            $sql = strtr("DELETE FROM @table WHERE @condition", [
                '@table' => SQLBuilder::table($this->table_name),
                '@condition' => SQLBuilder::columnsEqualBinds($cond_columns, ' AND '),
            ]);
        } else {
            $sql = strtr("DELETE FROM @table", [
                '@table' => SQLBuilder::table($this->table_name),
            ]);
        }

        $query = $this->pdo->prepare($sql);

        foreach ($conditions as $condition_idx => $condition) {
            $query->bindValue(SQLBuilder::bind($condition_idx), $condition);
        }

        try {
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception(
                strtr('Framework database error: Failed to delete from table: @e',
                    ['@e' => $e->getMessage()
                    ])
            );
        }
    }

}
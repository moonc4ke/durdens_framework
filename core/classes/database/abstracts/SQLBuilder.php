<?php

namespace Core\database\abstracts;

/**
 * Description of SQLBuilder
 *
 * @author Dainius blt
 */
abstract class SQLBuilder
{

    /**
     * Returns $column, but surrounded with backticks
     *
     * @param string $column column 1
     * @return string `column 1`
     */
    abstract public static function column($column): string;

    /**
     * Returns imploded array of backticked columns
     *
     * @param array $column_array ['column 1', 'column 2', ...]
     * @return string `column 1`, `column 2`, `column 2`
     */
    abstract public static function columns($column_array): string;

    /**
     * Returns bind placeholder syntax for a column
     *
     * If column name contains a space,
     * it replaces it to underscore
     *
     * @param string $column column 1
     * @return string :column_1
     */
    abstract public static function bind($column): string;

    /**
     * Returns an imploded array of column bind placeholders
     *
     * @param array $column_array ['column 1', 'column 2', ...]
     * @return string :column_1, :column_2, :column_3
     */
    abstract public static function binds($column_array): string;

    /**
     * Returns backticked column name equaled to a bind placeholder
     *
     * @param string $column column 1
     * @return string `column 1`=:column_1
     */
    abstract public static function columnEqualBind($column): string;

    /**
     * Returns an imploded array of column names
     * equaled to bind placeholders
     *
     * @param array $column_array ['column 1', 'column 2', ...]
     * @param string $delimiter Can be changed to 'AND', 'OR', etc...
     * @return string `column 1`=:column_1, `column 2`=:column_2,
     */
    abstract public static function columnsEqualBinds($column_array, $delimiter = ', '): string;

    /**
     * Returns a single quoted value
     *
     * @param string $value some value
     * @return string 'some value'
     */
    abstract public static function value($value): string;

    /**
     * Returns an imploded array of
     * single quoted values
     *
     * @param array $value_array ['value 1', 'value 2', ...]
     * @return string 'value 1', 'value 2'
     */
    abstract public static function values($value_array): string;

}

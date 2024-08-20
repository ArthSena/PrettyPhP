<?php namespace Illuminate\Database\Builder\Syntax\Query;

use Illuminate\Database\Factory\Syntax\Query\Insert;

class InsertBuilder {

    /**
     * Builds an SQL INSERT query string from the given Insert object.
     *
     * @param Insert $insert The Insert object containing the table name, columns, and values to be inserted.
     * 
     * @return string The SQL INSERT query string.
     */
    public static function build(Insert $insert): string {
        $query = "INSERT ";

        $query .= " INTO " . $insert->getTable()->getName();

        $query .= " (" . implode(", ", $insert->getColumns()) . ") ";
        $query .= " VALUES ";
        $query .= "(" . implode(", ", array_map(fn($value) => is_string($value) ? "'{$value}'" : $value, $insert->getValues())) . ")";
        $query .= ";";

        return $query;
    }

}
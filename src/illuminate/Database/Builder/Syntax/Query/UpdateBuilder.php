<?php namespace Illuminate\Database\Builder\Syntax\Query;

use Illuminate\Database\Builder\Syntax\WhereBuilder;
use Illuminate\Database\Factory\Syntax\Query\Update;

class UpdateBuilder {

    /**
     * Builds an UPDATE SQL query string from an Update object.
     *
     * @param Update $update The Update object containing the table name, columns, values, and optional WHERE clause.
     * 
     * @return string The constructed UPDATE SQL query string.
     */
    public static function build(Update $update): string {
        $query = "UPDATE ";

        $query .= $update->getTable()->getName();

        $query .= " SET ";

        $columns = $update->getColumns();
        $values = $update->getValues();

        for($i = 0; $i < count($columns); $i++) {
            $query.= $columns[$i]. " = ". (is_string($values[$i]) ? "'" . $values[$i] . "'" : $values[$i]);
            if($i < count($columns) - 1) $query.= ", ";
        }

        if($update->getWhere()->has())
            $query .= " " . WhereBuilder::build($update->getWhere());
        
        $query .= ";";

        return $query;
    }

}
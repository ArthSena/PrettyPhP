<?php namespace Illuminate\Database\Builder\Syntax\Query;

use Illuminate\Database\Builder\Syntax\WhereBuilder;
use Illuminate\Database\Factory\Syntax\Query\Delete;

class DeleteBuilder {

    /**
     * Builds a DELETE SQL query string from a Delete object.
     *
     * @param Delete $delete The Delete object containing the table name and optional WHERE clause.
     * 
     * @return string The DELETE SQL query string.
     */
    public static function build(Delete $delete): string {
        $query = "DELETE ";

        $query .= " FROM " . $delete->getTable()->getName();

        if($delete->getWhere()->has())
            $query .= " " . WhereBuilder::build($delete->getWhere());
        
        $query .= ";";

        return $query;
    }

}
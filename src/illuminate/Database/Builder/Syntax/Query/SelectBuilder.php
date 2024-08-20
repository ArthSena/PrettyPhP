<?php namespace Illuminate\Database\Builder\Syntax\Query;

use Illuminate\Database\Builder\Syntax\OrderByBuilder;
use Illuminate\Database\Builder\Syntax\WhereBuilder;
use Illuminate\Database\Factory\Syntax\Query\Select;

class SelectBuilder {

    /**
     * Builds a SQL SELECT query string from a given Select object.
     *
     * @param Select $select The Select object containing the query parameters.
     * 
     * @return string The SQL SELECT query string.
     */
    public static function build(Select $select): string {
        $query = "SELECT ";

        if(!empty($select->getColumns()))
            $query .= is_array($select->getColumns()) ? implode(", ", $select->getColumns()) : $select->getColumns();
         else 
            $query.= "*";

        $query .= " FROM " . $select->getTable()->getName();

        if($select->getWhere()->has())
            $query .= " " . WhereBuilder::build($select->getWhere());

        if($select->getOrderBy()->has())
            $query .= " " . OrderByBuilder::build($select->getOrderBy());

        if($select->getLimit() > 0)
            $query .= " LIMIT " . $select->getLimit();

        if($select->getOffset() > 0)
            $query.= " OFFSET ". $select->getOffset();

        $query .= ";";

        return $query;
    }

}
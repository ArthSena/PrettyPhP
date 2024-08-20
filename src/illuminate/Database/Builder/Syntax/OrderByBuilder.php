<?php namespace Illuminate\Database\Builder\Syntax;

use Illuminate\Database\Factory\Syntax\OrderBy;

class OrderByBuilder {

    /**
     * Builds an SQL ORDER BY clause from a given OrderBy object.
     *
     * @param OrderBy $orderBy The OrderBy object containing the column names and sorting directions.
     * 
     * @return string The SQL ORDER BY clause. If the OrderBy object is empty, an empty string is returned.
     */
    public static function build(OrderBy $orderBy): string {
        if(count($orderBy->getData()) <= 0)
            return "";

        $query = " ORDER BY ";

        for( $i = 0; $i < count($orderBy->getData()); $i++ ) {
            $query .= $orderBy->getData()[$i]["column"]. " " . $orderBy->getData()[$i]["direction"]->value;

            if($i != count($orderBy->getData()) -1) 
                $query .= ", ";
        }

        return $query;
    }

}
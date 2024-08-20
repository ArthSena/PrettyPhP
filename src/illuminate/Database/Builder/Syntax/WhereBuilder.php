<?php namespace Illuminate\Database\Builder\Syntax;

use Illuminate\Database\Factory\Syntax\Where;

class WhereBuilder {

    /**
     * Builds a SQL WHERE clause from a Where object.
     *
     * @param Where $where The Where object containing the conditions to be included in the clause.
     * 
     * @return string The SQL WHERE clause as a string. If the Where object is empty, an empty string is returned.
     */
    public static function build(Where $where): string {
        if(count($where->getData()) <= 0)
            return "";

        $query = " WHERE ";
        
        for( $i = 0; $i < count($where->getData()); $i++ ) {
            $value = $where->getData()[$i]["value"];

            $query .=  $where->getData()[$i]["column"];
            $query .=  " ". $where->getData()[$i]["operator"]. " ";
            $query .=  is_string($value) ? "'" . $value . "'" : $value;

            if($i != count($where->getData()) -1) 
                $query .= " " . $where->getData()[$i]["conjunction"] . " ";
        }

        return $query;         
    }

}
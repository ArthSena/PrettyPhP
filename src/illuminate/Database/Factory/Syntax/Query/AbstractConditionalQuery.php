<?php namespace Illuminate\Database\Factory\Syntax\Query;

use Illuminate\Database\Factory\Syntax\Where;

abstract class AbstractConditionalQuery extends AbstractBaseQuery {

    protected Where $where;
    
    /**
     * Retrieves the Where instance associated with the current query.
     *
     * @return Where The Where instance used to construct the WHERE clause.
     */
    public function getWhere(): Where {
        return $this->where;
    }

    /**
     * Adds a new condition to the WHERE clause of the query.
     *
     * @param string $column The column name to apply the condition to.
     * @param string $operator The comparison operator to use (e.g., "=", "<>", ">", "<", etc.).
     * @param mixed $value The value to compare against the column.
     * @param string $conjunction The logical conjunction to use for this condition (default is "AND").
     *
     * @return self The current instance of the query builder for method chaining.
     */
    public function where(string $column, string $operator, mixed $value, string $conjunction = "AND"): self {
        $this->where->add($column, $operator, $value, $conjunction);
        return $this;
    }

    /**
     * Adds a new equality condition to the WHERE clause of the query.
     *
     * This method is a convenience wrapper around the `where` method, specifically for equality comparisons.
     * It appends a new condition to the WHERE clause of the query, using the "=" operator.
     *
     * @param string $column The column name to apply the condition to.
     * @param mixed $value The value to compare against the column.
     * @param string $conjunction The logical conjunction to use for this condition (default is "AND").
     *
     * @return self The current instance of the query builder for method chaining.
     */
    public function whereEquals(string $column, mixed $value, string $conjunction = "AND"): self {
        $this->where($column, '=', $value, $conjunction);
        return $this;
    }

    /**
     * Adds a new inequality condition to the WHERE clause of the query.
     *
     * This method is a convenience wrapper around the `where` method, specifically for inequality comparisons.
     * It appends a new condition to the WHERE clause of the query, using the "!=" operator.
     *
     * @param string $column The column name to apply the condition to.
     * @param mixed $value The value to compare against the column.
     * @param string $conjunction The logical conjunction to use for this condition (default is "AND").
     *
     * @return self The current instance of the query builder for method chaining.
     */
    public function whereNotEquals(string $column, mixed $value, string $conjunction = "AND"): self {
        $this->where($column, '!=', $value, $conjunction);
        return $this;
    }
    
}
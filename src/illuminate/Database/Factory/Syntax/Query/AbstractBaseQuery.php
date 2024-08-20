<?php namespace Illuminate\Database\Factory\Syntax\Query;

use Illuminate\Database\Factory\Syntax\Table;

abstract class AbstractBaseQuery {

    protected Table $table;

    /**
     * Retrieves the Table instance associated with the current query builder instance.
     *
     * @return Table The Table instance associated with the current query builder.
     */
    public function getTable(): Table {
        return $this->table;
    }

    /**
     * Sets the table name for the current query builder instance.
     *
     * This method creates a new Table instance with the provided table name and assigns it to the `$table` property.
     * It returns the current instance of the query builder for method chaining.
     *
     * @param string $name The name of the table to be associated with the current query builder.
     *
     * @return self The current instance of the query builder.
     */
    public function setTable(string $name): self {
        $this->table = new Table($name);
        return $this;
    }
    
    /**
     * Executes the query and returns the result.
     *
     * This method is responsible for executing the query and returning the result.
     * The actual implementation of this method will depend on the specific database
     * system being used.
     *
     * @return mixed The result of executing the query. The type of the returned value
     *               depends on the specific query being executed.
     */
    public abstract function execute(): mixed;
}
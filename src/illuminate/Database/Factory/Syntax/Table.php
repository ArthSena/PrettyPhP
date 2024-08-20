<?php namespace Illuminate\Database\Factory\Syntax;

use Illuminate\Database\Builder\Syntax\TableBuilder;
use Illuminate\Database\DB;
use Illuminate\Database\Factory\Syntax\Query\Delete;
use Illuminate\Database\Factory\Syntax\Query\Insert;
use Illuminate\Database\Factory\Syntax\Query\Select;
use Illuminate\Database\Factory\Syntax\Query\Update;

class Table {
    
    private string $name;

    /**
     * Constructs a new Table instance.
     *
     * @param string $name The name of the table.
     */
    public function __construct(string $name) {
        $this->name = $name;
    }

    // Query builder methods...

    /**
     * Deletes records from the table.
     *
     * This method constructs and returns a Delete query object for the table.
     * The Delete query can be further customized and executed using the provided methods.
     *
     * @return Delete The Delete query object for the table.
     */
    public function delete(): Delete {
        return new Delete($this);
    }

    /**
     * Inserts new records into the table.
     *
     * This method constructs and returns an Insert query object for the table.
     * The Insert query can be further customized and executed using the provided methods.
     *
     * @param array $data An associative array containing the column names as keys and their corresponding values.
     *                    If no data is provided, an empty Insert query object will be returned.
     *
     * @return Insert The Insert query object for the table.
     */
    public function insert(array $data = []): Insert {
        return new Insert($this, $data);
    }

    /**
     * Constructs and returns a Select query object for the table.
     *
     * The Select query can be further customized and executed using the provided methods.
     * If no columns are specified, all columns will be selected.
     *
     * @param mixed $columns (Optional) The columns to select.
     *                       This can be a string (for a single column), an array of strings (for multiple columns),
     *                       or an empty array (to select all columns).
     *                       Default: An empty array.
     *
     * @return Select The Select query object for the table.
     */
    public function select(mixed $columns = []): Select {
        return new Select($this, $columns);
    }

    /**
     * Constructs and returns an Update query object for the table.
     *
     * The Update query object can be further customized and executed using the provided methods.
     * If no data is provided, an empty Update query object will be returned.
     *
     * @param array $data (Optional) An associative array containing the column names as keys and their corresponding values.
     *                    These values will be used to update the records in the table.
     *                    If no data is provided, an empty Update query object will be returned.
     *                    Default: An empty array.
     *
     * @return Update The Update query object for the table.
     */
    public function update(array $data = []): Update {
        return new Update($this, $data);
    }

    /**
     * Drops the table from the database.
     *
     * This method constructs and executes a SQL query to drop the table from the database.
     * The table is identified by its name, which is obtained from the Table instance.
     *
     * @return void This method does not return any value.
     *
     * @throws \Exception If there is an error executing the SQL query.
     */
    public function drop() {
        DB::query(TableBuilder::buildDrop($this));
    }

    /**
     * Truncates the table from the database.
     *
     * This method constructs and executes a SQL query to remove all records from the table.
     * The table is identified by its name, which is obtained from the Table instance.
     *
     * @return void This method does not return any value.
     *
     * @throws \Exception If there is an error executing the SQL query.
     */
    public function truncate() {
        DB::query(TableBuilder::buildTruncate($this));
    }


    // Other table methods...

    /**
     * Retrieves the name of the table.
     *
     * This method returns the name of the table as a string. The name is obtained from the instance's property.
     *
     * @return string The name of the table.
     */
    public function getName(): string {
        return $this->name;
    }
}
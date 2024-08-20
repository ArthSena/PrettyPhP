<?php namespace Illuminate\Database\Factory\Syntax\Query;

use Illuminate\Database\Builder\Syntax\Query\InsertBuilder;
use Illuminate\Database\DB;
use Illuminate\Database\Factory\Syntax\Table;

class Insert extends AbstractBaseQuery {

    private array $columns;
    
    private array $values;

    /**
     * Constructor for the Insert class.
     *
     * Initializes the Insert object with a table and optional data array.
     * If data is provided, it sets the columns and values accordingly.
     *
     * @param Table $table The table to insert data into.
     * @param array $data  Optional associative array of column-value pairs.
     *                     If provided, it will set the columns and values for the insert operation.
     */
    public function __construct(Table $table, array $data = []) {
        $this->table = $table;

        if(!empty($data)) {
            $this->columns = array_keys($data);
            $this->values = array_values($data);
        }
    }

    /**
     * Sets the columns and values for the insert operation using an associative array.
     *
     * This method takes an associative array of column-value pairs and sets the columns and values for the insert operation.
     * If the array is not empty, it extracts the keys (column names) and values from the array and assigns them to the
     * respective properties of the Insert object.
     *
     * @param array $data An associative array of column-value pairs.
     *
     * @return self The current instance of the Insert class, allowing method chaining.
     */
    public function fromArray(array $data): self {
        if(!empty($data)) {
            $this->columns = array_keys($data);
            $this->values = array_values($data);
        }

        return $this;
    }

    /**
     * Retrieves the columns for the insert operation.
     *
     * @return array The array of columns for the insert operation.
     */
    public function getColumns(): array {
        return $this->columns;
    }

    /**
     * Sets the columns for the insert operation.
     *
     * This method allows you to specify the columns for the insert operation.
     * The provided array of columns will be used when building the SQL query.
     *
     * @param array $columns An array of column names to be inserted.
     *
     * @return self The current instance of the Insert class, allowing method chaining.
     */
    public function columns(array $columns): self {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Retrieves the values for the insert operation.
     *
     * This method returns the array of values that will be inserted into the database.
     * The values are set during the construction of the Insert object or by calling the `values()` method.
     *
     * @return array The array of values for the insert operation.
     */
    public function getValues(): array {
        return $this->values;
    }

    /**
     * Sets the values for the insert operation.
     *
     * This method allows you to specify the values to be inserted into the database.
     * The provided array of values will be used when building the SQL query.
     *
     * @param array $values An array of values to be inserted. The order of values should match the order of columns.
     *
     * @return self The current instance of the Insert class, allowing method chaining.
     */
    public function values(array $values): self {
        $this->values = $values;
        return $this;
    }

    /**
     * Executes the insert operation using the provided data and table.
     *
     * This method constructs an SQL query using the InsertBuilder and executes it.
     * The method returns a boolean value indicating the success of the insert operation.
     *
     * @return bool True if the insert operation was successful, false otherwise.
     */
    public function execute(): bool {
        return DB::query(InsertBuilder::build($this))->execute();
    }


}

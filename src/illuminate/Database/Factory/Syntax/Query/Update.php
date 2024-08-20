<?php namespace Illuminate\Database\Factory\Syntax\Query;

use Illuminate\Database\Builder\Syntax\Query\UpdateBuilder;
use Illuminate\Database\DB;
use Illuminate\Database\Factory\Syntax\Where;
use Illuminate\Database\Factory\Syntax\Table;

class Update extends AbstractConditionalQuery {

    private array $columns;

    private array $values;

    /**
     * Constructor for the Update class.
     *
     * Initializes the Update object with a table and optional data array.
     * If data is provided, it sets the columns and values for the update operation.
     *
     * @param Table $table The table to update.
     * @param array $data  Optional associative array of column names and their corresponding values.
     *                     If provided, it will be used to set the columns and values for the update operation.
     */
    public function __construct(Table $table, array $data = []) {
        $this->table = $table;
        $this->where = new Where();

        if(!empty($data)) {
            $this->columns = array_keys($data);
            $this->values = array_values($data);
        }
    }

    /**
     * Sets the columns and values to be updated from the provided associative array.
     *
     * This method takes an associative array of column names as keys and their corresponding values as values.
     * It extracts the keys and values from the array and sets them as the columns and values to be updated.
     *
     * @param array $data An associative array of column names as keys and their corresponding values to be updated.
     *
     * @return self The current instance of the Update class, allowing method chaining.
     */
    public function fromArray(array $data): self {
        if(!empty($data)) {
            $this->columns = array_keys($data);
            $this->values = array_values($data);
        }

        return $this;
    }

    /**
     * Retrieves the columns to be updated.
     *
     * This method returns an array of column names that will be updated in the database.
     *
     * @return array An array of column names to be updated.
     */
    public function getColumns(): array {
        return $this->columns;
    }

    /**
     * Sets the columns to be updated in the database.
     *
     * This method allows you to specify the columns that will be updated in the database.
     * The provided array of column names will be used to update the corresponding values in the database.
     *
     * @param array $columns An array of column names to be updated.
     *
     * @return self The current instance of the Update class, allowing method chaining.
     */
    public function columns(array $columns): self {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Retrieves the values to be updated in the database.
     *
     * This method returns an array of values that will be used to update the specified columns in the database.
     * The array is indexed by the corresponding column names.
     *
     * @return array An associative array of column names as keys and their corresponding values to be updated.
     */
    public function getValues(): array {
        return $this->values;
    }

    /**
     * Sets the values to be updated in the database.
     *
     * This method allows you to specify the values that will be used to update the specified columns in the database.
     * The provided array of values should be indexed by the corresponding column names.
     *
     * @param array $values An associative array of column names as keys and their corresponding values to be updated.
     *                      The keys should match the column names in the database, and the values should be the new values for those columns.
     *
     * @return self The current instance of the Update class, allowing method chaining.
     */
    public function values(array $values): self {
        $this->values = $values;
        return $this;
    }

    public function execute(): bool {
        return DB::query(UpdateBuilder::build($this))->execute();
    }
}
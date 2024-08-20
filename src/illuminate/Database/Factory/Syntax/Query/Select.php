<?php namespace Illuminate\Database\Factory\Syntax\Query;

use Illuminate\Database\Builder\Syntax\Query\SelectBuilder;
use Illuminate\Database\DB;
use Illuminate\Database\Factory\Response\SelectResponse;
use Illuminate\Database\Factory\Syntax\OrderBy;
use Illuminate\Database\Factory\Syntax\OrderDireccion;
use Illuminate\Database\Factory\Syntax\Where;
use Illuminate\Database\Factory\Syntax\Table;

class Select extends AbstractConditionalQuery {

    private mixed $columns;
    private OrderBy $orderBy;
    private int $limit;
    private int $offset;

    public function __construct(Table $table, mixed $columns = []) {
        $this->table = $table;
        $this->where = new Where();
        $this->columns = $columns;
        $this->orderBy = new OrderBy();
        $this->limit = 0;
        $this->offset = 0;
    }

    public function getColumns(): mixed {
        return $this->columns;
    }

    /**
     * Sets the columns to be selected in the query.
     *
     * This method allows you to specify the columns you want to retrieve from the database.
     * You can pass a string or a array of strings
     *
     * @param mixed $columns The columns to be selected.
     *
     * @return self The current instance of the query builder for method chaining.
     */
    public function columns(mixed $columns): self {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Retrieves the OrderBy instance associated with the current query.
     *
     * The OrderBy instance is used to construct the ORDER BY clause in the SQL query.
     * It allows you to specify the column(s) and direction(s) for sorting the result set.
     *
     * @return OrderBy The OrderBy instance used to construct the ORDER BY clause.
     */
    public function getOrderBy(): OrderBy {
        return $this->orderBy;
    }

    /**
     * Sets the order by clause for the query.
     *
     * This method allows you to specify the column and direction for the order by clause.
     * If no direction is provided, the default is ASC (ascending).
     *
     * @param string $column The column to order by.
     * @param OrderDireccion $direction The direction of the order (ASC or DESC). Defaults to ASC.
     *
     * @return self The current instance of the Select class for method chaining.
     */
    public function orderBy(string $column, OrderDireccion $direction = OrderDireccion::ASC): self {
        $this->orderBy->add($column, $direction);
        return $this;
    }

    /**
     * Retrieves the limit value for the query.
     *
     * The limit value specifies the maximum number of rows to return in the result set.
     * If no limit is set, this method will return 0.
     *
     * @return int The limit value for the query.
     */
    public function getLimit(): int {
        return $this->limit;
    }

    /**
     * Retrieves the offset value for the query.
     *
     * The offset value specifies the number of rows to skip before starting to return rows.
     * It is used in conjunction with the limit value to implement pagination.
     * If no offset is set, this method will return 0.
     *
     * @return int The offset value for the query.
     */
    public function getOffset(): int {
        return $this->offset;
    }

    /**
     * Sets the limit and offset for the query.
     *
     * This method allows you to specify the maximum number of rows to return and optionally an offset.
     * If no offset is provided, the default is 0.
     *
     * @param int $limit The maximum number of rows to return.
     * @param int $offset The number of rows to skip before starting to return rows. Defaults to 0.
     *
     * @return self The current instance of the Select class for method chaining.
     */
    public function limit(int $limit, int $offset = 0): self {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }


    /**
     * Executes the SELECT query and returns the result as a SelectResponse object.
     *
     * This method constructs the SQL query using the provided table, columns, where conditions, order by clause, and limit/offset.
     * It then executes the query using the DB::query method and fetches all the rows as an array.
     * The fetched rows are then passed to a SelectResponse object, which is returned as the result.
     *
     * @return SelectResponse The response object containing the result of the SELECT query.
     */
    public function execute(): SelectResponse {
        return new SelectResponse(DB::query(SelectBuilder::build($this))->fetchAll(\PDO::FETCH_ASSOC));
    }
}
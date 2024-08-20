<?php namespace Illuminate\Database\Factory\Syntax\Query;

use Illuminate\Database\Builder\Syntax\Query\DeleteBuilder;
use Illuminate\Database\DB;
use Illuminate\Database\Factory\Syntax\Where;
use Illuminate\Database\Factory\Syntax\Table;

class Delete extends AbstractConditionalQuery {

    /**
     * Constructs a new Delete instance for building a DELETE query.
     *
     * @param Table $table The table from which rows will be deleted.
     */
    public function __construct(Table $table) {
        $this->table = $table;
        $this->where = new Where();
    }

    /**
     * Executes the DELETE query built from the current instance.
     *
     * This method constructs a DELETE query using the provided table and any
     * conditions added via the `where` method. It then executes the query.
     *
     * @return bool Returns true if the query was executed successfully, false otherwise.
     */
    public function execute(): bool {
        return DB::query(DeleteBuilder::build($this))->execute();
    }
}
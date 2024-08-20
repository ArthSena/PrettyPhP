<?php namespace Illuminate\Database\Builder\Syntax;

use Illuminate\Database\Factory\Syntax\Table;

class TableBuilder {

    /**
     * Builds a SQL statement to drop a table if it exists.
     *
     * @param Table $table The table to be dropped.
     *
     * @return string The SQL statement to drop the table.
     */
    public static function buildDrop(Table $table): string {
        return "DROP TABLE IF EXISTS ". $table->getName(). ";";
    }

    /**
     * Builds a SQL statement to truncate a table.
     *
     * This function generates a SQL statement to truncate the specified table.
     * Truncating a table removes all rows from it, but the table structure and its
     * indexes remain intact.
     *
     * @param Table $table The table to be truncated.
     *
     * @return string The SQL statement to truncate the table.
     *
     * @throws \InvalidArgumentException If the provided table is not an instance of Table.
     */
    public static function buildTruncate(Table $table): string {
        return "TRUNCATE TABLE ". $table->getName(). ";";
    }
}
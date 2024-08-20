<?php namespace Illuminate\Database\Factory;

use Illuminate\Database\Factory\Syntax\Table;

class DatabaseFactory {

    /**
     * Create a new Table instance for the given table name.
     *
     * This method is used to create a new Table instance, which can be used to build
     * a fluent query builder for the specified table.
     *
     * @param string $name The name of the database table.
     *
     * @return \Illuminate\Database\Factory\Syntax\Table The Table instance for the given table name.
     */
    public function table(string $name): Table {
        return new Table($name);
    }

}
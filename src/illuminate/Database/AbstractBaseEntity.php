<?php namespace Illuminate\Database;

abstract class AbstractBaseEntity {
    
    protected string $table;

    /**
     * Constructs a new AbstractEntity instance.
     *
     * @param string $table The name of the database table associated with this entity.
     */
    public function __construct(string $table) {
        $this->table = $table;
    }

    /**
     * Retrieves the name of the database table associated with this entity.
     *
     * @return string The name of the database table.
     */
    public function getTable(): string {
        return $this->table;
    }

}
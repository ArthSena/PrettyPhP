<?php namespace Illuminate\Database\Factory\Syntax;

class Where {

    private array $whereData = [];

    public function getData(): array {
        return $this->whereData;
    }

    /** 
     * Adds a new condition to the WHERE clause.
     *
     * @param string $column The column name to apply the condition on.
     * @param string $operator The comparison operator to use (e.g., "=", "<>", ">", "<", etc.).
     * @param mixed $value The value to compare against the column.
     * @param string $conjunction The logical conjunction to use for this condition with the previous one. Default
     * 
     * @return self Returns the current instance for method chaining.
     */
    public function add(string $column, string $operator, mixed $value, string $conjunction = "AND"): self {   
        array_push($this->whereData, [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'conjunction' => $conjunction
        ]);
        
        return $this;
    }

    /**
     * Checks if there are any conditions added to the WHERE clause.
     *
     * @return bool Returns true if there are conditions in the WHERE clause, false otherwise.
     */
    public function has(): bool {
        return count($this->whereData) > 0;
    }

}

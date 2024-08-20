<?php namespace Illuminate\Database\Factory\Syntax;

class OrderBy {

    private array $orderData = [];

    /**
     * Retrieves the order data array.
     *
     * @return array The array containing the order instructions. Each instruction is an associative array with 'column' and 'direction' keys.
     */
    public function getData(): array {
        return $this->orderData;
    }

    /** 
     *  Adds a new column and direction to the order instructions.
     * 
     * @param string $column The name of the column to order by.
     * @param string $direction The direction of the order (default is ASC).
     * 
     * @return self The current instance of the OrderBy class for method chaining.
    ​ */
    public function add(string $column, OrderDireccion $direction = OrderDireccion::ASC): self {
        array_push($this->orderData, [ 
            'column' => $column,
            'direction' => $direction
        ]);

        return $this;
    }

    /**
     * Checks if there are any order instructions set.
     *
     * @return bool Returns true if there are order instructions, false otherwise.
     */
    public function has(): bool {
        return count($this->orderData) > 0;
    }

}
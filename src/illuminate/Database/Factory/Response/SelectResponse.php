<?php namespace Illuminate\Database\Factory\Response;

class SelectResponse {

    private array $data;

    /**
     * Constructs a new SelectResponse instance.
     *
     * @param array $data The data to be stored in the response.
     */
    public function __construct(array $data) {
        $this->data = $data;
    }
    
    /**
     * Returns the first element of the data array.
     *
     * @return mixed The first element of the data array, or null if the array is empty.
     */
    public function first(): mixed {
        return $this->data[0] ?? null;
    }

    /**
     * Returns the last element of the data array.
     *
     * @return mixed The last element of the data array, or null if the array is empty.
     */
    public function last(): mixed {
        return end($this->data);
    }

    /**
     * Retrieves an element from the data array at the specified index.
     *
     * @param int $index The index of the element to retrieve.
     *
     * @return mixed The element at the specified index, or null if the index is out of bounds.
     */
    public function get(int $index): mixed {
        return $this->data[$index] ?? null;
    }

    /**
     * Checks if the data array contains an element at the specified index.
     *
     * @param int $index The index to check for an element.
     *
     * @return bool True if the data array contains an element at the specified index, false otherwise.
     */
    public function has(int $index): bool {
        return isset($this->data[$index]);
    }

    /**
     * Returns the data array as an associative array.
     *
     * This method allows you to retrieve the data stored in the SelectResponse instance as an array.
     *
     * @return array The data array.
     */
    public function toArray(): array {
        return $this->data;
    }

    /**
     * Returns the entire data array.
     *
     * This method retrieves the entire data array that was passed to the SelectResponse instance during construction.
     *
     * @return array The data array.
     */
    public function all(): array {
        return $this->data;
    }

    /**
     * Returns the number of elements in the data array.
     *
     * This method counts the number of elements in the data array that was passed to the SelectResponse instance during construction.
     *
     * @return int The number of elements in the data array.
     */
    public function count(): int {
        return count($this->data);
    }
    
    /**
     * Converts the data array to a JSON string.
     *
     * This method uses the json_encode function to convert the data array stored in the SelectResponse instance
     * into a JSON string. The resulting JSON string can be used for further processing or transmission.
     *
     * @return string The JSON representation of the data array.
     */
    public function toJson(): string {
        return json_encode($this->data);
    }
}
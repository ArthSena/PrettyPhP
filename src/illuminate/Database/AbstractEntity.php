<?php namespace Illuminate\Database;

use Illuminate\Database\Factory\Response\SelectResponse;
use Illuminate\Database\Factory\Syntax\Query\Delete;

abstract class AbstractEntity extends AbstractBaseEntity {

    protected mixed $id;
    protected string $createdAt;
    protected string $updatedAt;

    public function __construct(string $table, mixed $id = null) {
        parent::__construct($table);

        $this->id = is_null($id) ? uuid_v4() : $id;  
    }

    public function generateId(): string {
        $this->id = uuid_v4();
        return $this->id;
    }

    public function setId(string $id): self {
        $this->id = $id;
        return $this;
    }

    public function getId(): mixed {
        return $this->id;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;   
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;   
    }


    /**
     * Deletes a record from the associated database table based on the provided ID.
     *
     * @return Delete A Delete instance representing the delete operation.
     *
     * @throws \Exception If there is an error executing the delete operation.
     */
    public function delete(): bool {
        return DB::table($this->getTable())->delete()->whereEquals('id', $this->getId())->execute();
    }

    /**
     * Selects a record from the associated database table based on the provided ID.
     * 
     * @param mixed $columns The columns to be selected. If no columns are provided, all columns will be selected.
     *                      The parameter can be an array of column names or a string containing comma-separated column names.
     *                      If an empty array or an empty string is provided, all columns will be selected.
     *
     * @return SelectResponse A SelectResponse instance representing the result of the select operation.
     *
     * @throws \Exception If there is an error executing the select operation.
     */
    public function select(mixed $columns = []): SelectResponse {
        return DB::table($this->getTable())->select($columns)->whereEquals('id', $this->getId())->execute();
    }

    /**
     * Updates a record in the associated database table based on the provided ID.
     *
     * @param mixed $data An associative array containing the column names and their corresponding values to be updated.
     *                    If no data is provided, an empty array is assumed.
     *
     * @return bool True if the update operation is successful, false otherwise.
     *
     * @throws \Exception If there is an error executing the update operation.
     */
    public function update(mixed $data = []): bool {
        return DB::table($this->getTable())->update($data)->whereEquals("id", $this->getId())->execute();
    }


}
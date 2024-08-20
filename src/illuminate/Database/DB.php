<?php namespace Illuminate\Database;

use Illuminate\Database\Factory\DatabaseFactory;
use Illuminate\Database\Factory\Syntax\Table;
use Illuminate\Database\Populate\MigrationHandler;

class DB {

    private static $pdo;

    private static DatabaseFactory $factory;

    /**
     * Constructs a new DB instance.
     *
     * This method initializes a new instance of the DB class and creates a new Builder instance.
     * The Builder instance is stored in the static property self::$builder for later use in query building.
     */
    public function __construct() {
        self::$factory = new DatabaseFactory();
    }

    /**
     * Establishes a connection to the database using PDO.
     * 
     * This function attempts to create a new PDO connection using the provided database configuration.
     * If the connection is successful, the PDO object is stored in the static property self::$pdo.
     * If an exception is thrown during the connection process, the exception message is outputted and the script execution is halted.
     * 
     * @throws \PDOException If a connection cannot be established.
     */
    public function connect() {
        $conn =  DBCONFIG['driver'].":";
        $conn .= "host=" . DBCONFIG['host'];
        $conn .= ";port=" . DBCONFIG['port'];
        $conn .= ";dbname=" . DBCONFIG['dbname'];
        $conn .= ";" . DBCONFIG['options'];
        
        try {
            self::$pdo = new \PDO($conn, DBCONFIG['username'], DBCONFIG['password'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            throw new \Exception(''.$e->getMessage());
        }
    }
    /**
     * Executes a SQL statement and returns the result set as a PDOStatement object.
     *
     * @param string $query The SQL statement to be executed.
     * @param int|null $fetchMode The fetch mode to be used for the result set.
     * @param mixed ...$fetch_mode_args Additional arguments for the fetch mode.
     *
     * @return \PDOStatement The result set as a PDOStatement object.
     *
     * @throws \Exception If no database connection is established.
     */
    public static function query(string $query, int|null $fetchMode = null, mixed ...$fetch_mode_args): \PDOStatement {
        if(self::$pdo instanceof \PDO)
            return self::$pdo->query($query, $fetchMode, $fetch_mode_args);
        else
            throw new \Exception('No database connection established');
    }

    /**
     * Creates a new Table instance for the given table name.
     *
     * This method utilizes the DatabaseFactory to create a new Table instance for the specified table name.
     * The Table instance provides a fluent interface for building database queries and manipulating table data.
     *
     * @param string $name The name of the table for which to create a Table instance.
     *
     * @return Table A new Table instance for the specified table name.
     */
    public static function table($name): Table {
        return self::$factory->table($name);
    }

    /**
     * Runs all pending database migrations.
     *
     * This method triggers the execution of all pending database migrations.
     * If a migration fails during execution, the migration process will be halted and an exception will be thrown.
     *
     * @throws \Exception If a migration fails during execution.
     */
    public static function runMigrations(): void {
        MigrationHandler::runMigrations();
    }

    /**
     * Rolls back all pending database migrations.
     *
     * This method triggers the execution of the rollback process for all pending database migrations.
     * If a migration fails during execution, the rollback process will be halted and an exception will be thrown.
     *
     * @throws \Exception If a migration fails during rollback.
     */
    public static function rollbackMigrations(): void {
        MigrationHandler::rollbackMigrations();
    }

    /**
     * Truncates all tables in the database by dropping them and recreating them.
     *
     * This method triggers the execution of the truncate process for all tables in the migrations.
     * It utilizes the MigrationHandler class to perform the truncation operation.
     * If the truncation process fails for any reason, an exception will be thrown.
     *
     * @throws \Exception If the truncation process fails for any table.
     */
    public static function truncateMigrations(): void {
        MigrationHandler::truncateMigrations();
    }

}
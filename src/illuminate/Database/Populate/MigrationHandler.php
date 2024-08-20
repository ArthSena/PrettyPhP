<?php namespace Illuminate\Database\Populate;

class MigrationHandler {
    
    /**
     * Runs all migration files located in the specified directory.
     *
     * @throws \Exception If a migration class does not implement the Migration interface.
     */
    public static function runMigrations(): void {
        $migrations = self::getMigrations();

        foreach ($migrations as $migration) {
            if (method_exists($migration, 'up')) {
                $migration->up();
            }
            
            if (method_exists($migration, 'seed')) {
                $migration->seed();
            }
        }
    }

    /**
     * Rolls back all migration files located in the specified directory.
     *
     * @throws \Exception If a migration class does not implement the Migration interface.
     */
    public static function rollbackMigrations(): void {
        $migrations = self::getMigrations();

        foreach ($migrations as $migration) {

            if (method_exists($migration, 'down')) {
                $migration->down();
            }
        }
    }

    /**
     * Truncates all migration tables by calling the 'truncate' method on each migration class.
     *
     * This function retrieves all migration files from the specified directory,
     * creates instances of each migration class, and then calls the 'truncate' method if it exists.
     *
     * @throws \Exception If a migration class does not implement the Migration interface.
     */
    public static function truncateMigrations(): void {
        $migrations = self::getMigrations();

        foreach ($migrations as $migration) {
            if (method_exists($migration, 'truncate')) {
                $migration->truncate();
            }
        }
    }


    /**
     * Retrieves all migration files from the specified directory,
     * creates instances of each migration class, and returns them as an array.
     *
     * @return array An array of migration instances.
     * 
     * @throws \Exception If a migration class does not implement the Migration interface.
     */
    private static function getMigrations() : array {
        $migrationFiles = glob(__HOME_DIR__ . '/' . APP['migrations_dir'] . '/*.php');
        $migrations = [];
        
        foreach ($migrationFiles as $migrationFile) {
            require_once $migrationFile;

            $migrationClass = str_replace('/', '\\', APP['migrations_dir']) . '\\' . pathinfo($migrationFile, PATHINFO_FILENAME);

            if(!interface_exists('Illuminate\Database\Populate\Migration')) {
                throw new \Exception("Migration class does not implement Migration. Please ensure it implements Migration. Migration: $migrationFile");
            }
            array_push($migrations, new $migrationClass());

        }

        return $migrations;
    }
}
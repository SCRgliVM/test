<?php

namespace core;

/**
 * Database managment
 */
class Database
{
    /**
     * @var \PDO
     */
    public \PDO $pdo;
    /**
     * @var Database
     */
    public static Database $DB;

    /**
     * Init database config
     * @param array $dbConfig Database configurations
     */
    public function __construct($dbConfig = [])
    {
        $user = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';
        $dsn = $dbConfig['dsn'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        self::$DB = $this;
    }

    /**
     * Apply all the migrations in /migrations directory
     * @param mixed $rootDir Dir where /migrations directory take place
     * 
     * @return void
     */
    public function migration($rootDir)
    {
        $this->initMigrationTable();
        $existMigrations = $this->getMigrations();

        $newMigrations = [];
        $files = scandir($rootDir.'/migrations');
        $migrations = array_diff($files, $existMigrations);
        foreach ($migrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once $rootDir.'/migrations/'.$migration;
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $migrationClass();

            echo "Start migration $migration\n";

            $instance->up();

            echo "Finish migration $migration\n";

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } 
        else {
            echo "There are no available migrations\n";
        }       

    }

    /**
     * Get migration table or create if doesn't exit. Migration table
     * has migration history
     * @return void
     */
    protected function initMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    /**
     * Get all already existed migrations 
     * @return array Existed migration records
     */
    protected function getMigrations()
    {
        $PDOstatement = $this->pdo->prepare("SELECT migration FROM migrations");
        $PDOstatement->execute();

        return $PDOstatement->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Save migrations into migration table
     * @param array $newMigrations New applied migrations
     * 
     * @return void
     */
    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }

}

<?php


class Database
{

    private $database;
    private $user;
    private $pass;
    private $host;
    private $port;
    /**
        * Class constructor.
    */
    public function __construct( string $db, string $users, string $password, string $host, string $port )
    {
        $this->database = $db;
        $this->user     = $users;
        $this->pass     = $password;
        $this->host     = $host;
        $this->port     = $port;
    }

    public function getCon()
    {
        $pdo =  new PDO("pgsql:dbname={$this->database};user={$this->user};password={$this->pass};host={$this->host};port=5432");
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $pdo;
    }
}





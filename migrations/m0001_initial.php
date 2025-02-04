<?php

class m0001_initial
{
    public function up()
    {
        $db = \ryanp\lykacore\Kernel::$kernel->db;
        $SQL = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            firstName VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \ryanp\lykacore\Kernel::$kernel->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}
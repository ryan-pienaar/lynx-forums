<?php

class m0002_add_password_col
{
    public function up()
    {
        $db = \ryan\lykacore\Kernel::$kernel->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \ryan\lykacore\Kernel::$kernel->db;
        $SQL = "ALTER TABLE users DROP COLUMN password;";
        $db->pdo->exec($SQL);
    }
}
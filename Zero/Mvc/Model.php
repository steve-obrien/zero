<?php
namespace Core;

use PDO;

class Model
{
    protected $db;
    protected $tenant;

    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
        $this->connectDatabase();
    }

    private function connectDatabase()
    {
        // Database connection parameters
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'tenant_' . $this->tenant; // Database name per tenant

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}

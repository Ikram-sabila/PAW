<?php
class DB {
    private $conn = NULL;
    private $error = '';

    public function connect($driver, $host, $username, $password, $database, $port = 0, $options = array()) {
        if (!extension_loaded("pdo")) {
            die("Missing PDO PHP extension.");
        }
        
        $driver = strtolower($driver);
        try {
            if ($driver == "mysql") {
                if (!extension_loaded("pdo_mysql")) {
                    die("Missing pdo_mysql PHP extension.");
                }
                
                if (empty($port)) {
                    $port = 3306;
                }
                
                $this->conn = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$database, $username, $password, $options);
            }
            elseif ($driver == "pgsql") {
                if (!extension_loaded("pdo_pgsql")) {
                    die("Missing pdo_pgsql PHP extension.");
                }
                
                if (empty($port)) {
                    $port = 5432;
                }
                
                $this->conn = new PDO("pgsql:host=".$host.";port=".$port.";dbname=".$database, $username, $password, $options);
            }
            elseif ($driver == "sqlite") {
                if (!extension_loaded("pdo_sqlite")) {
                    die("Missing pdo_sqlite PHP extension.");
                }
                
                if (!file_exists($database)) {
                    @touch($database);
                }
                
                if (file_exists($database) && is_readable($database) && is_writable($database)) {
                    $this->conn = new PDO("sqlite:".$database, $username, $password, $options);
                }
                else {
                    $this->error = "Can't create/connect to the SQLite database";
                    return false;
                }
            }
            else {
                $this->error = "Unsupported database type found";
                return false;
            }
            
            return true;
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
    
    public function close () {
        $this->conn = NULL;
    }

    public function query ($res, $bind = array()) {
        try {
            $query = $this->conn->prepare($res);
            
            if (is_array($bind) && !empty($bind)) {
                $query->execute($bind);
            } else {
                $query->execute();
            }
            
            return $query;
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function fetch_array ($res) {
        try {
            return $res->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function last_id () {
        return $this->conn->lastInsertId();
    }

    public function error () {
        return $this->error;
    }

    public function __call($name, $arguments) {
        if (!method_exists($this->conn, $name)) {
            throw new Exception("Unknown method '".$name."'");
        }

        return call_user_func_array(array($this->conn, $name), $arguments);
    }
}
?>

?>
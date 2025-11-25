<?php
/**
 * Clase de Base de Datos
 * Sistema ISTS - Manejo seguro de conexiones PDO
 */

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;
    private $pdo;
    private static $instance = null;
    
    public function __construct() {
        // Cargar configuración desde constantes o variables de entorno con fallback
        // Evita errores cuando las constantes legacy (DB_HOST, etc.) no están definidas
        $this->host = defined('DB_HOST') ? DB_HOST : (getenv('DB_HOST') ?: (isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : (function_exists('env') ? env('DB_HOST', '127.0.0.1') : '127.0.0.1')));
        $this->dbname = defined('DB_NAME') ? DB_NAME : (getenv('DB_NAME') ?: (isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : (function_exists('env') ? env('DB_DATABASE', '') : '')));
        $this->username = defined('DB_USER') ? DB_USER : (getenv('DB_USER') ?: (isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : (function_exists('env') ? env('DB_USERNAME', '') : '')));
        $this->password = defined('DB_PASS') ? DB_PASS : (getenv('DB_PASS') ?: (isset($_ENV['DB_PASS']) ? $_ENV['DB_PASS'] : (function_exists('env') ? env('DB_PASSWORD', '') : '')));
        $this->charset = defined('DB_CHARSET') ? DB_CHARSET : (getenv('DB_CHARSET') ?: (isset($_ENV['DB_CHARSET']) ? $_ENV['DB_CHARSET'] : (function_exists('env') ? env('DB_CHARSET', 'utf8mb4') : 'utf8mb4')));

        $this->connect();
    }
    
    /**
     * Singleton pattern para conexión única
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset} COLLATE utf8mb4_unicode_ci",
                PDO::ATTR_PERSISTENT => false
            ];
            
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Error de conexión a la base de datos");
        }
    }
    
    public function getConnection() {
        return $this->pdo;
    }
    
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }
    
    public function commit() {
        return $this->pdo->commit();
    }
    
    public function rollback() {
        return $this->pdo->rollback();
    }
    
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Ejecutar query preparado
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("Error en la consulta de base de datos");
        }
    }
    
    /**
     * Obtener todos los registros
     */
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * Obtener un registro
     */
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    /**
     * Insertar registro
     */
    public function insert($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $this->lastInsertId();
    }
    
    /**
     * Actualizar registro
     */
    public function update($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    /**
     * Eliminar registro
     */
    public function delete($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    /**
     * Verificar si la tabla existe
     */
    public function tableExists($tableName) {
        $sql = "SHOW TABLES LIKE ?";
        $result = $this->fetchOne($sql, [$tableName]);
        return !empty($result);
    }
    
    /**
     * Obtener información de la tabla
     */
    public function getTableInfo($tableName) {
        $sql = "DESCRIBE {$tableName}";
        return $this->fetchAll($sql);
    }
    
    /**
     * Backup de base de datos
     */
    public function backup($backupPath) {
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupPath . '/' . $filename;
        
        $command = "mysqldump -h{$this->host} -u{$this->username} -p{$this->password} {$this->dbname} > {$filepath}";
        
        exec($command, $output, $returnCode);
        
        if ($returnCode === 0) {
            return $filepath;
        } else {
            throw new Exception("Error al crear backup de la base de datos");
        }
    }
}
?>

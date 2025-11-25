<?php
/**
 * Modelo Base con PDO seguro
 */
class Model
{
    protected $db;
    protected $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    /**
     * Ejecutar query preparado de forma segura
     */
    protected function query($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            Security::logSecurity(
                "database_error",
                null,
                $e->getMessage(),
                "medium",
            );
            throw new Exception("Database operation failed");
        }
    }

    /**
     * Obtener todos los registros
     */
    protected function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    /**
     * Obtener un registro
     */
    protected function fetchOne($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    /**
     * Insertar registro
     */
    protected function insert($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $this->conn->lastInsertId();
    }

    /**
     * Actualizar registro
     */
    protected function update($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    /**
     * Eliminar registro
     */
    protected function delete($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
}
?>

<?php

namespace App\Models;

require_once __DIR__ . "/../core/Model.php";

/**
 * Modelo para manejo de contenidos
 * Sistema ISTS - Gestión de contenidos del sitio web
 */
class Content extends \Model
{
    /**
     * Obtener todos los contenidos
     */
    public function getAll($limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM contents ORDER BY created_at DESC";

        if ($limit) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        return $this->fetchAll($sql);
    }

    /**
     * Obtener contenidos por categoría
     */
    public function getByCategory($category, $limit = null)
    {
        $sql =
            "SELECT * FROM contents WHERE category = ? AND (status = 'published' OR status IS NULL) ORDER BY created_at DESC";

        if ($limit) {
            $sql .= " LIMIT $limit";
        }

        return $this->fetchAll($sql, [$category]);
    }

    /**
     * Obtener contenidos hijos por ID de padre
     */
    public function getChildren($parentId)
    {
        $sql =
            "SELECT * FROM contents WHERE parent_id = ? AND (status = 'published' OR status IS NULL) ORDER BY created_at DESC";
        return $this->fetchAll($sql, [$parentId]);
    }

    /**
     * Obtener contenidos por categoría y que no tengan padre
     */
    public function getByCategoryAndParent($category, $limit = null)
    {
        $sql =
            "SELECT * FROM contents WHERE category = ? AND parent_id IS NULL AND (status = 'published' OR status IS NULL) ORDER BY created_at DESC";

        if ($limit) {
            $sql .= " LIMIT $limit";
        }

        return $this->fetchAll($sql, [$category]);
    }

    /**
     * Obtener contenidos recientes
     */
    public function getRecent($limit = 10)
    {
        $sql =
            "SELECT * FROM contents WHERE status = 'published' ORDER BY updated_at DESC LIMIT ?";
        return $this->fetchAll($sql, [$limit]);
    }

    /**
     * Obtener contenidos destacados
     */
    public function getFeatured($limit = 5)
    {
        $sql =
            "SELECT * FROM contents WHERE status = 'published' AND featured = 1 ORDER BY created_at DESC LIMIT ?";
        return $this->fetchAll($sql, [$limit]);
    }

    /**
     * Buscar contenido por slug
     */
    public function findBySlug($slug)
    {
        $sql =
            "SELECT * FROM contents WHERE slug = ? AND (status = 'published' OR status IS NULL)";
        return $this->fetchOne($sql, [$slug]);
    }

    /**
     * Buscar contenido por ID
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM contents WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     * Buscar contenidos por texto
     */
    public function search($query, $limit = 10)
    {
        $sql = "SELECT * FROM contents
                WHERE status = 'published'
                AND (title LIKE ? OR description LIKE ? OR content LIKE ?)
                ORDER BY created_at DESC
                LIMIT ?";

        $searchTerm = "%$query%";
        return $this->fetchAll($sql, [
            $searchTerm,
            $searchTerm,
            $searchTerm,
            $limit,
        ]);
    }

    /**
     * Incrementar contador de vistas
     */
    public function incrementViews($id)
    {
        $sql = "UPDATE contents SET views = views + 1 WHERE id = ?";
        return $this->update($sql, [$id]);
    }

    /**
     * Obtener total de vistas
     */
    public function getTotalViews()
    {
        $sql = "SELECT SUM(views) as total FROM contents";
        $result = $this->fetchOne($sql);
        return $result["total"] ?? 0;
    }

    /**
     * Contar contenidos
     */
    public function count($status = null)
    {
        if ($status) {
            $sql = "SELECT COUNT(*) as total FROM contents WHERE status = ?";
            $result = $this->fetchOne($sql, [$status]);
        } else {
            $sql = "SELECT COUNT(*) as total FROM contents";
            $result = $this->fetchOne($sql);
        }

        return $result["total"] ?? 0;
    }

    /**
     * Crear nuevo contenido
     */
    public function create($data)
    {
        $sql = "INSERT INTO contents (title, slug, url, is_external, description, content, category, status, featured, created_by, image_url, parent_id, file_url)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $data["title"],
            $data["slug"],
            $data["url"] ?? null,
            $data["is_external"] ?? 0,
            $data["description"] ?? null,
            $data["content"] ?? null,
            $data["category"] ?? null,
            $data["status"] ?? "draft",
            $data["featured"] ?? 0,
            $data["created_by"] ?? null,
            $data["image_url"] ?? null,
            $data["parent_id"] ?? null,
            $data["file_url"] ?? null,
        ];

        return $this->insert($sql, $params);
    }

    /**
     * Actualizar contenido
     */
    public function updateContent($id, $data)
    {
        $sql = "UPDATE contents SET
                title = ?,
                slug = ?,
                url = ?,
                is_external = ?,
                description = ?,
                content = ?,
                category = ?,
                status = ?,
                featured = ?,
                image_url = ?,
                parent_id = ?,
                file_url = ?
                WHERE id = ?";

        $params = [
            $data["title"],
            $data["slug"],
            $data["url"] ?? null,
            $data["is_external"] ?? 0,
            $data["description"] ?? null,
            $data["content"] ?? null,
            $data["category"] ?? null,
            $data["status"] ?? "draft",
            $data["featured"] ?? 0,
            $data["image_url"] ?? null,
            $data["parent_id"] ?? null,
            $data["file_url"] ?? null,
            $id,
        ];

        return $this->update($sql, $params);
    }

    /**
     * Actualizar imagen de contenido
     */
    public function updateImage($id, $imageUrl)
    {
        $sql = "UPDATE contents SET image_url = ? WHERE id = ?";
        return $this->update($sql, [$imageUrl, $id]);
    }

    /**
     * Actualizar archivo de contenido
     */
    public function updateFile($id, $fileUrl)
    {
        $sql = "UPDATE contents SET file_url = ? WHERE id = ?";
        return $this->update($sql, [$fileUrl, $id]);
    }

    /**
     * Eliminar contenido
     */
    public function deleteContent($id)
    {
        $sql = "DELETE FROM contents WHERE id = ?";
        return $this->delete($sql, [$id]);
    }

    /**
     * Obtener contenidos con paginación
     */
    public function paginate($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $sql =
            "SELECT * FROM contents WHERE status = 'published' ORDER BY created_at DESC LIMIT ? OFFSET ?";
        return $this->fetchAll($sql, [$perPage, $offset]);
    }

    /**
     * Obtener estadísticas de contenidos
     */
    public function getStats()
    {
        $sql = "SELECT
                    COUNT(*) as total,
                    COUNT(CASE WHEN status = 'published' THEN 1 END) as published,
                    COUNT(CASE WHEN status = 'draft' THEN 1 END) as draft,
                    SUM(views) as total_views
                FROM contents";

        return $this->fetchOne($sql);
    }
}
?>

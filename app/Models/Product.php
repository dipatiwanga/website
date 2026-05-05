<?php

class Product {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($keyword = null, $offset = 0, $limit = 6) {
        $query = "SELECT * FROM " . $this->table_name;
        
        if ($keyword) {
            $query .= " WHERE caption LIKE :keyword";
        }
        
        $query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        if ($keyword) {
            $keyword = "%{$keyword}%";
            $stmt->bindParam(':keyword', $keyword);
        }
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($keyword = null) {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        
        if ($keyword) {
            $query .= " WHERE caption LIKE :keyword";
        }

        $stmt = $this->conn->prepare($query);

        if ($keyword) {
            $keyword = "%{$keyword}%";
            $stmt->bindParam(':keyword', $keyword);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function create($imagePath, $caption) {
        $query = "INSERT INTO " . $this->table_name . " (image_path, caption) VALUES (:image_path, :caption)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':image_path', $imagePath);
        $stmt->bindParam(':caption', $caption);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

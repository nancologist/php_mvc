<?php

class Post {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts() {
        $this->db->query('SELECT *, 
            posts.id AS postId, 
            users.id AS userId,
            posts.created_at AS postCreated,
            users.created_at AS userCreated
            FROM posts
            INNER JOIN users ON posts.user_id = users.id
            ORDER BY posts.created_at DESC
        ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addPost($data) {
        $this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
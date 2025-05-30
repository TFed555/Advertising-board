<?php
require __DIR__.'/../models/Adverts.php';

class ApiController {
    public function handleCategory() {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['category'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Категория не указана']);
            return;
        }

        $category = trim($data['category']);

        $slug = strtolower(preg_replace('/[^a-zA-Zа-яА-Я0-9]+/u', '-', $category));
        $slug = trim($slug, '-');

        echo json_encode([
            'success' => true,
            'category' => $category,
            'redirect_url' => "/categories/$slug"
        ]);
    }
}

<?php

class Adverts {
    public static function findByCategory($category_id, $page, $perPage, $sort) {
        $offset = ($page-1)*$perPage;
        $orderBy = '';
        switch ($sort) {
            case 'created_at_desc':
                $orderBy = 'created_at DESC';
                break;
            case 'created_at_asc':
                $orderBy = 'created_at ASC';
                break;
            case 'price_desc':
                $orderBy = 'price DESC';
                break;
            case 'price_asc':
                $orderBy = 'price ASC';
                break;
            case 'title_asc':
                $orderBy = 'title ASC';
                break;
            case 'title_desc':
                $orderBy = 'title DESC';
                break;
            default:
                $orderBy = 'created_at DESC';
        }

        $db = Database::getPdo();
        $query = $db->prepare("
        SELECT * FROM ads
        WHERE category_id = :category_id
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
    ");

    $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $query->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query -> fetchAll();
    }

    public static function countByCategory($category_id) {
        $query = Database::query(
        "SELECT COUNT(*) as total FROM ads WHERE category_id = ?",
        [$category_id]
        );

        return $query->fetch()['total'];
    }

    public static function getCategory($id) {
        $query = Database::query(
            "Select * From categories where id = ? LIMIT 1", [$id]
        );
        $category =  $query->fetch();

        switch($category['id']) {
            case 1:
                $category['title'] = 'Машины';
                break;
            case 2:
                $category['title'] = 'Квартиры и дачи';
                break;
            case 3:
                $category['title'] = 'Одежда и обувь';
                break;
            case 4:
                $category['title'] = 'Всё для дома';
                break;
            case 5:
                $category['title'] = 'Красота и здоровье';
                break;
            case 6:
                $category['title'] = 'Электроника и техника';
                break;
        }

        return $category;
    }

}
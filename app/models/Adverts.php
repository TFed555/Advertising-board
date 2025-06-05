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
            SELECT
                ads.*,
                im.img_path_preview AS img_path_preview
            FROM
                ads
            LEFT JOIN (
                SELECT
                    ad_id,
                    img_path,
                    img_path_preview,
                    ROW_NUMBER() OVER (PARTITION BY ad_id ORDER BY id) AS rn
                FROM
                    ad_images
            ) im ON ads.id = im.ad_id AND im.rn = 1
            WHERE
                ads.category_id = :category_id
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

    public static function findByUserId($userId) {
        $query = Database::query('Select * from ads inner join ad_images on ads.id = ad_images.ad_id
        where user_id = ? order by created_at DESC', [$userId]);

        return $query->fetchAll();
    }

    public static function create($userId, $title, $description, $price, $category_id) {
        $query = Database::query("
            INSERT INTO ads (user_id, category_id, title, description, price, is_active)
            values (?, ?, ?, ?, ?, ?)
        ", [$userId, $category_id, $title, $description, $price, true]);

        return Database::lastInsertId();
    }

    public static function attachPhoto($ad_id, $filename, $preview, $img_path, $img_path_preview) {
        $query = Database::query("INSERT INTO ad_images (ad_id, filename, preview_filename, img_path, img_path_preview)
                values (?, ?, ?, ?, ?)",
         [$ad_id, $filename, $preview, $img_path, $img_path_preview]);

        return $query->rowCount() > 0;
    }

    public static function search($slug, $find, $limit, $offset) {
        $db = Database::getPdo();
        $query = $db->prepare("
            SELECT
                ads.*,
                im.img_path_preview AS img_path_preview
            FROM
                ads
            LEFT JOIN (
                SELECT
                    ad_id,
                    img_path,
                    img_path_preview,
                    ROW_NUMBER() OVER (PARTITION BY ad_id ORDER BY id) AS rn
                FROM
                    ad_images
            ) im ON ads.id = im.ad_id AND im.rn = 1
            WHERE
                ads.category_id = :category_id AND (ads.title LIKE :q OR ads.description LIKE :q OR ads.user_id LIKE :q)
            LIMIT :limit OFFSET :offset
        ");

        $query->bindValue(':category_id', $slug, PDO::PARAM_INT);
        $query->bindValue(':q', "%$find%", PDO::PARAM_STR);
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        return $query -> fetchAll();
    }

    public static function countSearchResults($slug, $find) {
            $db = Database::getPdo();
            $query = $db->prepare("
                SELECT COUNT(*) as total FROM ads
                WHERE category_id = :category_id AND (ads.title LIKE :q OR ads.description LIKE :q or ads.user_id LIKE :q)
            ");
            $query->bindValue(':category_id', $slug, PDO::PARAM_INT);
            $query->bindValue(':q', "%$find%", PDO::PARAM_STR);
            $query->execute();

            return (int)$query->fetchColumn();
    }
}
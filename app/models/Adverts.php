<?php

class Adverts {
    public static function findByCategory($category_id) {
        $query = Database::query(
            "Select * From ads where category_id = ?", [$category_id]
        );
        return $query -> fetchAll();
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
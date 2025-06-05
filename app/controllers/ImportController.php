<?php

require_once __DIR__."/../models/Adverts.php";
require_once __DIR__."/AdController.php";

class ImportController {
    public function show() {
        require __DIR__.'/../views/upload_xml.php';
    }
    public function uploadXml() {
        if (!isset($_FILES['xml_file']) || $_FILES['xml_file']['error'] !== UPLOAD_ERR_OK) {
            die('Ошибка загрузки файла.');
        }

        $xmlPath = $_FILES['xml_file']['tmp_name'];
        $xmlContent = file_get_contents($xmlPath);

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent);

        if ($xml === false) {
            die('Неверный XML-файл.');
        }

        $uploadDir = __DIR__ . '/../../public/uploads/';
        $watermarkPath = __DIR__ . '/../../public/assets/watermark.png';

        $importedCount = 0;
        $errors = [];

        foreach ($xml->ads->ad as $index => $ad) {
            try{
            $title = (string) $ad->title;
            $description = (string) $ad->description;
            $price = (float) $ad->price;
            $categoryId = (int) $ad->category_id;
            $userId = $_SESSION['user_id'];
            $is_active = (bool) $ad->is_active;

            if (!$title || !$description || !$price || !$categoryId || !$userId) {
                throw new Exception("Недостаточно данных в объявлении #" . ($index + 1));
            }

            $adId = Adverts::createFromImport($userId, $categoryId, $title, $description, $price, $is_active);

            if (!$adId) {
                throw new Exception("Ошибка при создании объявления в базе данных (объект #" . ($index + 1) . ")");
            }

            if (!empty($ad->image)) {
                $imageBase64 = (string)$ad->image;
                $imageData = base64_decode($imageBase64);

                $newName = uniqid('img_') . '.jpg';
                $previewName = 'preview_' . $newName;

                $targetPath = $uploadDir . $newName;
                $previewPath = $uploadDir . $previewName;
                file_put_contents($targetPath, $imageData);
                if (!getimagesize($targetPath)) {
                    error_log("Файл не является изображением: $targetPath");
                    continue;
                }
                AdController::createPreviewWithWatermark($targetPath, $previewPath, $watermarkPath, $newName);

                $img_path = './uploads/' . $newName;
                $img_path_preview = './uploads/' . $previewName;

                Adverts::attachPhoto($adId, $newName, $previewName, $img_path, $img_path_preview);
            }

            $importedCount++;
            } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        }

        $success = "Импорт завершен: успешно — $importedCount, ошибок — " . count($errors);

    require __DIR__.'/../views/upload_xml.php';

    // Можно также вывести ошибки в интерфейсе
    if (!empty($errors)) {
        echo "<h3>Ошибки при импорте:</h3><ul>";
        foreach ($errors as $msg) {
            echo "<li>" . htmlspecialchars($msg) . "</li>";
        }
        echo "</ul>";
    }

    }
}
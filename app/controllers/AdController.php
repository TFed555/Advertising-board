<?php

require_once __DIR__.'/../models/Adverts.php';

class AdController {
    public function handleAd() {
        require __DIR__.'/../views/add_new.php';
    }

    private function createPreviewWithWatermark($srcPath, $previewPath, $watermarkPath) {
            $image = imagecreatefromstring(file_get_contents($srcPath));
            $width = 200;
            $height = 200;

            $preview = imagecreatetruecolor($width, $height);
            imagecopyresampled($preview, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));

            $watermark = imagecreatefrompng($watermarkPath);
            $wmWidth = imagesx($watermark);
            $wmHeight = imagesy($watermark);
            imagecopy($preview, $watermark, $width - $wmWidth - 10, $height - $wmHeight - 10, 0, 0, $wmWidth, $wmHeight);

            imagejpeg($preview, $previewPath, 85);

            imagedestroy($image);
            imagedestroy($preview);
            imagedestroy($watermark);

    }

    public function create() {
        if (!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            $adId = Adverts::create($user_id, $title, $description, $price, $category);

            $uploadDir = __DIR__ . '/../../public/uploads/';
            $watermarkPath = __DIR__ . '/../../public/assets/watermark.png';

            foreach ($_FILES['photos']['tmp_name'] as $index => $tmpName) {
                $originalName = $_FILES['photos']['name'][$index];
                $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                $newName = uniqid('img_') . '.' . $ext;

                $targetPath = $uploadDir . $newName;

                $previewName = 'preview_' . $newName;
                $imgPath = './uploads/'.$newName;
                $imgPath_preview = './uploads/'.$previewName;

                if (move_uploaded_file($tmpName, $targetPath)){
                    $previewPath = $uploadDir . 'preview_' . $newName;
                    self::createPreviewWithWatermark($targetPath, $previewPath, $watermarkPath, $newName);
                    Adverts::attachPhoto($adId, $newName, $previewName, $imgPath, $imgPath_preview);
                }
            }

            // echo json_encode(['success' => true]);
            require __DIR__.'/../views/add_new.php';
            exit;
        }
    }
}
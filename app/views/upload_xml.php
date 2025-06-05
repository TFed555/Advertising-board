<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Импорт xml</title>
</head>
<body>
     <form method="POST" action="/uploadxml" enctype="multipart/form-data">
        <input type="file" name="xml_file" accept=".xml" required>
        <button type="submit">Импортировать xml-файл с объявлениями</button>
      </form>
      <p><?= htmlspecialchars($success ?? "") ?></p>
</body>
</html>
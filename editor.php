<?php
$filename = "content.txt";

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $content = $_POST['content'];

    // Записываем содержимое в файл
    if (file_put_contents($filename, $content)) {
        $message = "✅ Файл успешно сохранен!";
    } else {
        $message = "❌ Ошибка при сохранении файла!";
    }
}

// Читаем текущее содержимое файла (если файл существует)
if (file_exists($filename)) {
    $currentContent = file_get_contents($filename);
} else {
    $currentContent = "";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/main.css">

    <title>Редактор файла</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
            margin-top: 0;
        }

        textarea {
            width: 100%;
            height: 300px;
            padding: 10px;
            font-family: monospace;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #e8f5e8;
            color: #2e7d32;
            border-left: 4px solid #4CAF50;
        }

        .info {
            background-color: #e3f2fd;
            color: #1976d2;
            border-left-color: #2196F3;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .filename {
            background-color: #f0f0f0;
            padding: 5px 10px;
            border-radius: 3px;
            font-family: monospace;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📝 Редактор файла</h1>

        <div class="filename">
            Файл: <?php echo htmlspecialchars($filename); ?>
        </div>

        <?php if (isset($message)): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if (!file_exists($filename)): ?>
            <div class="info">
                ℹ️ Файл еще не создан. Введите текст и нажмите "Сохранить", чтобы создать файл.
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <textarea name="content" placeholder="Введите текст здесь..."><?php
                echo htmlspecialchars($currentContent); ?>
            </textarea>
            <br>
            <button type="submit">💾 Сохранить</button>
        </form>
    </div>
</body>
</html>

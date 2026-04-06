<?php
/*
 * Return file content
 *
 * @param string    $filename Path to file
 * @return string   File content or empty string, if file does not exist
 */
function getFileContent($filename) {
    if (file_exists($filename)) {
        return file_get_contents($filename);
    } else {
        return "";
    }
}

$filename = "content.txt";
$currentContent = getFileContent($filename);

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if (isset($_POST['content'])) {
            $content = $_POST['content'];

            // Записываем содержимое в файл
            if (file_put_contents($filename, $content)) {
                $message = "✅ Файл успешно сохранен!";
            } else {
                $message = "❌ Ошибка при сохранении файла!";
            }
        }
    } elseif (isset($_POST['refresh'])) {
        // Обновление содержимого из файла
        $currentContent = getFileContent($filename);
        if (file_exists($filename)) {
            $message = "🔄 Содержимое обновлено из файла!";
        } else {
            $message = "❌ Файл еще не создан!";
        }
    }
}

$currentContent = getFileContent($filename);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/main.css">

    <title>4you</title>
</head>
<body>
    <div class="container">
        <h1>📝 Заметки</h1>

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
            <button type="submit" name="save" value="1">💾 Сохранить</button>
            <button type="submit" name="refresh" value="1">🔄 Обновить контент</button>
        </form>
    </div>
</body>
</html>

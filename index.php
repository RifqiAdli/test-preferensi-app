<?php
// index.php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    
    // Insert user
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    $conn->query($sql);
    $user_id = $conn->insert_id;
    
    // Insert responses
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') === 0) {
            $question_number = substr($key, 9);
            $answer = $conn->real_escape_string($value);
            $sql = "INSERT INTO responses (user_id, question_number, answer) 
                    VALUES ($user_id, $question_number, '$answer')";
            $conn->query($sql);
        }
    }
    
    $_SESSION['success'] = "Terima kasih telah mengisi tes preferensi!";
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Preferensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">Tes Preferensi</h1>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div class="space-y-4">
                    <div>
                        <label class="block mb-2">Nama:</label>
                        <input type="text" name="name" required
                               class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-2">Email:</label>
                        <input type="email" name="email" required
                               class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>

                <?php foreach (QUESTIONS as $number => $question): ?>
                    <div class="space-y-2">
                        <p class="font-medium"><?= $number ?>. <?= $question ?></p>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="question_<?= $number ?>" value="A" required
                                       class="form-radio">
                                <span>A. <?= OPTIONS[$number]['A'] ?></span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="question_<?= $number ?>" value="B" required
                                       class="form-radio">
                                <span>B. <?= OPTIONS[$number]['B'] ?></span>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>

                <button type="submit" 
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                    Submit
                </button>
            </form>
        </div>
    </div>
</body>
</html>
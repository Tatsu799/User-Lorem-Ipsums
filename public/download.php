<?php
require_once 'vendor/autoload.php';
require_once 'Models/User.php';
require_once 'Helpers/RandomGenerator.php';

spl_autoload_extensions(".php");
spl_autoload_register(function ($className) {
  $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
  if (file_exists($classPath)) {
    require_once $classPath;
  }
});

use Helpers\RandomGenerator;

// POSTリクエストからパラメータを取得
$count = $_POST['count'] ?? 5;
$format = $_POST['format'] ?? 'html';

// パラメータが正しい形式であることを確認
$count = (int)$count;

// 検証
if (is_null($count) || is_null($format)) {
  exit('Missing parameters.');
}

if (!is_numeric($count) || $count < 1 || $count > 100) {
  exit('Invalid count. Must be a number between 1 and 100.');
}

$allowedFormats = ['json', 'txt', 'html', 'md'];
if (!in_array($format, $allowedFormats)) {
  exit('Invalid type. Must be one of: ' . implode(', ', $allowedFormats));
}

// ユーザーを生成
$users = RandomGenerator::users($count, $count);
// $restaurantChains = RandomGenerator::restaurantChains($count, $count);

if ($format === 'markdown') {
  header('Content-Type: text/markdown');
  header('Content-Disposition: attachment; filename="users.md"');
  foreach ($users as $user) {
    echo $user->toMarkdown();
  }
} elseif ($format === 'json') {
  header('Content-Type: application/json');
  header('Content-Disposition: attachment; filename="users.json"');
  $usersArray = array_map(fn($user) => $user->toArray(), $users);
  echo json_encode($usersArray);
} elseif ($format === 'txt') {
  header('Content-Type: text/plain');
  header('Content-Disposition: attachment; filename="users.txt"');
  foreach ($users as $user) {
    echo $user->toString();
  }
} else {
  // HTMLをデフォルトに
  header('Content-Type: text/html');
  foreach ($users as $user) {
    echo $user->toHTML();
  }
}

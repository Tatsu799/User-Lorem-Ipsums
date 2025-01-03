<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php");
// spl_autoload_register();
spl_autoload_register(function ($className) {
  $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
  if (file_exists($classPath)) {
    require_once $classPath;
  }
});

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 2;
$max = $_GET['max'] ?? 10;

// パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

$restaurantChains = RandomGenerator::restaurantChains($min, $max);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BootstrapのCSS (CDNを使用する場合) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>User Profiles</title>
  <style>
    /* ユーザーカードのスタイル */
    /* .container {} */

    .name {
      text-align: center;
      padding: 1rem;
    }

    .restaurant-card {
      border: solid 1px rgba(0, 0, 0, .2);
    }

    .title {
      border-bottom: solid 1px rgba(0, 0, 0, .2);
      padding: 0.5rem;
      background-color: rgba(175, 171, 171, 0.2);
    }

    .accordion {
      padding: 1rem;
    }

    .employee-info {
      border: solid 1px rgba(0, 0, 0, .2);
      padding: 1rem;
    }
  </style>
</head>

<body>
  <?php foreach ($restaurantChains as $restaurantChain): ?>
    <h1 class="name">Restaurant <?php echo $restaurantChain->name ?></h1>

    <div class="container">
      <div class="restaurant-card">
        <p class="title">Restauarant Chain Information</p>
        <div class="accordion" id="accordionExample">
          <?php foreach ($restaurantChain->restaurantLocations as $index => $restaurantLocation): ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="heading-<?php echo $index ?>">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $index; ?>">
                  <?php echo $restaurantLocation->name ?>
                </button>
              </h2>
              <div id="collapse-<?php echo $index; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p><?php echo $restaurantLocation->showCompanyInfo() ?></p>
                  <hr>
                  <h3>Employees:</h3>
                  <?php foreach ($restaurantLocation->employees as $employee): ?>
                    <p class="employee-info"><?php echo $employee->toString() ?></p>
                  <?php endforeach; ?>
                  <?php  ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js">
  </script>
</body>

</html>
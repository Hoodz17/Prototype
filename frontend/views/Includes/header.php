<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    document.getElementsByTagName("html")[0].className += " js";
  </script>
  <!-- favicon -->
  <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
  <!-- font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= URLROOT ?>assets/css/style.css">
  <title><?= $this->buildPageTitle($data); ?>YFS</title>
</head>

<body style="background-color: #748bbf;">
  <main class="bg-bottom-right bg-no-repeat" style="background-image: url(<?= URLROOT ?>assets/img/chainsaw_background.jpg); background-attachment: fixed;">
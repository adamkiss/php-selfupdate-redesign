<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Github Hook debug</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type="text/css">
    * {
      padding: 0;
      margin: 0;
      bottom: 0;
    }
    .wrapper {
      max-width: 1000px;
      margin: 0 auto;
      padding-top: 60px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
<?php
  require_once __DIR__.'/vendor/autoload.php';
  use Tracy\Debugger;
  Debugger::enable(Debugger::DEVELOPMENT);

  dump($_POST);
?>
  </div>
</body>
</html>
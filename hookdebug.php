<?php

  ob_start(); ?>
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
    pre {
      font: 400 1.2em/1.6 "Source Code Pro";
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <h1><?= date('d M Y H:i:s');?></h1>
    <pre>
<?php

  if (!empty($_POST['payload'])) {
    $payload = json_decode($_POST['payload']);
    var_dump($payload);
  else{
    echo "<h1>PAYLOAD EMPTY WAT</h1>";
  }
?>
</pre>
  </div>
</body>
</html><?php

  $debug_output = ob_get_contents();
  $result = file_put_contents(__DIR__.'/_output/output.html', $debug_output);
  ob_end_clean();
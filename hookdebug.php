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
  <!-- ngrok -subdomain=ghhooktest lghlocal.dev:80 -->
  <div class="wrapper">
    <h1><?= date('d M Y H:i:s'); ?></h1>
    <pre><?php
      $input = file_get_contents ("php://input");

      function copy_github_file($filename) {
        $file = file_get_contents("https://raw.githubusercontent.com/adamkiss/rdsgn.adamkiss.com/master/{$filename}");
        // if file exists in raw repo
        if (!empty($file)) {
          $result = file_put_contents(__DIR__."/{$filename}", $file);
          return $result;
        }else{
          return null;
        }
      }

      if (!empty($input)) {
        $json = json_decode($input);
        $commit = $json->commits[0];
        foreach ($commit->added as $fn){
          copy_github_file($fn);
        }
        foreach ($commit->modified as $fn){
          if ($fn !== 'hookdebug.php'){
            copy_github_file($fn);
          }
        }
        foreach
      }else{
        echo ":(";
      }

    ?></pre>
  </div>
</body>
</html><?php

  $debug_output = ob_get_contents();
  $result = file_put_contents(__DIR__.'/_output/output.html', $debug_output);
  ob_end_flush();
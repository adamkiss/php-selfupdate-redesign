<!doctype html>
<?php

  function h2($s) { echo "<h2>{$s}</h2>"; }
  function h3($s) { echo "<h3>{$s}</h3>"; }
  function h2_dump($s, $v) { h2($s); dump($v); }
  function h2_result($s, $v) { h2($s); echo "<div class='result'>{$v}</div>"; }

  require 'lib/tracy-2.2.3/src/tracy.php';
  use Tracy\Debugger;
  Debugger::enable(Debugger::DEVELOPMENT);

  $t=[]; function t($s) {global $t; $t[$s] = Debugger::timer($s); }
  Debugger::timer('page');
  function timer($k) {
    global $t;
    echo sprintf('<p class="timer">Task <em>%s</em> finished in <b>%.2f ms</b>.</p>', $k, $t[$k] * 1000);
  }

  //Spyc::YAMLLoad('spyc.yaml')
  require 'lib/yaml-spyc/Spyc.php';
  // Yaml::parse($file)
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Exception/ExceptionInterface.php';
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Exception/RuntimeException.php';
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Exception/ParseException.php';
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Unescaper.php';
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Inline.php';
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Parser.php';
  require 'lib/yaml-symfony/Symfony/Component/Yaml/Yaml.php';
  use Symfony\Component\Yaml\Yaml;

  require 'lib/parsedown/Parsedown.php';
  $P = new Parsedown();
  require 'lib/parsedown-extra/ParsedownExtra.php';
  $PE = new ParsedownExtra();


  $q = $_SERVER['QUERY_STRING'];
  $titles = [
    't=yaml' => 'YAML Render',
    't=traverse' => 'Traverse directories',
    't=speed&o=2' => 'Speed medium size',
    't=speed&o=3' => 'Speed large size'
  ];
  $title = $titles[$q];

  function glob_rec($path){
    $result = glob($path.'*', GLOB_MARK);
    foreach ($result as $i=>$item){
      if (substr($item, -1) === '/'){
        $result[$i] = glob_rec($item);
      }
    }
    return $result;
  }

  ob_start();
//
  switch ($_GET['t']){
    case 'yaml':
      echo "<h2>100&times; load file</h2>";
      Debugger::timer('spyc_100');
      for ($i=1;$i<=200;$i++){
        $c_yaml = Spyc::YAMLLoad('content/01-md-test/test.ymd');
      }
      t('spyc_100'); timer('spyc_100');

      Debugger::timer('symf_100');
      for ($i=1;$i<=200;$i++){
        $f_yaml = Yaml::parse('content/01-md-test/test.ymd');
      }
      t('symf_100'); timer('symf_100');

      h2('Parsedown result: 200&times;');

      t('Spyc+Parsedown');
      for ($i=1;$i<=200;$i++){ $c_pd = $P->parse($c_yaml['Content_']); }
      t('Spyc+Parsedown'); timer('Spyc+Parsedown');
      t('Spyc+ParsedownExtra');
      for ($i=1;$i<=200;$i++){ $c_pde = $PE->parse($c_yaml['Content_']); }
      t('Spyc+ParsedownExtra'); timer('Spyc+ParsedownExtra');
      t('Symfony+Parsedown');
      for ($i=1;$i<=200;$i++){ $f_pd = $P->parse($f_yaml['Content_']); }
      t('Symfony+Parsedown'); timer('Symfony+Parsedown');
      t('Symfony+ParsedownExtra');
      for ($i=1;$i<=200;$i++){ $f_pde = $PE->parse($f_yaml['Content_']); }
      t('Symfony+ParsedownExtra'); timer('Symfony+ParsedownExtra');

      h2_result('Spyc+PE', $c_pde);
      h2_result('Symfony+PE', $f_pde);

      h2_dump('Spyc YAML:', $c_yaml);
      h2_dump('Symfony YAML:', $f_yaml);
    break;
    case 'traverse':
      h2('Folder traversing');
      $sites = array_reverse(array_diff(scandir('content/03-sites'), ['.','..']));

      // $sites = array_slice($sites, 0, 1);

      foreach($sites as $site) {
        h3($site);

        $path = 'content/03-sites/'.$site;

        t('glob recursive');
        $glob_files = glob_rec($path.'/');
        echo "<p>Glob: Total <b>".count($glob_files, 1)."</b> files.</p>";
        t('glob recursive'); timer('glob recursive');

        t('ReadDir');
        $rd_files = [];
        if ($handle = opendir($path)) {
          while (false !== ($file = readdir($handle))) {
            if ($file != '.' || $file != '..'){
              $rd_files []= $file;
            }
          }
        }
        echo "<p>ReadDir: Total <b>".count($glob_files, 1)."</b> files.</p>";
        t('ReadDir'); timer('ReadDir');


        t('DirectoryIterator');
        $di_files = [];
        $dir_iterator = new RecursiveDirectoryIterator(realpath($path));
        $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $name => $file){
          if (substr($name, -1) !== '.') {
            $di_files []= $name;
          }
        }
        echo "<p>DirectoryIterator: Total <b>".count($glob_files, 1)."</b> files.</p>";
        t('DirectoryIterator'); timer('DirectoryIterator');

        echo "<hr>";
      }

    break;
    case 'speed':
      echo "<h2>File reading speed</h2>";
    break;
  }
//
  $yield = ob_get_contents();
  ob_end_clean();
?>
<html lang="sk">
<head>
  <meta charset="utf-8">

  <title><?= $title; ?> • ymd-test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Pure stylesheet -->
  <link rel="stylesheet" href="/assets/pure/pure.css">


  <link rel="stylesheet" href="assets/style.css?v=1.0">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
  <?= 'eyooo'; ?>
</body>
</html>
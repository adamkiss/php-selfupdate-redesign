<?php

// rewrite file function
function write_file($filename) {
  // be totally safe
  if (strpos($filename, '..') !== false) {

    // does the file's directory exist?
    if (!file_exists(dirname($filename))){
      // create it it.
      mkdir(dirname($filename), 0777, true);
    }

    // read the file
    $gh_url = "https://raw.githubusercontent.com/adamkiss/php-selfupdate-redesign/master";
    $gh_file_contents = file_get_contents("{$gh_url}/{$filename}");

    //write the file, if not empty (why would it be? bad network?)
    if (!empty($gh_file_contents)) {
      $result = file_put_contents(__DIR__."/{$filename}", $contents);
    } else {
      $result = 'GH File empty';
    }
  } else {
    // ignore. Dum dum dum
    $result = 'Ignored';
  }

  return $result;
}

// read input json
$input = file_get_contents ("php://input");

if (!empty($input)) {

  $github_json = json_decode($input);

  // updated first
  foreach ($json->commits[0]->modified as $filename){
    echo "[*] {$filename}: ";
    $result = write_file($filename);
    echo "{$result}\n";
  }

  // now new
  foreach ($json->commits[0]->added as $filename){
    echo "[+] {$filename}: ";
    $result = write_file($filename);
    echo "{$result}\n";
  }

  // removed ignore. Because diskspace is cheap-o

  echo "Done.";

}else{

  echo "No input :(";

}
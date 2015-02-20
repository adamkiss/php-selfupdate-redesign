<?php

  error_reporting(E_ALL);

  $request = trim($_GET['req']);

  $use_cache = file_exists('../.bypass_cache');
  $cached = false;

  if ($use_cache && $cached){
    // Load Cache
  }else{
    echo " Hello. This is v0.1. You requested: {$request}";

    // Load URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://processwire.com/{$request}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $pw_page = curl_exec($ch);
    curl_close($ch);

    $pw_page_code = htmlentities($pw_page);

    echo "<pre>{$pw_page_code}</pre>";

    // Be nice (clean up tracking code)

    // Add custom CSS/JS

    // Load any custom modification from ../pages/*

    // Cache file
  }
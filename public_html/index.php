<?php

  $request = trim($_GET['request']);

  $use_cache = false;
  $cached = false;

  if ($use_cache && $cached){

  }else{
    echo " Hello. This is v0.1. You requested: {$_GET['req']}";
  }
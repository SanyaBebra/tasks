<?php

  $connect = mysqli_connect('localhost', 'root', '', 'tasks');

  if (!$connect) {
    die('Error connect of Date Base');
  }
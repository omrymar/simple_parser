<?php
//calculation functions
require_once('results.php');

$options = array(
    'instruction' => isset($_POST['instruction']) ? $_POST['instruction'] : '',);

if(!empty($_POST)) {
  include_once('show_results.php');
} else {
  include_once('main.php');
}


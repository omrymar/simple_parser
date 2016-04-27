<?php
//calculation functions
require_once('results.php');

$options = array(
    'dice_type' => isset($_POST['dice_type']) ? $_POST['dice_type'] : 6,
    'min_value' => isset($_POST['min_value']) ? $_POST['min_value'] : 1,
    'count' => isset($_POST['count']) ? $_POST['count']: 0,
    'trigger' => isset($_POST['trigger']) ? $_POST['trigger'] : 0,
    'instruction' => isset($_POST['instruction']) ? $_POST['instruction'] : "Please, repeat once more",
    );

if(!empty($_POST)) {
  include_once('show_results.php');
} else {
  include_once('main.php');
}

<?php

function get_dice_results($dice_type, $count) {
  $results = array();
  for($i = 0; $i < $count; $i++) {
    $results[] = rand(1, $dice_type);
  }
  return $results;
}

 function filter_wrapper($dice_type, $count, $evaluation, $min_value ,$trigger) {
   $results = get_dice_results($dice_type, $count);

   switch($evaluation){
     case "=":
       for($i=0; $i<$count; $i++){
         if ($results[$i] != $min_value){ //Відкидаємо всі, що не рівні мінімальному
           unset($results[$i]);
         }
       }
       break;
     case ">":
       for($i=0; $i<$count; $i++){
         if ($results[$i] <= $min_value){
           unset($results[$i]);
         }
       }
       break;
     case ">=":
       for($i=0; $i<$count; $i++){
         if ($results[$i] < $min_value){
           unset($results[$i]);
         }
       }
       break;
     case "<":
       for($i=0; $i<$count; $i++){
         if ($results[$i] >= $min_value){
           unset($results[$i]);
         }
       }
       break;
     case "<=":
       for($i=0; $i<$count; $i++){
         if ($results[$i] > $min_value){
           unset($results[$i]);
         }
       }
       break;
   }
 // Визначаємо, як буде відсортований масив
  if ($trigger == "asc"){
    sort($results);
    return $results;
  } elseif ($trigger == "desc"){
    rsort($results);
    return $results;
  }
 }

function parser($instruction) {
  //$instruction = "throw 10 d20 filter >= 10 sort desc";
  if ($instruction != "") {
    $mass_input = explode(" ", $instruction);

    if ($mass_input[0] != 'throw') {
      throw new Exception("Error");
    }
    // Перевіряємо, чи є 2-й елемент масиву числом...
    if (is_numeric($mass_input[1])) {
      $count = $mass_input[1];
    }
    // Повертаємо підрядок, рядка №3 починаючи із 1-го елемента, оскільки 0-й ми повинні відкинути
    if ($mass_input[2] != "") {
      $dice_type = substr("$mass_input[2]", 1);
    }
    //Перевіряємо, чи рівний нулю фільтр. Якщо так, то виводимо результат без сортування та відкидання виключень.
    if (($mass_input[3] == "") && ($mass_input[4] == "") && ($mass_input[5] == "") && ($mass_input[6] == "") && ($mass_input[7] == "")) {
      return get_dice_results($dice_type, $count);
    }
    //Встановлюємо, який діапазон значень буде виведено
    if (($mass_input[4] == "=") || ($mass_input[4] == ">") || ($mass_input[4] == ">=") || ($mass_input[4] == "<") || ($mass_input[4] == "<=")) {
      $evaluation = $mass_input[4];
    }
    if (is_numeric($mass_input[5])) {
      $min_value = $mass_input[5];
    }
    if ($mass_input[6] != "sort") {
      throw new Exception("Error");
    }
    if (($mass_input[7] == "desc") || ($mass_input[7] == "asc")) {
      $trigger = $mass_input[7];
    }
  } else {
    throw new Exception("Error");
    //echo "Error";
  }
 return filter_wrapper($dice_type, $count, $evaluation, $min_value, $trigger);
}

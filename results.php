<?php

function get_dice_results($dice_type, $count) {
    $results = array();
    for($i = 0; $i < $count; $i++) {
        $results[] = rand(1, $dice_type);
      }
  return $results;
}

 function filter_wrapper($dice_type, $count, $evaluation, $min_value, $trigger) {
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

  }else{
      return $results;
  }
 }

function parser($instruction){

   global $evaluation, $min_value, $trigger;
    
   $evaluation = '';
   $min_value = 1;
   $trigger = 0;

    //$instruction = "throw 10 d20 filter >= 10 sort desc";

    if (isset($instruction)) {
        $mass_input = explode(' ', $instruction);
    if ($mass_input[0] == 'throw'){
        $count = $mass_input[1];
    }else{
        echo 'Поле запроса пустое. Пожалуйста, повторите запрос ище раз.'."<br>";
        exit();
    }
    // Повертаємо підрядок, рядка №3 починаючи із 1-го елемента, оскільки 0-й ми повинні відкинути
    if (strpos($mass_input[2],'d') == 0) {
            $dice_type = substr("$mass_input[2]", 1);
    }

    if (isset($mass_input[3])){
        if($mass_input[3] == 'filter'){
            $evaluation = $mass_input[4];
            $min_value = $mass_input[5];
        }
    }
    if (isset($mass_input[6])){
       if ($mass_input[6] == 'sort'){
           $trigger = $mass_input[7];
       }
    }

    if (isset($mass_input[3])){
        if ($mass_input[3] == 'sort'){
            $trigger = $mass_input[4];
        }
    }
  }
 //return array($dice_type, $count, $evaluation, $min_value, $trigger);
 return filter_wrapper($dice_type, $count, $evaluation, $min_value, $trigger);
}
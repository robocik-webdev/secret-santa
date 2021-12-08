<?php
  function getCsvFileAsJson($csv) {
    $delimeter = ';';
    $rows = 1000;
    if ($file = fopen($csv, 'r')) {
      // headers
      $keys = fgetcsv($file, $rows, $delimeter);
      // array of arrays
      $data = array();
      while ($row = fgetcsv($file, $rows, $delimeter)) {
        $data[] = $row;
      }
      fclose($file);
      return $data;
    }
  }

  $email = $_POST['email'];
  
  $people = getCsvFileAsJson('people.csv');
  srand(18122021);
  shuffle($people);

  $person = NULL;
  for ($i = 0; $i < count($people); $i++) {
    if ($people[$i][1] == $email) {
      if (array_key_exists($i + 1, $people)) {
        $person = $people[$i + 1];
      } else {
        $person = $people[0];
      }
      break;
    }
  }
  echo json_encode($person);
?>

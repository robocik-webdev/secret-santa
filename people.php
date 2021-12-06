<?php
  function getCsvFileAsJson($csv) {
    if ($file = fopen($csv, 'r')) {
      // get headers
      $key = fgetcsv($file, 1000, ',');
      // parse rows into an array
      $json = array();
      while ($row = fgetcsv($file, 1000, ',')) {
        $json[] = array_combine($key, $row);
      }
      fclose($file);
      return $json;
    }
  }

  $correctToken = getenv('TOKEN');
  $token = $_POST['token'];
  
  if ($token == $correctToken) {
    $people = getCsvFileAsJson('people.csv');
    srand(18122021);
    shuffle($people);
    echo json_encode($people);
  }
?>

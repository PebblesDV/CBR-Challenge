<?php

//roept de json file op en stop het in de variabel
$json = file_get_contents('public\assets/json/chapters.json');
//json file word ge decode. Eig omgezet naar een soort php array.
$json_data = json_decode($json, true);

//variable for the data 
$grouped_data = [];

foreach ($json_data as $items) {
  //zetten we de data van de category n de chapter in variabels.
  $category = $items['category'];
  $chapter = $items['chapter'];

  //zorgt ervoor dat de chapter bij de juiste categorie wordt gestopt. dit zorgt ervoor dat de juiste info bij elkaar blijft.
  $grouped_data[$category][] = $chapter;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Start Pagina</title>
</head>

<body>

  <?php include('header.php') ?>

  <?php

//for each loop voor de data
  foreach ($grouped_data as $category => $chapters) {
    foreach ($chapters as $chapter) {
  ?>

      <div onclick="window.location.href='question.php?chapter=<?= urlencode($chapter) ?>'">
        <!-- hier wordt de info van de catogorie en de chapter geplaats -->
        <p> Category: <?= $category ?>
        <br>
         Chapter: <?= $chapter ?></p>
      </div>
  <?php
    }
  }
  ?>

</body>

</html>
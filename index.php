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
  <link rel="stylesheet" href="css/start.css">
  <title>Start Pagina</title>
</head>

<body>

  <?php include('header.php') ?>

  <div class="all-info">

    <div class="start-txt-all">
      <p class="start-txt">Welkom bij het Theorie Examen Auto (rijbewijs B)</p>
      <p class="start-txt">Kies een categorie waar je het examen van wilt maken!</p>
      <p class="start-txt">Wanneer je klaar bent kun je weer terug naar dit scherm en het examen <br> opnieuw maken, of een andere categorie kiezen.</p>
    </div>

    <div class="category-all-cards">
      <?php

      //for each loop voor de data
      foreach ($grouped_data as $category => $chapters) {
        foreach ($chapters as $chapter) {
      ?>

          <div class="category-card">
            <!-- hier wordt de info van de catogorie en de chapter geplaats -->
            <p class="category-txt"> Category: <?= $category ?>
              <br>
              Chapter: <?= $chapter ?>
            </p>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>

</body>

</html>

<!-- onclick="window.location.href='question.php?chapter=<?= urlencode($chapter) ?>'" -->
<?php
//session unset zodat als je op de opnieuw maken knop drukt je bij de eerste vraag weer begint
session_start();
session_unset();

//info ophalen
$category = $_GET['category'];
$chapter = $_GET['chapter'];
$score = $_GET['score'];
$question_amount = $_GET['question_amount'];

//berekenen percentage
$percentage = $score / $question_amount * 100;

//text voor geslagen en niet geslagen.
   if ($percentage >= 50){
    $passedYorN = 'Jij bent geslaagd!';
   } else {
    $passedYorN = 'Jij bent niet geslaagd!';
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/results.css">
    <title>Resultaten</title>
</head>

<body>

    <?php include('header.php') ?>
    <div class="results-info">
        <div class="top-txt">
            <p class="score-txt">Je bent klaar met het Theorie Examen Auto (rijbewijs B)</p>
            <p class="score-txt">Category: <?=$category?> - Chapter: <?=$chapter?></p>
            <p class="score-txt">Bekijk hier onder jouw uitslag!</p>
        </div>


        <p class="score-txt">Jouw score is:</p>

        <div class="img-container">
            <img class="score-img" src="public/assets/img/verkeersbord.png" alt="score">
            <p class="img-txt"><?=round($percentage, 2)?>%</p>
        </div>

        <p class="score-txt"><?=$passedYorN?></p>

        <form action="question.php?chapter=<?= urlencode($chapter)?>" method="post">
            <input class="retake-btn" type="submit" name="retake-btn" value="Maak opnieuw">
        </form>

    </div>

</body>

</html>
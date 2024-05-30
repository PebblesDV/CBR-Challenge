<?php
$chapter = $_GET['chapter'];

//voor testen of het heeft gewerkt
// echo "You selected chapter: $chapter";

//Code voor de connectie van de vragen is op dit moment raar aan het doen, ga morgen(vandaag nu :D) vragen aan Martijn vgm  

  $questions_json = file_get_contents('public\assets/json/questions.json');

  // Check if file_get_contents succeeded
  if ($questions_json === false) {
      echo "Error: Unable to read JSON file.";
      exit;
  }

//Deze is degene die vervelend doet dus ff als comment houden :)
//   $questions_json_data = json_decode($questions_json, true); 

//   if ($questions_json_data === null) {
//       echo "Error: Unable to decode JSON data. " . json_last_error_msg();
//       exit;
//   }

//ge comment zodat hij geen errors geeft
//   $filtered_questions = array_filter($questions_json_data, function ($question) use ($chapter) {
//       return $question['category'] === $chapter;
//   });
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/question.css">
    <title>Vragen</title>
</head>

<body>

    <div class="question-page">

        <!-- heb de header even apart gezet zodat ik die in de andere pages ook makkelijk kon neerzetten:) -->
        <?php include('header.php') ?>

          <div>
            <img class="question-img" src="public/assets/img/401c.jpg" alt="img">
          </div>

          <div class="question-info">
              <p class="question qstn-txt">Hier komt dan de vraag?</p>
              <p class="description qstn-txt">Met hier dan een beschrijving over wat je op het plaatje ziet.</p>
          </div>

        <!-- dit is de code om door alle antwoorden heen te loopen en die te laten zien als dat eenmaal kan!! -->
        <!-- <?php foreach ($var as $key => $var) : ?>
                <div class="answer-card">
                    <p class="answer">Hier komt een antwoord</p>
                </div>
        <?php endforeach; ?> -->

        <!-- dit is alleen even hardcoded om te checken hoe het staat:)) -->
        <div class="all-answers">
            <div class="answer-card">
                <p class="answer">Hier komt een antwoord</p>
            </div>
            <div class="answer-card">
                <p class="answer">Hier komt een antwoord</p>
            </div>
            <div class="answer-card">
                <p class="answer">Hier komt een antwoord</p>
            </div>
            <div class="answer-card">
                <p class="answer">Hier komt een antwoord</p>
            </div>
        </div>

        <!-- met action en method zorgen dat hij naar volgende vraag gaat? -->
        <div class="next-btn">
            <form>
                <input class="button" type="submit" name="next-question-btn" value="Volgende">
            </form>
        </div>
    </div>

</body>

</html>
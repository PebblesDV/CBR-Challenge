<?php
session_start();
$chapter = $_GET['chapter'];

//Ding om de info op te halen van bij welke vraag je bent
if (!isset($_SESSION['question_index'])) {
    $_SESSION['question_index'] = 0;
}

//Om de question index te updaten :D
if (isset($_GET['next-question-btn'])) {
    $_SESSION['question_index'] += 1;
}

//De informatie voor de chapter ophallen
$chapters_json = file_get_contents('public/assets/json/chapters.json');
if ($chapters_json === false) {
    echo "Error: Unable to read chapters JSON file.";
    exit;
}
$chapters_data = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $chapters_json), true);
if ($chapters_data === null) {
    echo "Error: Unable to decode chapters JSON data. " . json_last_error_msg();
    exit;
}
//einde info voor chapters

//De juiste catogerie instellen
$category = null;
foreach ($chapters_data as $chapters_array) {
    if ($chapters_array['chapter'] === $chapter) {
        $category = $chapters_array['category'];
        break;
    }
}
if ($category === null) {
    echo "Error: Chapter not found in chapters.json.";
    exit;
}
//einde juiste catogerie instellen

//begin voor de vragen op te halen
$questions_json = file_get_contents('public/assets/json/questions.json');
if ($questions_json === false) {
    echo "Error: Unable to read questions JSON file.";
    exit;
}
$questions_data = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $questions_json), true);
if ($questions_data === null) {
    echo "Error: Unable to decode questions JSON data. " . json_last_error_msg();
    exit;
}
//einde

//begin voor vragen te filteren
$filtered_questions = array_values(array_filter($questions_data, function ($question) use ($category) {
    return $question['category'] === $category;
}));

//zorgt ervoor dat t hetzelfde is als de geupdate (of juist niet) index
$current_question_index = $_SESSION['question_index'];

//Tijdelijk. Zorgt ervoor dat de vragen door loopen enz :D
if ($current_question_index >= count($filtered_questions)) {
    $current_question_index = 0;
    $_SESSION['question_index'] = 0;
}

//zet de juiste vraag erin
$current_question = $filtered_questions[$current_question_index];
//einde vragen filteren
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

        <?php include('header.php') ?>

        <div>
            <img class="question-img" src="public/assets/img/<?= htmlspecialchars($current_question['image']) ?>" alt="img">
        </div>

        <div class="question-info">
            <p class="question qstn-txt"><?= htmlspecialchars($current_question['question']) ?></p>
            <!-- <p class="description qstn-txt">Met hier dan een beschrijving over wat je op het plaatje ziet.</p> -->
        </div>

        <div class="all-answers">
            <?php
            //checked of de opties niet leeg zijn ofzo
            if (isset($current_question['options']) && !empty($current_question['options'])) {
                // de loop om ze allenmaal te laten zien
                foreach ($current_question['options'] as $option) {
                    if (!empty($option)) {
            ?>
                        <div class="answer-card">
                            <p class="answer"><?= htmlspecialchars($option) ?></p>
                        </div>
            <?php
                    }
                }
            } ?>
        </div>


        <div class="next-btn">
            <form method="get">
                <input type="hidden" name="chapter" value="<?= htmlspecialchars($chapter) ?>">
                <input class="button" type="submit" name="next-question-btn" value="Volgende">
            </form>
        </div>
    </div>

</body>

</html>
<?php
session_start();
$chapter = $_GET['chapter'];

//Ding om de info op te halen van bij welke vraag je bent
if (!isset($_SESSION['question_index'])) {
    $_SESSION['question_index'] = 0;
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

//variabel voor error message aanmaken
$error_message = '';

//score als ie niet al bestaat
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

//antwoord is de eerste optie in de optie array want antwoorden zijn niet te vinden.
$correct_answer = $filtered_questions[$_SESSION['question_index']]['options'][0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['answer'])) {
        //zet de session als het geposte antwoord
        $_SESSION['answers'][$_SESSION['question_index']] = $_POST['answer'];

        //als het hetzelfde is
        if ($_POST['answer'] == $correct_answer) {
            $_SESSION['score'] += 1;
        }

        //Om naar de volgende vraag te gaan
        if ($_SESSION['question_index'] < count($filtered_questions) - 1) {
            $_SESSION['question_index'] += 1;
        } else {
            //dit stuurt je naar de resultaat pagina als je bij de laatste vraag bent en op de volgende knop drukt.
            header("Location: results.php?category=$category&chapter=$chapter&score={$_SESSION['score']}&question_amount=" . count($filtered_questions));
            exit;
        }
    } else {
        $error_message = "Please select an answer.";
    }
}

//zorgt ervoor dat t hetzelfde is als de geupdate (of juist niet) index
$current_question_index = $_SESSION['question_index'];

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
            <?php if ($error_message) : ?>
                <p class="error"><?= htmlspecialchars($error_message) ?></p>
            <?php endif; ?>
        </div>

        <form method="post">
            <div class="all-answers">
                <?php
                if (isset($current_question['options']) && !empty($current_question['options'])) {
                    foreach ($current_question['options'] as $option) {
                        if (!empty($option)) {
                ?>
                            <label class="answer-card">
                                <input type="radio" id="<?= htmlspecialchars($option) ?>" name="answer" value="<?= htmlspecialchars($option) ?>">
                                <label for="<?= htmlspecialchars($option) ?>" class="answer"><?= htmlspecialchars($option) ?></label>
                            </label>
                <?php
                        }
                    }
                }
                ?>
            </div>

            <div class="next-btn">
                <input type="hidden" name="chapter" value="<?= htmlspecialchars($chapter) ?>">
                <input class="button" type="submit" name="next-question-btn" value="Volgende">
            </div>
        </form>
    </div>

</body>

</html>
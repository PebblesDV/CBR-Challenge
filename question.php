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
            <a href="" class="">
                <div class="answer-card">
                    <p class="answer">Hier komt een antwoord</p>
                </div>
            </a>
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
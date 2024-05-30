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
            <p class="score-txt">Category: A - Chapter: Hier de chapter</p>
            <p class="score-txt">Bekijk hier onder jouw uitslag!</p>
        </div>


        <p class="score-txt">Jouw score is:</p>

        <div class="img-container">
            <img class="score-img" src="public/assets/img/verkeersbord.png" alt="score">
            <p class="img-txt">50%</p>
        </div>

        <p class="score-txt">Hier laten zien of je wel of niet bent geslaagd!</p>

        <form>
            <input class="retake-btn" type="submit" name="retake-btn" value="Maak opnieuw">
        </form>

    </div>

</body>

</html>
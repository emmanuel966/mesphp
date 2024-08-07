<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier et Horloge Dynamique</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .calendrier {
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 10px;
            display: inline-block;
        }
        .horloge {
            font-size: 2em;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>Calendrier et Horloge Dynamique</h1>

    <?php
    // Affichage du calendrier
    $mois = isset($_GET['mois']) ? (int)$_GET['mois'] : date('n');
    $annee = isset($_GET['annee']) ? (int)$_GET['annee'] : date('Y');
    
    echo '<div class="calendrier">';
    echo '<h2>' . date('F Y', strtotime("$annee-$mois-01")) . '</h2>';
    echo '<table border="1" style="width:100%; border-collapse:collapse;">';
    echo '<tr>';
    // En-têtes des jours
    $jours = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
    foreach ($jours as $jour) {
        echo "<th>$jour</th>";
    }
    echo '</tr><tr>';

    // Premier jour du mois
    $premier_jour = date('w', strtotime("$annee-$mois-01"));
    $nb_jours_mois = date('t', strtotime("$annee-$mois-01"));
    
    // Espaces avant le premier jour
    for ($i = 0; $i < $premier_jour; $i++) {
        echo '<td></td>';
    }
    
    // Jours du mois
    for ($jour = 1; $jour <= $nb_jours_mois; $jour++) {
        if (($i + $jour) % 7 == 0) {
            echo '</tr><tr>';
        }
        echo "<td>$jour</td>";
    }
    
    // Espaces après le dernier jour
    $dernier_jour = (7 - (date('w', strtotime("$annee-$mois-$nb_jours_mois")) + 1)) % 7;
    for ($i = 0; $i < $dernier_jour; $i++) {
        echo '<td></td>';
    }
    
    echo '</tr></table>';
    echo '</div>';
    ?>

    <div class="horloge" id="horloge"></div>

    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('horloge').textContent = hours + ':' + minutes + ':' + seconds;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display the clock immediately
    </script>

</body>
</html>

<?php
// Array città e fusi orari
$cities = [
    "london" => ["name" => "Londra", "timezone" => "Europe/London"],
    "paris"  => ["name" => "Parigi", "timezone" => "Europe/Paris"],
    "rome"   => ["name" => "Roma", "timezone" => "Europe/Rome"],
    "berlin" => ["name" => "Berlino", "timezone" => "Europe/Berlin"]
];

// Array minigiochi
$games = [
    ["file" => "memory-game.html", "name" => "Memory Game"],
    ["file" => "snake-game.html", "name" => "Snake Game"],
    ["file" => "clicker-game.html", "name" => "Clicker Game"]
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orari & Minigiochi</title>

    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #43a047;
            --bg: #f3f5f7;
            --card-bg: #ffffff;
            --text: #333;
            --muted: #777;
            --radius: 12px;
            --shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 25px;
            font-weight: 600;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 30px;
            margin-bottom: 40px;
        }

        .clock-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .clock {
            background: #fafafa;
            border-radius: var(--radius);
            padding: 20px;
            font-size: 20px;
            font-weight: 500;
            box-shadow: inset 0 0 0 1px #eee;
        }

        .subtitle {
            color: var(--muted);
            margin-bottom: 25px;
            font-size: 16px;
        }

        .games {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .game-link {
            display: inline-block;
            padding: 15px 35px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            font-size: 18px;
            font-weight: 500;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s;
            box-shadow: 0 6px 15px rgba(76,175,80,0.3);
        }

        .game-link:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(76,175,80,0.35);
        }

        @media (max-width: 500px) {
            body {
                padding: 25px 15px;
            }

            .game-link {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">
        <h1>Orari principali fusi orari europei</h1>

        <div class="clock-grid">
            <?php foreach ($cities as $id => $city): ?>
                <div id="<?= $id ?>" class="clock">
                    <?= $city["name"] ?>: --:--
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="card">
        <h1>Benvenuto nei Minigiochi</h1>
        <p class="subtitle">Seleziona un gioco per iniziare!</p>

        <div class="games">
            <?php foreach ($games as $game): ?>
                <a href="<?= $game["file"] ?>" class="game-link">
                    <?= $game["name"] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<script>
    const cities = <?php echo json_encode($cities); ?>;

    function updateClock(id, name, timezone) {
        const now = new Date();
        const time = now.toLocaleTimeString("it-IT", {
            timeZone: timezone,
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit"
        });
        document.getElementById(id).textContent = `${name}: ${time}`;
    }

    function updateTime() {
        for (const id in cities) {
            updateClock(id, cities[id].name, cities[id].timezone);
        }
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>

</body>
</html>

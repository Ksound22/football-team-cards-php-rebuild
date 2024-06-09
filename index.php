<?php
require_once __DIR__ . '/mongo_atlas_php_setup.php';

$position = isset($_POST['position']) ? $_POST['position'] : 'all';

$collection = getMongoCollection('footballers', 'footballer');
$team = $collection->findOne(['team' => 'Argentina']);
$players = $team['players']->getArrayCopy();

$filteredPlayers = $players;
if ($position !== 'all') {
  if ($position === 'nickname') {
    $filteredPlayers = array_filter($players, function ($player) {
      return !empty($player['nickname']);
    });
  } else {
    $filteredPlayers = array_filter($players, function ($player) use ($position) {
      return $player['position'] === $position;
    });
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Learn Modern JavaScript methods by building football team cards
  </title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <h1 class="title">Team stats</h1>
  <main>
    <div class="team-stats">
      <p>Team: <span id="team"></span></p>
      <p>Sport: <span id="sport"></span></p>
      <p>Year: <span id="year"></span></p>
      <p>Head coach: <span id="head-coach"></span></p>
    </div>
    <label class="options-label" for="players">Filter Teammates:</label>
    <select name="players" id="players">
      <option value="all">All Players</option>
      <option value="nickname">Nicknames</option>
      <option value="forward">Position Forward</option>
      <option value="midfielder">Position Midfielder</option>
      <option value="defender">Position Defender</option>
      <option value="goalkeeper">Position Goalkeeper</option>
    </select>
    <div class="cards" id="player-cards">
      <!-- Player cards with footballers -->
    </div>
  </main>
  <footer>&copy; freeCodeCamp</footer>
  <script src="script.js"></script>
</body>

</html>
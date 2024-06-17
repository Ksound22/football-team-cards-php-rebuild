<?php
require_once __DIR__ . '/mongo_atlas_php_setup.php';

$position = isset($_POST['position']) ? $_POST['position'] : 'all';

$collection = getMongoCollection('football-team-cards', 'footballers');
$team = $collection->findOne(['team' => 'Argentina']);

// $players = $team['players']->getArrayCopy();

if ($team && isset($team['players'])) {
  $players = $team['players']->getArrayCopy();
  $teamName = $team['team'];
  $sport = $team['sport'];
  $year = $team['year'];
  $headCoach = $team['headCoach']['coachName'];
} else {
  $players = [];
  echo "No team or players found.";
}

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
    Learn PHP by building football team cards
  </title>
  <link rel="stylesheet" href="./styles.css" />
</head>

<body>
  <h1 class="title">Team stats</h1>
  <main>
    <div class="team-stats">
      <p>Team: <span id="team"> <?= $teamName ?> </span></p>
      <p>Sport: <span id="sport"> <?= $sport ?> </span></p>
      <p>Year: <span id="year"><?= $year ?></span></p>
      <p>Head coach: <span id="head-coach"><?= $headCoach ?></span></p>
    </div>
    <form method="POST" action="">
      <label class="options-label" for="players">Filter Teammates:</label>
      <select name="position" id="players" onchange="this.form.submit()">
        <option value="all" <?= $position === 'all' ? 'selected' : '' ?>>All Players</option>
        <option value="nickname" <?= $position === 'nickname' ? 'selected' : '' ?>>Nicknames</option>
        <option value="forward" <?= $position === 'forward' ? 'selected' : '' ?>>Forwards</option>
        <option value="midfielder" <?= $position === 'midfielder' ? 'selected' : '' ?>>Midfielders</option>
        <option value="defender" <?= $position === 'defender' ? 'selected' : '' ?>>Defenders</option>
        <option value="goalkeeper" <?= $position === 'goalkeeper' ? 'selected' : '' ?>>Goalkeepers</option>
        <option value="playmaker" <?= $position === 'playmaker' ? 'selected' : '' ?>>Playmakers</option>
      </select>
    </form>
    <div class="cards" id="player-cards">
      <?php if (empty($filteredPlayers)) : ?>
        <p>No players found for the selected position.</p>
      <?php else : ?>
        <?php foreach ($filteredPlayers as $players) : ?>
          <div class="player-card">
            <h2><?= $players['name'] . ($players['isCaptain'] ? ' (Captain)' : '') ?></h2>
            <p>Position: <?= $players['position'] ?></p>
            <p>Number: <?= $players['number'] ?></p>
            <p>Nickname: <?= !empty($players['nickname']) ? $players['nickname'] : 'N/A' ?></p>
          </div>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </main>
  <footer>&copy; freeCodeCamp</footer>
</body>

</html>
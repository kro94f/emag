<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

require './vendor/autoload.php';

use Src\Player;
use Src\Skill;

$players = [];

$playerInstance = new Player();
$playerInstance->setName('Orderus');
$playerInstance->setHealth(rand(70, 100));
$playerInstance->setStrength(rand(70, 80));
$playerInstance->setDefence(rand(45, 55));
$playerInstance->setSpeed(rand(40, 50));
$playerInstance->setLuck(rand(10, 30));

$playerInstance->learnSkill('RapidStrike');
$playerInstance->learnSkill('MagicShield');

$players[] = $playerInstance;
unset($playerInstance);

$playerInstance = new Player();
$playerInstance->setName('Some wild beast');
$playerInstance->setHealth(rand(60, 90));
$playerInstance->setStrength(rand(60, 90));
$playerInstance->setDefence(rand(40, 60));
$playerInstance->setSpeed(rand(40, 60));
$playerInstance->setLuck(rand(25, 40));

$players[] = $playerInstance;

//print every player stats
foreach ($players as $k => $player) {

    echo 'Player '.($k + 1).': <strong>'.$player->getName().'</strong><br/>';
    echo '<ul>';
    echo '<li>Health: '.$player->getHealth().'</li>';
    echo '<li>Strength: '.$player->getStrength().'</li>';
    echo '<li>Defence: '.$player->getDefence().'</li>';
    echo '<li>Speed: '.$player->getSpeed().'</li>';
    echo '<li>Luck: '.$player->getLuck().'</li>';
    echo '</ul>';

}

/*
    The first attack is done by the player with the higher speed. If both players have the same speed,
    than the attack is carried on by the player with the highest luck. 
*/

$firstTurnPlayerReason = '';
$firstTurnPlayerKey = null;
$fastestPlayerSpeed = 0;
$luckiestPlayerLuck = 0;

foreach ($players as $playerKey => $player) {
 
    $playerSpeed = $player->getSpeed();
    $playerLuck = $player->getLuck();

    if ($playerSpeed > $fastestPlayerSpeed) {

        $firstTurnPlayerKey = $playerKey;
        $fastestPlayerSpeed = $playerSpeed;
        $luckiestPlayerLuck = $playerLuck;

        $firstTurnPlayerReason = 'speed';

    } else if ($playerSpeed == $fastestPlayerSpeed) {

        if ($playerLuck > $luckiestPlayerLuck) {

            $firstTurnPlayerKey = $playerKey;
            $fastestPlayerSpeed = $playerSpeed;
            $luckiestPlayerLuck = $playerLuck;

            $firstTurnPlayerReason = 'luck';


        } else if ($playerLuck == $luckiestPlayerLuck) {

            $firstTurnPlayerKey = rand(0, count($players) - 1);
            $fastestPlayerSpeed = $playerSpeed;
            $luckiestPlayerLuck = $playerLuck;

            $firstTurnPlayerReason = 'luck';

        }

        //TODO: daca sunt egali, rand intre ei

    }

}

$attackingPlayerKey = $firstTurnPlayerKey;

echo 'The player who gets the first turn is: <strong>'.$players[$firstTurnPlayerKey]->getName().'</strong> due to its '.$firstTurnPlayerReason.'!<br/>';

$winnerPlayer = null;
for ($i = 1; $i <= 20; $i++) {

    echo '<br/><strong>Turn '.$i.'</strong><br/>';

    //set the attacking player
    $attackingPlayer = $players[$attackingPlayerKey];
    
    //set the defending player
    $defendingPlayer = $players[abs($attackingPlayerKey - 1)];

    //get the current health of the defending player
    $defendingPlayerCurrentHealth = $defendingPlayer->getHealth();

    echo '<strong>'.$attackingPlayer->getName().'</strong> is the player who attacks!<br/>';
    echo '<strong>'.$defendingPlayer->getName().'</strong> has <strong>'.$defendingPlayerCurrentHealth.'</strong> health at this moment!<br/>';

    //check if the defender gets lucky and skips the hit
    if ($defendingPlayer->getLuck() <= rand(0, 100)) {

        echo '<strong>'.$defendingPlayer->getName().'</strong> got lucky and skipped the hit!<br/>';

    } else {

        //gets the damage points after the attack
        $damagePoints = $attackingPlayer->attacks($defendingPlayer);

        //set the new health of the defending player
        $defendingPlayerNewHealth = $defendingPlayerCurrentHealth - $damagePoints;
        if ($defendingPlayerNewHealth < 0) $defendingPlayerNewHealth = 0;

        //set the new health of the defeding player
        $players[abs($attackingPlayerKey - 1)]->setHealth($defendingPlayerNewHealth);

        echo '<strong>'.$defendingPlayer->getName().'</strong> took <strong>'.$damagePoints.'</strong> damage points. Now its health is <strong>'.$defendingPlayer->getHealth().'</strong>.<br/>';

        //check if the health of the defender is 0
        if ($defendingPlayerNewHealth == 0) {
            $winnerPlayer = $attackingPlayer;
            break;
        }

    }

    //switch players
    $attackingPlayerKey = abs($attackingPlayerKey - 1);    

}

//check if a winner was declared
if ($winnerPlayer  !== null) {

    echo '<br/><strong>The battle has finished!</strong><br/>';
    echo 'The winner is <strong>'.$winnerPlayer->getName().'</strong>';   

} else {

    echo '<br/><strong>The game reached 20 turns without any winner!</strong>';

}

?>
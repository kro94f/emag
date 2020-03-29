<?php

    use PHPUnit\Framework\TestCase;
    use Src\Player;
    use Src\Skill;

    class PlayerTest extends TestCase {

        public function testPlayerName() {

            require './vendor/autoload.php';

            $playerInstance = new Player();
            $playerInstance->setName('Orderus');

            $this->assertEquals('Orderus', $playerInstance->getName());

        }

        /**
         * @test
         */
        public function playerHealth() {

            require './vendor/autoload.php';

            $playerInstance = new Player();
            $playerInstance->setHealth(rand(40, 60));

            $this->assertGreaterThanOrEqual(0, $playerInstance->getHealth());
            $this->assertLessThanOrEqual(100, $playerInstance->getHealth());

        }

        //test a player skills count by telling the app it has to learn an existing and a non-existing skill
        public function testSkills() {

            require './vendor/autoload.php';

            $playerInstance = new Player();
            $playerInstance->setName('Orderus');
            $playerInstance->learnSkill('RapidStrike');
            $playerInstance->learnSkill('RandomStrike');
            $skills = $playerInstance->getSkills();

            $this->assertEquals(1, count($skills));

        }

    }

?>
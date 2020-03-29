<?php

    namespace Src;

    class SkillMagicShield extends Skill {

        public function __construct() {

            $this->setName('Magic Shield');
            $this->setDescription('Takes only half of the usual damage when an enemy attacks; there’s a 20% change he’ll use this skill every time he defends');
            $this->setType('Defence');
            $this->setLuck(20);

            return $this;

        }

        public function useSkill($points) {

            if (rand(0, 100) <= parent::getLuck()) {

                $points /= 2;

                echo 'The <strong>'.$this->getName().'</strong> skill has been used!<br/>';

            }

            return $points;

        }

    }

?>
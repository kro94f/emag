<?php

    namespace Src;

    class SkillRapidStrike extends Skill {

        public function __construct() {

            $this->setName('Rapid Strike');
            $this->setDescription('Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks');
            $this->setType('Attack');
            $this->setLuck(10);

            return $this;

        }

        public function useSkill($points) {

            if (rand(0, 100) <= parent::getLuck()) {
                
                $points *= 2;
                echo 'The <strong>'.$this->getName().'</strong> skill has been used!<br/>';    

            }

            return $points;

        }

    }

?>
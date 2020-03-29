<?php

    namespace Src;

    class Player {

        private $name;
        private $health;
        private $strength;
        private $defence;
        private $speed;
        private $luck;
        private $skills;

        public function getName() {
            return $this->name;
        }
        
        public function setName($name) {
            $this->name = $name;
        }

        public function getHealth() {
            return $this->health;
        }
        
        public function setHealth($health) {
            $this->health = $health;
        }

        public function getStrength() {
            return $this->strength;
        }
        
        public function setStrength($strength) {
            $this->strength = $strength;
        }

        public function getDefence() {
            return $this->defence;
        }
        
        public function setDefence($defence) {
            $this->defence = $defence;
        }

        public function getSpeed() {
            return $this->speed;
        }
        
        public function setSpeed($speed) {
            $this->speed = $speed;
        }

        public function getLuck() {
            return $this->luck;
        }
        
        public function setLuck($luck) {
            $this->luck = $luck;
        }

        public function getSkills() {
            return $this->skills;
        }

        public function learnSkill(string $skill) {

            $skillObject = SkillFactory::createSkill($skill);
            if (!empty($skillObject)) $this->skills[] = $skillObject;

        }

        public function attacks($defendingPlayer) {

            $damagePoints = 0;
            $damagePoints += $this->getStrength();
            $damagePoints = $defendingPlayer->getsAttacked($damagePoints);

            //check for attacking skills (which can be added later) that affect the damage points
            $skills = $this->getSkills();
            if (!empty($skills)) {

                foreach ($skills as $skill) {
                    
                    if ($skill->getType() == 'Attack') {

                        $damagePoints = $skill->useSkill($damagePoints);

                    }

                }
            }

            return $damagePoints;

        }

        public function getsAttacked($damagePoints) {

            $damagePoints -= $this->getDefence();

            //check for defending skills that affect the damage points
            $skills = $this->getSkills();
            if (!empty($skills)) {

                foreach ($skills as $skill) {
                    
                    if ($skill->getType() == 'Defence') {

                        $damagePoints = $skill->useSkill($damagePoints);

                    }

                }
            }
            
            return $damagePoints;

        }

    }

?>
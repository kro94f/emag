<?php

    namespace Src;

    class Skill {

        private $name;
        private $description;
        private $type;
        private $luck;

        public function getName() {

            return $this->name;

        }

        public function setName($name) {

            $this->name = $name;

        }

        public function getDescription() {

            return $this->description;

        }

        public function setDescription($description) {

            $this->description = $description;

        }

        public function getType() {
            
            return $this->type;

        }

        public function setType($type) {

            $this->type = $type;

        }

        public function getLuck() {
            
            return $this->luck;

        }

        public function setLuck($luck) {

            $this->luck = $luck;

        }

    }

?>
<?php

    namespace Src;

    abstract class SkillFactory {

        private static $skillNo = 1;
        private static $skills = [];

        static function createSkill(string $type) {

            $skill = "Src\\Skill".$type;

            if (class_exists($skill)) {

                self::$skills[self::$skillNo] = new $skill();
                $skillNo = self::$skillNo;
                self::$skillNo += 1;
                return self::$skills[$skillNo];

            } else {

                echo 'Invalid skill name - '.$type;
                
                return null;

            }

        }

    }

?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: djungowski
 * Date: 16.07.14
 * Time: 10:52
 */

class BowlingGame {
    private $_score = 0;
    private $_frames = array();

    public function __construct() {
    }

    private function createFrames() {
    }

    public function score() {
        return $this->_score;
    }

    public function roll($score) {
        $this->_score += $score;
    }
} 
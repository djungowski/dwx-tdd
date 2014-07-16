<?php
/**
 * Created by IntelliJ IDEA.
 * User: djungowski
 * Date: 16.07.14
 * Time: 11:05
 */

require_once 'FrameException.php';

class Frame {
    const MAX_ROLLS_PER_FRAME = 2;
    const MAX_PINS_PER_FRAME = 10;

    private $_score = 0;
    private $_rolls = 0;

    public function addRoll($score) {
        $this->_score += $score;
        if ($this->_rolls >= self::MAX_ROLLS_PER_FRAME) {
            throw new FrameException('Cannot throw more than twice');
        }
        $this->_rolls++;
        if ($this->_score > self::MAX_PINS_PER_FRAME) {
            throw new FrameException("Cannot throw more than 10 pins");
        }
    }
} 
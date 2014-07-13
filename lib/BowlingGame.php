<?php

class BowlingGame
{
    const MAX_SCORE_PER_FRAME = 10;

    private $_score = 0;

    public function roll($score)
    {
        if ($score > self::MAX_SCORE_PER_FRAME) {
            throw new InvalidArgumentException('You cannot throw more than 10 pins');
        }
        $this->_score += $score;
    }

    public function score()
    {
        return $this->_score;
    }
}
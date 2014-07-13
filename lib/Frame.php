<?php
require_once 'FrameException.php';

class Frame
{
    const MAX_SCORES = 2;

    private $_score = 0;
    private $_amountScores = 0;

    public function addScore($score)
    {
        if ($this->_amountScores == self::MAX_SCORES) {
            throw new FrameException('Cannot throw more than twice in one frame');
        }
        $this->_amountScores++;
        $this->_score += $score;
    }

    public function getScore()
    {
        return $this->_score;
    }

    public function isClosed()
    {
        return ($this->_amountScores >= self::MAX_SCORES);
    }
}
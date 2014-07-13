<?php
require_once 'FrameException.php';

class Frame
{
    private $_score = 0;
    private $_amountScores = 0;

    public function addScore($score)
    {
        if ($this->_amountScores == 2) {
            throw new FrameException('Cannot throw more than twice in one frame');
        }
        $this->_amountScores++;
        $this->_score += $score;
    }

    public function getScore()
    {
        return $this->_score;
    }
}
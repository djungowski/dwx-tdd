<?php
require_once 'FrameException.php';

class Frame
{
    const MAX_SCORES = 2;
    const MAX_SCORE_PER_FRAME = 10;

    private $_score = 0;
    private $_amountScores = 0;
    private $_closed = false;
    private $_hasStrike = false;

    public function addScore($score)
    {
        if ($this->isStrike($score)) {
            $this->close();
            $this->_hasStrike = true;
        } else {
            $this->checkThrows();
            $this->checkScoreIntegrity($score);
        }
        $this->_amountScores++;
        $this->_score += $score;
        if ($this->_amountScores >= self::MAX_SCORES) {
            $this->close();
        }
    }

    private function checkThrows()
    {
        if ($this->_amountScores == self::MAX_SCORES) {
            throw new FrameException('Cannot throw more than twice in one frame');
        }
    }

    private function checkScoreIntegrity($score)
    {
        if ($this->_score + $score > self::MAX_SCORE_PER_FRAME) {
            throw new FrameException('You cannot throw more than 10 pins in one frame');
        }
    }

    private function isStrike($score)
    {
        return ($this->_score == 0 && $score == self::MAX_SCORE_PER_FRAME);
    }

    public function hasStrike()
    {
        return $this->_hasStrike;
    }

    private function close()
    {
        $this->_closed = true;
    }

    public function getScore()
    {
        return $this->_score;
    }

    public function isClosed()
    {
        return $this->_closed;
    }
}
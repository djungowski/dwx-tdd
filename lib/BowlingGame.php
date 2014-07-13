<?php
require_once 'Frame.php';

class BowlingGame
{
    const MAX_SCORE_PER_FRAME = 10;

    private $_score = 0;
    private $_frames = array();
    private $_currentFrameNumber = 0;

    public function roll($score)
    {
        if ($this->isStrike($score)) {

        }
        $this->addScoreToFrame($score);
    }

    private function addScoreToFrame($score)
    {
        $frame = $this->getCurrentFrame();
        if ($frame->getScore() + $score > self::MAX_SCORE_PER_FRAME) {
            throw new InvalidArgumentException('You cannot throw more than 10 pins in one frame');
        }
        $this->_frames[$this->_currentFrameNumber]->addScore($score);
        $this->_score += $score;
    }

    private function getCurrentFrame()
    {
        $this->createNewFrameIfNecessary();
        return $this->_frames[$this->_currentFrameNumber];
    }

    private function createNewFrameIfNecessary()
    {
        if(!isset($this->_frames[$this->_currentFrameNumber])) {
            $this->_frames[$this->_currentFrameNumber] = new Frame();
        }
    }

    private function isStrike($score)
    {
        return $score == self::MAX_SCORE_PER_FRAME;
    }

    public function score()
    {
        return $this->_score;
    }
}
<?php
require_once 'Frame.php';

class BowlingGame
{
    const MAX_FRAMES = 10;

    private $_score = 0;
    private $_frames = array();
    private $_currentFrameNumber = 0;

    public function __construct()
    {
        $this->createAllFrames();
    }

    private function createAllFrames()
    {
        for($i = 0; $i < self::MAX_FRAMES; $i++) {
            $this->_frames[$i] = new Frame();
        }
    }

    public function roll($score)
    {
        $this->addScoreToFrame($score);
    }

    private function addScoreToFrame($score)
    {
        $frame = $this->getCurrentFrame();
        $frame->addScore($score);
        $this->_score += $score;
    }

    private function getCurrentFrame()
    {
        return $this->_frames[$this->_currentFrameNumber];
    }

    public function score()
    {
        return $this->_score;
    }
}
<?php

require_once(__DIR__ . '/GameException.php');
require_once(__DIR__ . '/Frame.php');
require_once(__DIR__ . '/FinalFrame.php');
require_once(__DIR__ . '/score/Roll.php');

class Game {
	private $_frames = Array();
	private $_rolls = Array();
	private $_currentFrame = NULL;
	
	public function hit($pins) {
		$frame = $this->getCurrentFrame();
		$roll = new Roll($pins);
		$frame->addRoll($roll);
		$this->_rolls[] = $roll;
		if ($frame->isFull()) $this->_currentFrame = NULL;
	}
	
	public function getFrameCount() {
		return count($this->_frames);
	}
	
	private function getCurrentFrame() {
		if ($this->_currentFrame == NULL) {
			if ($this->getFrameCount() >= 10) throw new GameException('game over');
			if ($this->getFrameCount() == 9) {
				$this->_currentFrame = new FinalFrame();
			} else {
				$this->_currentFrame = new Frame();
			}
			$this->_frames[] = $this->_currentFrame;
		}
		return $this->_currentFrame;
	}
	
	private function hasRoll($index) {
		return isset($this->_rolls[$index]);
	}
	
	private function getRoll($index) {
		return $this->_rolls[$index];
	}
	
	private function getRollPins($index) {
		if (!$this->hasRoll($index)) return 0;
		return $this->getRoll($index)->getPins();
	}
	
	private function getRollScore($index) {
		$roll = $this->getRoll($index);
		$score = $roll->getPins();
		
		if ($roll->getFrame() instanceof FinalFrame) return $score;
		
		if ($roll->isStrike()) {
			$score += $this->getRollPins($index + 1);
			$score += $this->getRollPins($index + 2);
		}
		
		if ($roll->isSpare()) {
			$score += $this->getRollPins($index + 1);
		}
		return $score;
	}
	
	public function getScore() {
		$score = 0;
		for ($i = 0; $i < count($this->_rolls); $i++) {
			$score += $this->getRollScore($i);
		}		
		return $score;
	}
}
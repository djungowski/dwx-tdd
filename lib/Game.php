<?php

require_once(__DIR__ . '/GameException.php');

class Game {
	private $_score = 0;

	private $_hitsInFrame = 0;
	private $_scoreInFrame = 0;	

	public function hit($pins) {
		if ($pins > 10) throw new GameException('can only hit 10 pins at once.');
		$this->_score += $pins;
		$this->_hitsInFrame++;
		if ($this->_scoreInFrame + $pins > 10) throw new GameException('can only hit 10 pins in one frame.'); 
		$this->_scoreInFrame += $pins;
		
		if ($this->_hitsInFrame > 1) {
			$this->_hitsInFrame = 0;
			$this->_scoreInFrame = 0;
		}
	}
	
	public function getScore() {
		return $this->_score;
	}
}
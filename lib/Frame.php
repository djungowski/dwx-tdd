<?php

require_once(__DIR__ . '/GameException.php');

class Frame {
	protected $_rolls = Array();
	
	public function isFull() {
		return count($this->_rolls) >= 2 || $this->getPins() >= 10;
	}
	
	protected function testRoll($roll) {
		if ($this->isFull()) throw new GameException('Frame is full');
		if ($this->pinsLeft() < $roll->getPins()) throw new GameException('not enough pins left');
	}
	
	protected function pinsLeft() {
		return 10 - $this->getPins();
	}
	
	protected function setRollFlags($roll) {
		if ($this->getRollCount() == 0 && $roll->getPins() == 10) {
			$roll->setStrike();
		} else if ($this->getRollCount() >= 0 && $this->getPins() + $roll->getPins() == 10) {
			$roll->setSpare();
		}
	}
	
	public function addRoll($roll) {
		$this->testRoll($roll);
		$this->setRollFlags($roll);
		$roll->setFrame($this);
		$this->_rolls[] = $roll;
	}
	
	public function getRollCount() {
		return count($this->_rolls);
	}
	
	public function getPinsForRoll($rollIndex) {
		return $this->_rolls[$rollIndex]->getPins();
	}
	
	protected function getPins() {
		$pins = 0;
		foreach ($this->_rolls as $roll) $pins += $roll->getPins();
		return $pins;
	}
}
<?php

require_once(__DIR__ . '/../lib/Game.php');

class ScoreTest extends PHPUnit_Framework_TestCase {
	public function testConstructor() {
		$game = new Game();
		self::assertInstanceof("Game", $game);
	}
	
	public function testSimpleScore() {
		$game = new Game();
		$game->hit(2);
		
		self::assertEquals(2, $game->getScore());	
	}
	
	public function testFrameScore() {
		$game = new Game();
		$game->hit(3);
		$game->hit(5);
		
		self::assertEquals(8, $game->getScore());
	}
	
	/**
	 * @expectedException GameException
	 */
	public function testThrowsExceptionWhenMoreThanTenPinsHit() {
		$game = new Game();
		$game->hit(11);
	}

	/**
	 * @expectedException GameException
	 */
	public function testThrowsExceptionWhenMoreThanTenPinsHitInOneFrame() {
		$game = new Game();
		$game->hit(9);
		$game->hit(2);
	}
}
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
	
	public function testSwitchesFrames() {
		$game = new Game();
		for ($i = 0; $i < 3; $i++) $game->hit(2);
		
		self::assertEquals(2, $game->getFrameCount());
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
	
	/**
	 * @expectedException GameException
	 * @expectedExceptionMessage game over
	 */
	public function testThrowsExceptionWhenGameIsOver() {
		$game = new Game();
		
		for ($i = 0; $i < 12; $i++) $game->hit(10);
		
		$game->hit(1);
	}
	
	public function testCalculatesStrikeBonus() {
		$game = new Game();
		
		// strike in first frame
		$game->hit(10);
		
		// some non-strike / non-spare rolls in second frame
		$game->hit(3);
		$game->hit(5);
		
		self::assertEquals(26, $game->getScore());
	}
	
	public function testCalculatesSpareBonus() {
		$game = new Game();
		
		// spare in first frame
		$game->hit(5);
		$game->hit(5);
		
		// some regular roll in second frame
		$game->hit(2);
		
		self::assertEquals(14, $game->getScore());
	}
	
	public function testPerfectGame() {
		$game = new Game();
		
		// perfect game means to throw 12 strikes in a row
		for ($i = 0; $i < 12; $i++) $game->hit(10);
		
		// game score should be 300
		self::assertEquals(300, $game->getScore());
	}
}
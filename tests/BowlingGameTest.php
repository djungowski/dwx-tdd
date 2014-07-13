<?php

require_once 'lib/BowlingGame.php';

class BowlingGameTest extends PHPUnit_Framework_TestCase
{
    private $_game;

    public function setUp()
    {
        $this->_game = new BowlingGame();
    }

    public function testScoreIs0ByDefault()
    {
        self::assertEquals(0, $this->_game->score());
    }

    public function testFirstRollSetsScore()
    {
        $this->_game->roll(1);
        self::assertEquals(1, $this->_game->score());
    }

    public function testSecondRollIncreasesScore()
    {
        $this->_game->roll(1);
        $this->_game->roll(4);
        self::assertEquals(5, $this->_game->score());
    }

    /**
     * @expectedException FrameException
     */
    public function testExceptionWhenThrowingTooMuchPinsOnce()
    {
        $this->_game->roll(11);
    }

    /**
     * @expectedException FrameException
     */
    public function testExceptionWhenThrowingTooMuchPinsInOneFrame()
    {
        $this->_game->roll(4);
        $this->_game->roll(7);
    }

//    public function testBonusScoreIfUserStrikes()
//    {
//        $this->_game->roll(10);
//        $this->_game->roll(5);
//        $this->_game->roll(3);
//        self::assertEquals(26, $this->_game->score());
//    }
}
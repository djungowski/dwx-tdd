<?php

require_once 'lib/BowlingGame.php';

class BowlingGameTest extends PHPUnit_Framework_TestCase
{
    private $_game;

    public function setUp()
    {
        $this->_game = new BowlingGame();
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
     * @expectedException InvalidArgumentException
     */
    public function testExceptionWhenThrowingTooMuchPins()
    {
        $this->_game->roll(11);
    }
}
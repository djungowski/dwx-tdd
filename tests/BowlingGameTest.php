<?php
/**
 * Created by IntelliJ IDEA.
 * User: djungowski
 * Date: 16.07.14
 * Time: 10:50
 */

require_once(__DIR__ . '/../lib/BowlingGame.php');

class BowlingGameTest extends PHPUnit_Framework_TestCase {

    private $_game;

    public function setUp() {
        parent::setUp();
        $this->_game = new BowlingGame();
    }

    public function testInstantiation() {
        self::assertInstanceOf("BowlingGame", $this->_game);
    }

    public function testScoreIsZeroOnStart() {
        self::assertSame(0, $this->_game->score());
    }

    public function testRollSetsScore() {
        $this->_game->roll(5);
        self::assertEquals(5, $this->_game->score());
    }

    public function testSecondRollIncreasesScore() {
        $this->_game->roll(3);
        $this->_game->roll(6);

        self::assertEquals(9, $this->_game->score());
    }

    public function testGameEndsAfterTenFrames() {
        // Hier war das Coding Kata vorbei
    }
} 
<?php
require_once 'lib/Frame.php';

class FrameTest extends PHPUnit_Framework_TestCase
{
    private $_frame;

    public function setUp()
    {
        $this->_frame = new Frame();
    }

    public function testSmoke()
    {
        self::assertInstanceOf('Frame', $this->_frame);
    }

    public function testGetScoreDefaultsTo0()
    {
        self::assertSame(0, $this->_frame->getScore());
    }

    public function testAddScore()
    {
        $this->_frame->addScore(7);
        self::assertEquals(7, $this->_frame->getScore());
    }

    public function testAddScoreCanAddSecondScore()
    {
        $this->_frame->addScore(3);
        $this->_frame->addScore(1);
        self::assertEquals(4, $this->_frame->getScore());
    }

    /**
     * @expectedException FrameException
     * @expectedExceptionMessage Cannot throw more than twice in one frame
     */
    public function testExceptionWhenTryingToAddThirdScore()
    {
        $this->_frame->addScore(3);
        $this->_frame->addScore(1);
        $this->_frame->addScore(1);
    }

    public function testIsClosed()
    {
        self::assertFalse($this->_frame->isClosed());
        $this->_frame->addScore(3);
        $this->_frame->addScore(1);
        self::assertTrue($this->_frame->isClosed());
    }
}
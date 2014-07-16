<?php
/**
 * Created by IntelliJ IDEA.
 * User: djungowski
 * Date: 16.07.14
 * Time: 11:03
 */

require_once __DIR__ . '/../lib/Frame.php';

class FrameTest extends PHPUnit_Framework_TestCase {

    private $_frame;

    public function setUp() {
        $this->_frame = new Frame();
    }

    /**
     * @expectedException FrameException
     * @expectedExceptionMessage Cannot throw more than twice
     */
    public function testThrowsExceptionWhenMoreThanTwoRolls() {
        $this->_frame->addRoll(1);
        $this->_frame->addRoll(1);
        $this->_frame->addRoll(1);
    }

    /**
     * @expectedException FrameException
     * @expectedExceptionMessage Cannot throw more than 10 pins
     */
    public function testThrowsExceptionWhenElevenPinsRolled() {
        $this->_frame->addRoll(11);
    }

    /**
     * @expectedException FrameException
     * @expectedExceptionMessage Cannot throw more than 10 pins
     */
    public function testThrowsExceptionWhenTwelvePinsRolled() {
        $this->_frame->addRoll(12);
    }

    /**
     * @expectedException FrameException
     * @expectedExceptionMessage Cannot throw more than 10 pins
     */
    public function testThrowsExceptionWhenMoreThanTenPinsInTwoRolls() {
        $this->_frame->addRoll(8);
        $this->_frame->addRoll(4);
    }
}
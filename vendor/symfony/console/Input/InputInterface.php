<?php
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState enabled
 */
class Issue1335Test extends TestCase
{
    public function testGlobalString()
    {
        $this->assertEquals('Hello', $GLOBALS['globalString']);
    }

    public function testGlobalIntTruthy()
    {
        $this->assertEquals(1, $GLOBALS['globalIntTruthy']);
    }

    public function testGlobalIntFalsey()
    {
        $this->assertEquals(0, $GLOBALS['globalIntFalsey']);
    }

    public function testGlobalFloat()
    {
        $this->assertEquals(1.123, $GLOBALS['globalFloat']);
    }

    public function testGlobalBoolTrue()
    {
        $this->assertTrue($GLOBALS['globalBoolTrue']);
    }

    public function testGlobalBoolFalse()
    {
        $this->assertFalse($GLOBALS['globalBoolFalse']);
    }

    public function testGlobalNull()
    {
        $this->assertEquals(null, $GLOBALS['globalNull']);
    }

    public function testGlobalArray()
    {
        $this->assertEquals(['foo'], $GLOBALS['globalArray']);
    }

    public function testGlobalNestedArray()
    {
        $this->assertEquals([['foo']], $GLOBALS['globalNestedArray']);
    }

    public function testGlobalObject()
    {
        $this->assertEquals((object) ['foo'=> 'bar'], $GLOBALS['globalObject']);
    }

    public function testGlobalObjectWithBackSlashString()
    {
        $this->assertEquals((object) ['foo'=> 'back\\slash'], $GLOBALS['globalObjectWithBackSlashString']);
    }

    public function testGlobalObjectWithDoubleBackSlashString()
    {
        $this->assertEquals((object) ['foo'=> 'back\\\\slash'], $GLOBALS['globalObjectWithDoubleBackSlashString']);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Handles Quoted Printable (QP) Transfer Encoding in Swift Mailer using the PHP core function.
 *
 * @author Lars Strojny
 */
class Swift_Mime_ContentEncoder_NativeQpContentEncoder implements Swift_Mime_ContentEncoder
{
    /**
     * @var null|string
     */
    private $charset;

    /**
     * @param null|string $charset
     */
    public function __construct($charset = null)
    {
        $this->c
<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

/**
 * StreamableInputInterface is the interface implemented by all input classes
 * that have an input stream.
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
interface StreamableInputInterface extends InputInterface
{
    /**
     * Sets the input stream to read from when interacting with the user.
     *
     * This is mainly useful for testing purpose.
     *
     * @param resource $stream The input stream
     */
    public function setStream($stream);

    /**
     * Returns the input stream.
     *
     * @return resource|null
     */
    public function getStream();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php
/**
 * Random_* Compatibility Library
 * for using the new PHP 7 random_* API in PHP 5 projects
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 - 2018 Paragon Initiative Enterprises
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

if (!is_callable('RandomCompat_intval')) {
    
    /**
     * Cast to an integer if we can, safely.
     * 
     * If you pass it a float in the range (~PHP_INT_MAX, PHP_INT_MAX)
     * (non-inclusive), it will sanely cast it to an int. If you it's equal to
     * ~PHP_INT_MAX or PHP_INT_MAX, we let it fail as not an integer. Floats 
     * lose precision, so the <= and => operators might accidentally let a float
     * through.
     * 
     * @param int|float $number    The number we want to convert to an int
     * @param bool      $fail_open Set to true to not throw an exception
     * 
     * @return float|int
     * @psalm-suppress InvalidReturnType
     *
     * @throws TypeError
     */
    function RandomCompat_intval($number, $fail_open = false)
    {
        if (is_int($number) || is_float($number)) {
            $number += 0;
        } elseif (is_numeric($number)) {
            /** @psalm-suppress InvalidOperand */
            $number += 0;
        }
        /** @var int|float $number */

        if (
            is_float($number)
                &&
            $number > ~PHP_INT_MAX
                &&
            $number < PHP_INT_MAX
        ) {
            $number = (int) $number;
        }

        if (is_int($number)) {
            return (int) $number;
        } elseif (!$fail_open) {
            throw new TypeError(
                'Expected an integer.'
            );
        }
        return $number;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

class Swift_Bug51Test extends \SwiftMailerTestCase
{
    private $attachmentFile;
    private $outputFile;

    protected function setUp()
    {
        $this->attachmentFile = sys_get_temp_dir().'/attach.rand.bin';
        file_put_contents($this->attachmentFile, '');

        $this->outputFile = sys_get_temp_dir().'/attach.out.bin';
        file_put_contents($this->outputFile, '');
    }

    protected function tearDown()
    {
        unlink($this->attachmentFile);
        unlink($this->outputFile);
    }

    public function testAttachmentsDoNotGetTruncatedUsingToByteStream()
    {
        //Run 100 times with 10KB attachments
        for ($i = 0; $i < 10; ++$i) {
            $message = $this->createMessageWithRandomAttachment(
                10000, $this->attachmentFile
            );

            file_put_contents($this->outputFile, '');
            $message->toByteStream(
                new Swift_ByteStream_FileByteStream($this->outputFile, true)
            );

            $emailSource = file_get_contents($this->outputFile);

            $this->assertAttachmentFromSourceMatches(
                file_get_contents($this->attachmentFile),
                $emailSource
            );
        }
    }

    public function testAttachmentsDoNotGetTruncatedUsingToString()
    {
        //Run 100 times with 10KB attachments
        for ($i = 0; $i < 10; ++$i) {
            $message = $this->createMessageWithRandomAttachment(
                10000, $this->attachmentFile
            );

            $emailSource = $message->toString();

            $this->assertAttachmentFromSourceMatches(
                file_get_contents($this->attachmentFile),
                $emailSource
            );
        }
    }

    public function assertAttachmentFromSourceMatches($attachmentData, $source)
    {
        $encHeader = 'Content-Transfer-Encoding: base64';
        $base64declaration = strpos($source, $encHeader);

        $attachmentDataStart = strpos($source, "\r\n\r\n", $base64declaration);
        $attachmentDataEnd = strpos($source, "\r\n--", $attachmentDataStart);

        if (false === $attachmentDataEnd) {
            $attachmentBase64 = trim(substr($source, $attachmentDataStart));
        } else {
            $attachmentBase64 = trim(substr(
                $source, $attachmentDataStart,
                $attachmentDataEnd - $attachmentDataStart
            ));
        }

        $this->assertIdenticalBinary($attachmentData, base64_decode($attachmentBase64));
    }

    private function fillFileWithRandomBytes($byteCount, $file)
    {
        // I was going to use dd with if=/dev/random but this way seems more
        // cross platform even if a hella expensive!!

        file_put_contents($file, '');
        $fp = fopen($file, 'wb');
        for ($i = 0; $i < $byteCount; ++$i) {
            $byteVal = random_int(0, 255);
            fwrite($fp, pack('i', $byteVal));
        }
        fclose($fp);
    }

    private function createMessageWithRandomAttachment($size, $attachmentPath)
    {
        $this->fillFileWithRandomBytes($size, $attachmentPath);

        $message = (new Swift_Message())
            ->setSubject('test')
            ->setBody('test')
            ->setFrom('a@b.c')
            ->setTo('d@e.f')
            ->attach(Swift_Attachment::fromPath($attachmentPath))
            ;

        return $message;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

/**
 * Sampling handler
 *
 * A sampled event stream can be useful for logging high frequency events in
 * a production environment where you only need an idea of what is happening
 * and are not concerned with capturing every occurrence. Since the decision to
 * handle or not handle a particular event is determined randomly, the
 * resulting sampled log is not guaranteed to contain 1/N of the events that
 * occurred in the application, but based on the Law of large numbers, it will
 * tend to be close to this ratio with a large number of attempts.
 *
 * @author Bryan Davis <bd808@wikimedia.org>
 * @author Kunal Mehta <legoktm@gmail.com>
 */
class SamplingHandler extends AbstractHandler
{
    /**
     * @var callable|HandlerInterface $handler
     */
    protected $handler;

    /**
     * @var int $factor
     */
    protected $factor;

    /**
     * @param callable|HandlerInterface $handler Handler or factory callable($record, $fingersCrossedHandler).
     * @param int                       $factor  Sample factor
     */
    public function __construct($handler, $factor)
    {
        parent::__construct();
        $this->handler = $handler;
        $this->factor = $factor;

        if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
            throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
        }
    }

    public function isHandling(array $record)
    {
        return $this->handler->isHandling($record);
    }

    public function handle(array $record)
    {
        if ($this->isHandling($record) && mt_rand(1, $this->factor) === 1) {
            // The same logic as in FingersCrossedHandler
            if (!$this->handler instanceof HandlerInterface) {
                $this->handler = call_user_func($this->handler, $record, $this);
                if (!$this->handler instanceof HandlerInterface) {
                    throw new \RuntimeException("The factory callable should return a HandlerInterface");
                }
            }

            if ($this->processors) {
                foreach ($this->processors as $processor) {
                    $record = call_user_func($processor, $record);
                }
            }

            $this->handler->handle($record);
        }

        return false === $this->bubble;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

namespace Illuminate\Console\Scheduling;

use DateTimeInterface;

interface SchedulingMutex
{
    /**
     * Attempt to obtain a scheduling mutex for the given event.
     *
     * @param  \Illuminate\Console\Scheduling\Event  $event
     * @param  \DateTimeInterface  $time
     * @return bool
     */
    public function create(Event $event, DateTimeInterface $time);

    /**
     * Determine if a scheduling mutex exists for the given event.
     *
     * @param  \Illuminate\Console\Scheduling\Event  $event
     * @param  \DateTimeInterface  $time
     * @return bool
     */
    public function exists(Event $event, DateTimeInterface $time);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ��m�e���W\�z�U�jD�)���`,!� �a"�㕏���>*�0���S	���jPB�[W^/=  �3���dhT����]2c�����	��*�G��b��]��#!�1�W���(3чP�c��S���,�?�� �KI�f,�j����Q�S[� �K�dK�>\��1��m�/�
�����i�^*ש~�������9���?���7��W�9V!
����L��YD����	C�޻�6)LD �߾�HO�1�և)��a�}��^�v�hiQe��ag�������T��s�@����_ՎYZ,���M�螾�ߗ-/= hw�#�z�G��ޮ�F!����g
_���[��>����^2?V?�����1��/��6��gwIC�p���Df���S_�1���z_�A�6���4dO!�!��� �8�PdhA���C� �#[���-�SD�;����=^!�V&')���.���}�~���!��2p"����=),d�R�;���7�-2@�ˣ��C�p_@����;��9���5̞ե!����;y�mg�2S��1�VzL<���]>�z���5���o�=��v�
8!�0��B?� ��[�F�����S6%L��+322@'�([ڦxݻ�{�ЦY���K|�������(�Y���o��`?^���cQL��e�x@�Lk� [f��E���@�5���IȒ7�.�Ǳ�?������v�kV宁��n����H����Jz�vK�
$���;)[��8+V�uT���w?.������vf&mp��������M�1�/�ayy!������c����Yw##d��2���C��|�����@"|y�B9�b($��|��ug��������9�yD����]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]==t��y13ps'��7�� �d�vF�x� �@\��j� ���ס�ڂ�B�:&�p���9����� �r2z;#z�` Q .C�����tM�P���� �Ap!`}���?��뮺뮺뮺��*�>���`.x
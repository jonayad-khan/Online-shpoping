<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process\Pipes;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\RuntimeException;

/**
 * WindowsPipes implementation uses temporary files as handles.
 *
 * @see https://bugs.php.net/bug.php?id=51800
 * @see https://bugs.php.net/bug.php?id=65650
 *
 * @author Romain Neutron <imprec@gmail.com>
 *
 * @internal
 */
class WindowsPipes extends AbstractPipes
{
    private $files = array();
    private $fileHandles = array();
    private $readBytes = array(
        Process::STDOUT => 0,
        Process::STDERR => 0,
    );
    private $haveReadSupport;

    public function __construct($input, bool $haveReadSupport)
    {
        $this->haveReadSupport = $haveReadSupport;

        if ($this->haveReadSupport) {
            // Fix for PHP bug #51800: reading from STDOUT pipe hangs forever on Windows if the output is too big.
            // Workaround for this problem is to use temporary files instead of pipes on Windows platform.
            //
            // @see https://bugs.php.net/bug.php?id=51800
            $pipes = array(
                Process::STDOUT => Process::OUT,
                Process::STDERR => Process::ERR,
            );
            $tmpCheck = false;
            $tmpDir = sys_get_temp_dir();
            $lastError = 'unknown reason';
            set_error_handler(function ($type, $msg) use (&$lastError) { $lastError = $msg; });
            for ($i = 0;; ++$i) {
                foreach ($pipes as $pipe => $name) {
                    $file = sprintf('%s\\sf_proc_%02X.%s', $tmpDir, $i, $name);
                    if (file_exists($file) && !unlink($file)) {
                        continue 2;
                    }
                    $h = fopen($file, 'xb');
                    if (!$h) {
                        $error = $lastError;
                        if ($tmpCheck || $tmpCheck = unlink(tempnam(false, 'sf_check_'))) {
                            continue;
                        }
                        restore_error_handler();
                        throw new RuntimeException(sprintf('A temporary file could not be opened to write the process output: %s', $error));
                    }
                    if (!$h || !$this->fileHandles[$pipe] = fopen($file, 'rb')) {
                        continue 2;
                    }
                    if (isset($this->files[$pipe])) {
                        unlink($this->files[$pipe]);
                    }
                    $this->files[$pipe] = $file;
                }
                break;
            }
            restore_error_handler();
        }

        parent::__construct($input);
    }

    public function __destruct()
    {
        $this->close();
        $this->removeFiles();
    }

    /**
     * {@inheritdoc}
     */
    public function getDescriptors()
    {
        if (!$this->haveReadSupport) {
            $nullstream = fopen('NUL', 'c');

            return array(
                array('pipe', 'r'),
                $nullstream,
                $nullstream,
            );
        }

        // We're not using pipe on Windows platform as it hangs (https://bugs.php.net/bug.php?id=51800)
        // We're not using file handles as it can produce corrupted output https://bugs.php.net/bug.php?id=65650
        // So we redirect output within the commandline and pass the nul device to the process
        return array(
            array('pipe', 'r'),
            array('file', 'NUL', 'w'),
            array('file', 'NUL', 'w'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * {@inheritdoc}
     */
    public function readAndWrite($blocking, $close = false)
    {
        $this->unblock();
        $w = $this->write();
        $read = $r = $e = array();

        if ($blocking) {
            if ($w) {
                @stream_select($r, $w, $e, 0, Process::TIMEOUT_PRECISION * 1E6);
            } elseif ($this->fileHandles) {
                usleep(Process::TIMEOUT_PRECISION * 1E6);
            }
        }
        foreach ($this->fileHandles as $type => $fileHandle) {
            $data = stream_get_contents($fileHandle, -1, $this->readBytes[$type]);

            if (isset($data[0])) {
                $this->readBytes[$type] += strlen($data);
                $read[$type] = $data;
            }
            if ($close) {
                fclose($fileHandle);
                unset($this->fileHandles[$type]);
            }
        }

        return $read;
    }

    /**
     * {@inheritdoc}
     */
    public function haveReadSupport()
    {
        return $this->haveReadSupport;
    }

    /**
     * {@inheritdoc}
     */
    public function areOpen()
    {
        return $this->pipes && $this->fileHandles;
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        parent::close();
        foreach ($this->fileHandles as $handle) {
            fclose($handle);
        }
        $this->fileHandles = array();
    }

    /**
     * Removes temporary files.
     */
    private function removeFiles()
    {
        foreach ($this->files as $filename) {
            if (file_exists($filename)) {
                @unlink($filename);
            }
        }
        $this->files = array();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             INDX( 	                 (   X  �       �                    ��     x b     ��     |��b����Ѵ�+�b�x��b�                        A r g u m e n t R e s o l v e r       ��     � r     ��     ��b����Ѵ��5�b���b� 0      >/               A r g u m e n t R e s o l v e r T e s t . p h p       ��     � �     ��     �A�b����Ѵ��Z�b��A�b� 0      n(              # C o n t a i n e r C o n t r o l l e r R e s o l v e r T e s t . p h p ��     � v     ��     �f�b����Ѵ �~�b��f�b�        '               C o n t r o l l e r R e s o l v e r T e s t . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          # The MIT License (MIT)

Copyright (c) 2016 PHP Framework Interoperability Group

> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in
> all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
> THE SOFTWARE.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

class Swift_ByteStream_FileByteStreamAcceptanceTest extends \PHPUnit\Framework\TestCase
{
    private $_testFile;

    protected function setUp()
    {
        $this->testFile = sys_get_temp_dir().'/swift-test-file'.__CLASS__;
        file_put_contents($this->testFile, 'abcdefghijklm');
    }

    protected function tearDown()
    {
        unlink($this->testFile);
    }

    public function testFileDataCanBeRead()
    {
        $file = $this->createFileStream($this->testFile);
        $str = '';
        while (false !== $bytes = $file->read(8192)) {
            $str .= $bytes;
        }
        $this->assertEquals('abcdefghijklm', $str);
    }

    public function testFileDataCanBeReadSequentially()
    {
        $file = $this->createFileStream($this->testFile);
        $this->assertEquals('abcde', $file->read(5));
        $this->assertEquals('fghijklm', $file->read(8));
        $this->assertFalse($file->read(1));
    }

    public function testFilenameIsReturned()
    {
        $file = $this->createFileStream($this->testFile);
        $this->assertEquals($this->testFile, $file->getPath());
    }

    public function testFileCanBeWrittenTo()
    {
        $file = $this->createFileStream($this->testFile, true);
        $file->write('foobar');
        $this->assertEquals('foobar', $file->read(8192));
    }

    public function testReadingFromThenWritingToFile()
    {
        $file = $this->createFileStream($this->testFile, true);
        $file->write('foobar');
        $this->assertEquals('foobar', $file->read(8192));
        $file->write('zipbutton');
        $this->assertEquals('zipbutton', $file->read(8192));
    }

    public function testWritingToFileWithCanonicalization()
    {
        $file = $this->createFileStream($this->testFile, true);
        $file->addFilter($this->createFilter(array("\r\n", "\r"), "\n"), 'allToLF');
        $file->write("foo\r\nbar\r");
        $file->write("\nzip\r\ntest\r");
        $file->flushBuffers();
        $this->assertEquals("foo\nbar\nzip\ntest\n", file_get_contents($this->testFile));
    }

    public function testWritingWithFulleMessageLengthOfAMultipleOf8192()
    {
        $file = $this->createFileStream($this->testFile, true);
        $file->addFilter($this->createFilter(array("\r\n", "\r"), "\n"), 'allToLF');
        $file->write('');
        $file->flushBuffers();
        $this->assertEquals('', file_get_contents($this->testFile));
    }

    public function testBindingOtherStreamsMirrorsWriteOperations()
    {
        $file = $this->createFileStream($this->testFile, true);
        $is1 = $this->createMockInputStream();
        $is2 = $this->createMockInputStream();

        $is1->expects($this->at(0))
            ->method('write')
            ->with('x');
        $is1->expects($this->at(1))
            ->method('write')
            ->with('y');
        $is2->expects($this->at(0))
            ->method('write')
            ->with('x');
        $is2->expects($this->at(1))
            ->method('write')
            ->with('y');

        $file->bind($is1);
        $file->bind($is2);

        $file->write('x');
        $file->write('y');
    }

    public function testBindingOtherStreamsMirrorsFlushOperations()
    {
        $file = $this->createFileStream(
            $this->testFile, true
            );
        $is1 = $this->createMockInputStream();
        $is2 = $this->createMockInputStream();

        $is1->expects($this->once())
            ->method('flushBuffers');
        $is2->expects($this->once())
            ->method('flushBuffers');

        $file->bind($is1);
        $file->bind($is2);

        $file->flushBuffers();
    }

    public function testUnbindingStreamPreventsFurtherWrites()
    {
        $file = $this->createFileStream($this->testFile, true);
        $is1 = $this->createMockInputStream();
        $is2 = $this->createMockInputStream();

        $is1->expects($this->at(0))
            ->method('write')
            ->with('x');
        $is1->expects($this->at(1))
            ->method('write')
            ->with('y');
        $is2->expects($this->once())
            ->method('write')
            ->with('x');

        $file->bind($is1);
        $file->bind($is2);

        $file->write('x');

        $file->unbind($is2);

        $file->write('y');
    }

    private function createFilter($search, $replace)
    {
        return new Swift_StreamFilters_StringReplacementFilter($search, $replace);
    }

    private function createMockInputStream()
    {
        return $this->getMockBuilder('Swift_InputByteStream')->getMock();
    }

    private function createFileStream($file, $writable = false)
    {
        return new Swift_ByteStream_FileByteStream($file, $writable);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

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

namespace Illuminate\Contracts\Bus;

interface Dispatcher
{
    /**
     * Dispatch a command to its appropriate handler.
     *
     * @param  mixed  $command
     * @return mixed
     */
    public function dispatch($command);

    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed  $command
     * @param  mixed  $handler
     * @return mixed
     */
    public function dispatchNow($command, $handler = null);

    /**
     * Determine if the given command has a handler.
     *
     * @param  mixed  $command
     * @return bool
     */
    public function hasCommandHandler($command);

    /**
     * Retrieve the handler for a command.
     *
     * @param  mixed  $command
     * @return bool|mixed
     */
    public function getCommandHandler($command);

    /**
     * Set the pipes commands should be piped through before dispatching.
     *
     * @param  array  $pipes
     * @return $this
     */
    public function pipeThrough(array $pipes);

    /**
     * Map a command to a handler.
     *
     * @param  array  $map
     * @return $this
     */
    public function map(array $map);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Http\Resources\Json;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Responsable;

class ResourceResponse implements Responsable
{
    /**
     * The underlying resource.
     *
     * @var mixed
     */
    public $resource;

    /**
     * Create a new resource response.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return tap(response()->json(
            $this->wrap(
                $this->resource->resolve($request),
                $this->resource->with($request),
                $this->resource->additional
            ),
            $this->calculateStatus()
        ), function ($response) use ($request) {
            $response->original = $this->resource->resource;

            $this->resource->withResponse($request, $response);
        });
    }

    /**
     * Wrap the given data if necessary.
     *
     * @param  array  $data
     * @param  array  $with
     * @param  array  $additional
     * @return array
     */
    protected function wrap($data, $with = [], $additional = [])
    {
        if ($data instanceof Collection) {
            $data = $data->all();
        }

        if ($this->haveDefaultWrapperAndDataIsUnwrapped($data)) {
            $data = [$this->wrapper() => $data];
        } elseif ($this->haveAdditionalInformationAndDataIsUnwrapped($data, $with, $additional)) {
            $data = [($this->wrapper() ?? 'data') => $data];
        }

        return array_merge_recursive($data, $with, $additional);
    }

    /**
     * Determine if we have a default wrapper and the given data is unwrapped.
     *
     * @param  array  $data
     * @return bool
     */
    protected function haveDefaultWrapperAndDataIsUnwrapped($data)
    {
        return $this->wrapper() && ! array_key_exists($this->wrapper(), $data);
    }

    /**
     * Determine if "with" data has been added and our data is unwrapped.
     *
     * @param  array  $data
     * @param  array  $with
     * @param  array  $additional
     * @return bool
     */
    protected function haveAdditionalInformationAndDataIsUnwrapped($data, $with, $additional)
    {
        return (! empty($with) || ! empty($additional)) &&
               (! $this->wrapper() ||
                ! array_key_exists($this->wrapper(), $data));
    }

    /**
     * Get the default data wrapper for the resource.
     *
     * @return string
     */
    protected function wrapper()
    {
        return get_class($this->resource)::$wrap;
    }

    /**
     * Calculate the appropriate status code for the response.
     *
     * @return int
     */
    protected function calculateStatus()
    {
        return $this->resource->resource instanceof Model &&
               $this->resource->resource->wasRecentlyCreated ? 201 : 200;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   INDX( 	                 (     �      % �  m                 n    � v     m    E�y�b����$Ƿ���y�b�>�y�b�       �               C o m p i l e s A u t h o r i z a t i o n s . p h p   o    � j     m    �
z�b����$Ƿ�!z�b��
z�b��      �               C o m p i l e s C o m m e n t s . p h p       p    � n     m    J,z�b����$Ƿ�Cz�b�F,z�b�       �               C o m p i l e s C o m p o n e n t s . p h p   q    � r     m    Nz�b����$Ƿ��gz�b�Nz�b%         �               C o m p i l e s C o n d i t i o n a l s . p h p       r    x d     m    :sz�b����$Ƿ�E�z�b�6sz�b�       =               C o m p i l e s E c h o s . p h p     s    x h     m    ��z�b����$Ƿ��z�b���z�b�       �               C o m p i l e s H e l p e r s . p h p t    � j     m    }�z�b����$Ƿ���z�b�v�z�b�       �               C o m p i l e s I n c l u d e s . p h p       u    � n     m    ��z�b����$Ƿ���z�b���z�b�     % �               C o m p i l e s I n j e c t i o n s . p h p   v    x b     m    ��z�b����$Ƿ��{�b���z�b�       �               C o m p i l e s J s o n . p h p       w    x h     m    ("{�b����$Ƿ�99{�b�""{�b�       �	               C o m p i l e s L a y o u t s . p h p x    x d     m    �D{�b����$Ƿ�`]{�b��D{�b�        ^               C o m p i l e s L o o p s . p h p     y    x f     m    �h{�b����$Ƿ�7{�b��h{�b�p      l               C o % p i l e s R a w P h p . p h p   z    x f     m    w�{�b����$Ƿ���{�b�n�{�b�       �               C o m p i l e s S t a c k s . p h p   {    � r     m    Э{�b����$Ƿ���{�b�ȭ{�b�                       C o m p i l e s T r a n s l a t i o n s . p h p                                                                                                                                                                                                                                   %                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               %                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               %                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               %                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               % Namespace types cannot be mixed
-----
<?php
namespace A;
echo 1;
namespace B {
    echo 2;
}
echo 3;
-----
Cannot mix bracketed namespace declarations with unbracketed namespace declarations on line 4
array(
    0: Stmt_Namespace(
        name: Name(
            parts: array(
                0: A
            )
        )
        stmts: array(
            0: Stmt_Echo(
                exprs: array(
                    0: Scalar_LNumber(
                        value: 1
                    )
                )
            )
        )
    )
    1: Stmt_Namespace(
        name: Name(
            parts: array(
                0: B
            )
        )
        stmts: array(
            0: Stmt_Echo(
                exprs: array(
                    0: Scalar_LNumber(
                        value: 2
                    )
                )
            )
        )
    )
    2: Stmt_Echo(
        exprs: array(
            0: Scalar_LNumber(
                value: 3
            )
        )
    )
)
-----
<?php
namespace A {
    echo 1;
}
echo 2;
namespace B;
echo 3;
-----
Cannot mix bracketed namespace declarations with unbracketed namespace declarations on line 6
array(
    0: Stmt_Namespace(
        name: Name(
            parts: array(
                0: A
            )
        )
        stmts: array(
            0: Stmt_Echo(
                exprs: array(
                    0: Scalar_LNumber(
                        value: 1
                    )
                )
            )
        )
    )
    1: Stmt_Echo(
        exprs: array(
            0: Scalar_LNumber(
                value: 2
            )
        )
    )
    2: Stmt_Namespace(
        name: Name(
            parts: array(
                0: B
            )
        )
        stmts: array(
            0: Stmt_Echo(
                exprs: array(
                    0: Scalar_LNumber(
                        value: 3
                    )
                )
            )
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Faker\Provider\da_DK;

/**
 * @link http://www.danskernesnavne.navneforskning.ku.dk/Personnavne.asp
 *
 * @author Antoine Corcy <contact@sbin.dk>
 */
class Person extends \Faker\Provider\Person
{
    /**
     * @var array Danish person name formats.
     */
    protected static $maleNameFormats = array(
        '{{firstNameMale}} {{lastName}}',
        '{{firstNameMale}} {{lastName}}',
        '{{firstNameMale}} {{lastName}}',
        '{{firstNameMale}} {{middleName}} {{lastName}}',
        '{{firstNameMale}} {{middleName}} {{lastName}}',
        '{{firstNameMale}} {{middleName}}-{{middleName}} {{lastName}}',
        '{{firstNameMale}} {{middleName}} {{middleName}}-{{lastName}}',
    );

    protected static $femaleNameFormats = array(
        '{{firstNameFemale}} {{lastName}}',
        '{{firstNameFemale}} {{lastName}}',
        '{{firstNameFemale}} {{lastName}}',
        '{{firstNameFemale}} {{middleName}} {{lastName}}',
        '{{firstNameFemale}} {{middleName}} {{lastName}}',
        '{{firstNameFemale}} {{middleName}}-{{middleName}} {{lastName}}',
        '{{firstNameFemale}} {{middleName}} {{middleName}}-{{lastName}}',
    );

    /**
     * @var array Danish first names.
     */
    protected static $firstNameMale = array(
        'Aage', 'Adam', 'Adolf', 'Ahmad', 'Ahmed', 'Aksel', 'Albert', 'Alex', 'Alexander', 'Alf', 'Alfred', 'Ali', 'Allan',
        'Anders', 'Andreas', 'Anker', 'Anton', 'Arne', 'Arnold', 'Arthur', 'Asbjørn', 'Asger', 'August', 'Axel', 'Benjamin',
        'Benny', 'Bent', 'Bernhard', 'Birger', 'Bjarne', 'Bjørn', 'Bo', 'Brian', 'Bruno', 'Børge', 'Carl', 'Carlo',
        'Carsten', 'Casper', 'Charles', 'Chris', 'Christian', 'Christoffer', 'Christopher', 'Claus', 'Dan', 'Daniel', 'David', 'Dennis',
        'Ebbe', 'Edmund', 'Edvard', 'Egon', 'Einar', 'Ejvind', 'Elias', 'Emanuel', 'Emil', 'Erik', 'Erland', 'Erling',
        'Ernst', 'Esben', 'Ferdinand', 'Finn', 'Flemming', 'Frank', 'Freddy', 'Frederik', 'Frits', 'Fritz', 'Frode', 'Georg',
        'Gerhard', 'Gert', 'Gunnar', 'Gustav', 'Hans', 'Harald', 'Harry', 'Hassan', 'Heine', 'Heinrich', 'Helge', 'Helmer',
        'Helmuth', 'Henning', 'Henrik', 'Henry', 'Herman', 'Hermann', 'Holger', 'Hugo', 'Ib', 'Ibrahim', 'Ivan', 'Jack',
        'Jacob', 'Jakob', 'Jan', 'Janne', 'Jens', 'Jeppe', 'Jesper', 'Jimmi', 'Jimmy', 'Joachim', 'Johan', 'Johannes',
        'John', 'Johnny', 'Jon', 'Jonas', 'Jonathan', 'Josef', 'Jul', 'Julius', 'Jørgen', 'Jørn', 'Kai', 'Kaj',
        'Karl', 'Karlo', 'Karsten', 'Kasper', 'Kenneth', 'Kent', 'Kevin', 'Kjeld', 'Klaus', 'Knud', 'Kristian', 'Kristoffer',
        'Kurt', 'Lars', 'Lasse', 'Leif', 'Lennart', 'Leo', 'Leon', 'Louis', 'Lucas', 'Lukas', 'Mads', 'Magnus',
        'Malthe', 'Marc', 'Marcus', 'Marinus', 'Marius', 'Mark', 'Markus', 'Martin', 'Martinus', 'Mathias', 'Max', 'Michael',
        'Mikael', 'Mike', 'Mikkel', 'Mogens', 'Mohamad', 'Mohamed', 'Mohammad', 'Morten', 'Nick', 'Nicklas', 'Nicolai', 'Nicolaj',
        'Niels', 'Niklas', 'Nikolaj', 'Nils', 'Olaf', 'Olav', 'Ole', 'Oliver', 'Oscar', 'Oskar', 'Otto', 'Ove',
        'Palle', 'Patrick', 'Paul', 'Peder', 'Per', 'Peter', 'Philip', 'Poul', 'Preben', 'Rasmus', 'Rene', 'René',
        'Richard', 'Robert', 'Rolf', 'Rudolf', 'Rune', 'Sebastian', 'Sigurd', 'Simon', 'Simone', 'Steen', 'Stefan', 'Steffen',
        'Sten', 'Stig', 'Sune', 'Sven', 'Svend', 'Søren', 'Tage', 'Theodor', 'Thomas', 'Thor', 'Thorvald', 'Tim',
        'Tobias', 'Tom', 'Tommy', 'Tonny', 'Torben', 'Troels', 'Uffe', 'Ulrik', 'Vagn', 'Vagner', 'Valdemar', 'Vang',
        'Verner', 'Victor', 'Viktor', 'Villy', 'Walther', 'Werner', 'Wilhelm', 'William', 'Willy', 'Åge', 'Bendt', 'Bjarke',
        'Chr', 'Eigil', 'Ejgil', 'Ejler', 'Ejnar', 'Ejner', 'Evald', 'Folmer', 'Gunner', 'Gurli', 'Hartvig', 'Herluf', 'Hjalmar',
        'Ingemann', 'Ingolf', 'Ingvard', 'Keld', 'Kresten', 'Laurids', 'Laurits', 'Lauritz', 'Ludvig', 'Lynge', 'Oluf', 'Osvald',
        'Povl', 'Richardt', 'Sigfred', 'Sofus', 'Thorkild', 'Viggo', 'Vilhelm', 'Villiam',
    );

    protected static $firstNameFemale = array(
        'Aase', 'Agathe', 'Agnes', 'Alberte', 'Alexandra', 'Alice', 'Alma', 'Amalie', 'Amanda', 'Andrea', 'Ane', 'Anette', 'Anita',
        'Anja', 'Ann', 'Anna', 'Annalise', 'Anne', 'Anne-Lise', 'Anne-Marie', 'Anne-Mette', 'Annelise', 'Annette', 'Anni', 'Annie',
        'Annika', 'Anny', 'Asta', 'Astrid', 'Augusta', 'Benedikte', 'Bente', 'Berit', 'Bertha', 'Betina', 'Bettina', 'Betty',
        'Birgit', 'Birgitte', 'Birte', 'Birthe', 'Bitten', 'Bodil', 'Britt', 'Britta', 'Camilla', 'Carina', 'Carla', 'Caroline',
        'Cathrine', 'Cecilie', 'Charlotte', 'Christa', 'Christen', 'Christiane', 'Christina', 'Christine', 'Clara', 'Conni', 'Connie', 'Conny',
        'Dagmar', 'Dagny', 'Diana', 'Ditte', 'Dora', 'Doris', 'Dorte', 'Dorthe', 'Ebba', 'Edel', 'Edith', 'Eleonora',
        'Eli', 'Elin', 'Eline', 'Elinor', 'Elisa', 'Elisabeth', 'Elise', 'Ella', 'Ellen', 'Ellinor', 'Elly', 'Elna',
        'Elsa', 'Else', 'Elsebeth', 'Elvira', 'Emilie', 'Emma', 'Emmy', 'Erna', 'Ester', 'Esther', 'Eva', 'Evelyn',
        'Frede', 'Frederikke', 'Freja', 'Frida', 'Gerda', 'Gertrud', 'Gitte', 'Grete', 'Grethe', 'Gudrun', 'Hanna', 'Hanne',
        'Hardy', 'Harriet', 'Hedvig', 'Heidi', 'Helen', 'Helena', 'Helene', 'Helga', 'Helle', 'Henny', 'Henriette', 'Herdis',
        'Hilda', 'Iben', 'Ida', 'Ilse', 'Ina', 'Inga', 'Inge', 'Ingeborg', 'Ingelise', 'Inger', 'Ingrid', 'Irene',
        'Iris', 'Irma', 'Isabella', 'Jane', 'Janni', 'Jannie', 'Jeanette', 'Jeanne', 'Jenny', 'Jes', 'Jette', 'Joan',
        'Johanna', 'Johanne', 'Jonna', 'Josefine', 'Josephine', 'Juliane', 'Julie', 'Jytte', 'Kaja', 'Kamilla', 'Karen', 'Karin',
        'Karina', 'Karla', 'Karoline', 'Kate', 'Kathrine', 'Katja', 'Katrine', 'Ketty', 'Kim', 'Kirsten', 'Kirstine', 'Klara',
        'Krista', 'Kristen', 'Kristina', 'Kristine', 'Laila', 'Laura', 'Laurine', 'Lea', 'Lena', 'Lene', 'Lilian', 'Lilli',
        'Lillian', 'Lilly', 'Linda', 'Line', 'Lis', 'Lisa', 'Lisbet', 'Lisbeth', 'Lise', 'Liselotte', 'Lissi', 'Lissy',
        'Liv', 'Lizzie', 'Lone', 'Lotte', 'Louise', 'Lydia', 'Lykke', 'Lærke', 'Magda', 'Magdalene', 'Mai', 'Maiken',
        'Maj', 'Maja', 'Majbritt', 'Malene', 'Maren', 'Margit', 'Margrethe', 'Maria', 'Mariane', 'Marianne', 'Marie', 'Marlene',
        'Martha', 'Martine', 'Mary', 'Mathilde', 'Matilde', 'Merete', 'Merethe', 'Meta', 'Mette', 'Mia', 'Michelle', 'Mie',
        'Mille', 'Minna', 'Mona', 'Monica', 'Nadia', 'Nancy', 'Nanna', 'Nicoline', 'Nikoline', 'Nina', 'Ninna', 'Oda',
        'Olga', 'Olivia', 'Orla', 'Paula', 'Pauline', 'Pernille', 'Petra', 'Pia', 'Poula', 'Ragnhild', 'Randi', 'Rasmine',
        'Rebecca', 'Rebekka', 'Rigmor', 'Rikke', 'Rita', 'Rosa', 'Rose', 'Ruth', 'Sabrina', 'Sandra', 'Sanne', 'Sara',
        'Sarah', 'Selma', 'Severin', 'Sidsel', 'Signe', 'Sigrid', 'Sine', 'Sofia', 'Sofie', 'Solveig', 'Solvejg', 'Sonja',
        'Sophie', 'Stephanie', 'Stine', 'Susan', 'Susanne', 'Tanja', 'Thea', 'Theodora', 'Therese', 'Thi', 'Thyra', 'Tina',
        'Tine', 'Tove', 'Trine', 'Ulla', 'Vera', 'Vibeke', 'Victoria', 'Viktoria', 'Viola', 'Vita', 'Vivi', 'Vivian',
        'Winnie', 'Yrsa', 'Yvonne', 'Agnete', 'Agnethe', 'Alfrida', 'Alvilda', 'Anine', 'Bolette', 'Dorthea', 'Gunhild',
        'Hansine', 'Inge-Lise', 'Jensine', 'Juel', 'Jørgine', 'Kamma', 'Kristiane', 'Maj-Britt', 'Margrete', 'Metha', 'Nielsine',
        'Oline', 'Petrea', 'Petrine', 'Pouline', 'Ragna', 'Sørine', 'Thora', 'Valborg', 'Vilhelmine',
    );

    /**
     * @var array Danish middle names.
     */
    protected static $middleName = array(
        'Møller', 'Lund', 'Holm', 'Jensen', 'Juul', 'Nielsen', 'Kjær', 'Hansen', 'Skov', 'Østergaard', 'Vestergaard',
        'Nørgaard', 'Dahl', 'Bach', 'Friis', 'Søndergaard', 'Andersen', 'Bech', 'Pedersen', 'Bruun', 'Nygaard', 'Winther',
        'Bang', 'Krogh', 'Schmidt', 'Christensen', 'Hedegaard', 'Toft', 'Damgaard', 'Holst', 'Sørensen', 'Juhl', 'Munk',
        'Skovgaard', 'Søgaard', 'Aagaard', 'Berg', 'Dam', 'Petersen', 'Lind', 'Overgaard', 'Brandt', 'Larsen', 'Bak', 'Schou',
        'Vinther', 'Bjerregaard', 'Riis', 'Bundgaard', 'Kruse', 'Mølgaard', 'Hjorth', 'Ravn', 'Madsen', 'Rasmussen',
        'Jørgensen', 'Kristensen', 'Bonde', 'Bay', 'Hougaard', 'Dalsgaard', 'Kjærgaard', 'Haugaard', 'Munch', 'Bjerre', 'Due',
        'Sloth', 'Leth', 'Kofoed', 'Thomsen', 'Kragh', 'Højgaard', 'Dalgaard', 'Hjort', 'Kirkegaard', 'Bøgh', 'Beck', 'Nissen',
        'Rask', 'Høj', 'Brix', 'Storm', 'Buch', 'Bisgaard', 'Birch', 'Gade', 'Kjærsgaard', 'Hald', 'Lindberg', 'Høgh', 'Falk',
        'Koch', 'Thorup', 'Borup', 'Knudsen', 'Vedel', 'Poulsen', 'Bøgelund', 'Juel', 'Frost', 'Hvid', 'Bjerg', 'Bæk', 'Elkjær',
        'Hartmann', 'Kirk', 'Sand', 'Sommer', 'Skou', 'Nedergaard', 'Meldgaard', 'Brink', 'Lindegaard', 'Fischer', 'Rye',
        'Hoffmann', 'Daugaard', 'Gram', 'Johansen', 'Meyer', 'Schultz', 'Fogh', 'Bloch', 'Lundgaard', 'Brøndum', 'Jessen',
        'Busk', 'Holmgaard', 'Lindholm', 'Krog', 'Egelund', 'Engelbrecht', 'Buus', 'Korsgaard', 'Ellegaard', 'Tang', 'Steen',
        'Kvist', 'Olsen', 'Nørregaard', 'Fuglsang', 'Wulff', 'Damsgaard', 'Hauge', 'Sonne', 'Skytte', 'Brun', 'Kronborg',
        'Abildgaard', 'Fabricius', 'Bille', 'Skaarup', 'Rahbek', 'Borg', 'Torp', 'Klitgaard', 'Nørskov', 'Greve', 'Hviid',
        'Mørch', 'Buhl', 'Rohde', 'Mørk', 'Vendelbo', 'Bjørn', 'Laursen', 'Egede', 'Rytter', 'Lehmann', 'Guldberg', 'Rosendahl',
        'Krarup', 'Krogsgaard', 'Westergaard', 'Rosendal', 'Fisker', 'Højer', 'Rosenberg', 'Svane', 'Storgaard', 'Pihl',
        'Mohamed', 'Bülow', 'Birk', 'Hammer', 'Bro', 'Kaas', 'Clausen', 'Nymann', 'Egholm', 'Ingemann', 'Haahr', 'Olesen',
        'Nøhr', 'Brinch', 'Bjerring', 'Christiansen', 'Schrøder', 'Guldager', 'Skjødt', 'Højlund', 'Ørum', 'Weber',
        'Bødker', 'Bruhn', 'Stampe', 'Astrup', 'Schack', 'Mikkelsen', 'Høyer', 'Husted', 'Skriver', 'Lindgaard', 'Yde',
        'Sylvest', 'Lykkegaard', 'Ploug', 'Gammelgaard', 'Pilgaard', 'Brogaard', 'Degn', 'Kaae', 'Kofod', 'Grønbæk',
        'Lundsgaard', 'Bagge', 'Lyng', 'Rømer', 'Kjeldgaard', 'Hovgaard', 'Groth', 'Hyldgaard', 'Ladefoged', 'Jacobsen',
        'Linde', 'Lange', 'Stokholm', 'Bredahl', 'Hein', 'Mose', 'Bækgaard', 'Sandberg', 'Klarskov', 'Kamp', 'Green',
        'Iversen', 'Riber', 'Smedegaard', 'Nyholm', 'Vad', 'Balle', 'Kjeldsen', 'Strøm', 'Borch', 'Lerche', 'Grønlund',
        'Vestergård', 'Østergård', 'Nyborg', 'Qvist', 'Damkjær', 'Kold', 'Sønderskov', 'Bank',
    );

    /**
     * @var array Danish last names.
     */
    protected static $lastName = array(
        'Jensen', 'Nielsen', 'Hansen', 'Pedersen', 'Andersen', 'Christensen', 'Larsen', 'Sørensen', 'Rasmussen', 'Petersen',
        'Jørgensen', 'Madsen', 'Kristensen', 'Olsen', 'Christiansen', 'Thomsen', 'Poulsen', 'Johansen', 'Knudsen', 'Mortensen',
        'Møller', 'Jacobsen', 'Jakobsen', 'Olesen', 'Frederiksen', 'Mikkelsen', 'Henriksen', 'Laursen', 'Lund', 'Schmidt',
        'Eriksen', 'Holm', 'Kristiansen', 'Clausen', 'Simonsen', 'Svendsen', 'Andreasen', 'Iversen', 'Jeppesen', 'Mogensen',
        'Jespersen', 'Nissen', 'Lauridsen', 'Frandsen', 'Østergaard', 'Jepsen', 'Kjær', 'Carlsen', 'Vestergaard', 'Jessen',
        'Nørgaard', 'Dahl', 'Christoffersen', 'Skov', 'Søndergaard', 'Bertelsen', 'Bruun', 'Lassen', 'Bach', 'Gregersen',
        'Friis', 'Johnsen', 'Steffensen', 'Kjeldsen', 'Bech', 'Krogh', 'Lauritsen', 'Danielsen', 'Mathiesen', 'Andresen',
        'Brandt', 'Winther', 'Toft', 'Ravn', 'Mathiasen', 'Dam', 'Holst', 'Nilsson', 'Lind', 'Berg', 'Schou', 'Overgaard',
        'Kristoffersen', 'Schultz', 'Klausen', 'Karlsen', 'Paulsen', 'Hermansen', 'Thorsen', 'Koch', 'Thygesen', 'Bak', 'Kruse',
        'Bang', 'Juhl', 'Davidsen', 'Berthelsen', 'Nygaard', 'Lorentzen', 'Villadsen', 'Lorenzen', 'Damgaard', 'Bjerregaard',
        'Lange', 'Hedegaard', 'Bendtsen', 'Lauritzen', 'Svensson', 'Justesen', 'Juul', 'Hald', 'Beck', 'Kofoed', 'Søgaard',
        'Meyer', 'Kjærgaard', 'Riis', 'Johannsen', 'Carstensen', 'Bonde', 'Ibsen', 'Fischer', 'Andersson', 'Bundgaard',
        'Johannesen', 'Eskildsen', 'Hemmingsen', 'Andreassen', 'Thomassen', 'Schrøder', 'Persson', 'Hjorth', 'Enevoldsen',
        'Nguyen', 'Henningsen', 'Jønsson', 'Olsson', 'Asmussen', 'Michelsen', 'Vinther', 'Markussen', 'Kragh', 'Thøgersen',
        'Johansson', 'Dalsgaard', 'Gade', 'Bjerre', 'Ali', 'Laustsen', 'Buch', 'Ludvigsen', 'Hougaard', 'Kirkegaard', 'Marcussen',
        'Mølgaard', 'Ipsen', 'Sommer', 'Ottosen', 'Müller', 'Krog', 'Hoffmann', 'Clemmensen', 'Nikolajsen', 'Brodersen',
        'Therkildsen', 'Leth', 'Michaelsen', 'Graversen', 'Frost', 'Dalgaard', 'Albertsen', 'Laugesen', 'Due', 'Ebbesen',
        'Munch', 'Svenningsen', 'Ottesen', 'Fisker', 'Albrechtsen', 'Axelsen', 'Erichsen', 'Sloth', 'Bentsen', 'Westergaard',
        'Bisgaard', 'Nicolaisen', 'Magnussen', 'Thuesen', 'Povlsen', 'Thorup', 'Høj', 'Bentzen', 'Johannessen', 'Vilhelmsen',
        'Isaksen', 'Bendixen', 'Ovesen', 'Villumsen', 'Lindberg', 'Thomasen', 'Kjærsgaard', 'Buhl', 'Kofod', 'Ahmed', 'Smith',
        'Storm', 'Christophersen', 'Bruhn', 'Matthiesen', 'Wagner', 'Bjerg', 'Gram', 'Nedergaard', 'Dinesen', 'Mouritsen',
        'Boesen', 'Borup', 'Abrahamsen', 'Wulff', 'Gravesen', 'Rask', 'Pallesen', 'Greve', 'Korsgaard', 'Haugaard', 'Josefsen',
        'Bæk', 'Espersen', 'Thrane', 'Mørch', 'Frank', 'Lynge', 'Rohde', 'Larsson', 'Hammer', 'Torp', 'Sonne', 'Boysen', 'Bay',
        'Pihl', 'Fabricius', 'Høyer', 'Birch', 'Skou', 'Kirk', 'Antonsen', 'Høgh', 'Damsgaard', 'Dall', 'Truelsen', 'Daugaard',
        'Fuglsang', 'Martinsen', 'Therkelsen', 'Jansen', 'Karlsson', 'Caspersen', 'Steen', 'Callesen', 'Balle', 'Bloch', 'Smidt',
        'Rahbek', 'Hjort', 'Bjørn', 'Skaarup', 'Sand', 'Storgaard', 'Willumsen', 'Busk', 'Hartmann', 'Ladefoged', 'Skovgaard',
        'Philipsen', 'Damm', 'Haagensen', 'Hviid', 'Duus', 'Kvist', 'Adamsen', 'Mathiassen', 'Degn', 'Borg', 'Brix', 'Troelsen',
        'Ditlevsen', 'Brøndum', 'Svane', 'Mohamed', 'Birk', 'Brink', 'Hassan', 'Vester', 'Elkjær', 'Lykke', 'Nørregaard',
        'Meldgaard', 'Mørk', 'Hvid', 'Abildgaard', 'Nicolajsen', 'Bengtsson', 'Stokholm', 'Ahmad', 'Wind', 'Rømer', 'Gundersen',
        'Carlsson', 'Grøn', 'Khan', 'Skytte', 'Bagger', 'Hendriksen', 'Rosenberg', 'Jonassen', 'Severinsen', 'Jürgensen',
        'Boisen', 'Groth', 'Bager', 'Fogh', 'Hussain', 'Samuelsen', 'Pilgaard', 'Bødker', 'Dideriksen', 'Brogaard', 'Lundberg',
        'Hansson', 'Schwartz', 'Tran', 'Skriver', 'Klitgaard', 'Hauge', 'Højgaard', 'Qvist', 'Voss', 'Strøm', 'Wolff', 'Krarup',
        'Green', 'Odgaard', 'Tønnesen', 'Blom', 'Gammelgaard', 'Jæger', 'Kramer', 'Astrup', 'Würtz', 'Lehmann', 'Koefoed',
        'Skøtt', 'Lundsgaard', 'Bøgh', 'Vang', 'Martinussen', 'Sandberg', 'Weber', 'Holmgaard', 'Bidstrup', 'Meier', 'Drejer',
        'Schneider', 'Joensen', 'Dupont', 'Lorentsen', 'Bro', 'Bagge', 'Terkelsen', 'Kaspersen', 'Keller', 'Eliasen', 'Lyberth',
        'Husted', 'Mouritzen', 'Krag', 'Kragelund', 'Nørskov', 'Vad', 'Jochumsen', 'Hein', 'Krogsgaard', 'Kaas', 'Tolstrup',
        'Ernst', 'Hermann', 'Børgesen', 'Skjødt', 'Holt', 'Buus', 'Gotfredsen', 'Kjeldgaard', 'Broberg', 'Roed', 'Sivertsen',
        'Bergmann', 'Bjerrum', 'Petersson', 'Smed', 'Jeremiassen', 'Nyborg', 'Borch', 'Foged', 'Terp', 'Mark', 'Busch',
        'Lundgaard', 'Boye', 'Yde', 'Hinrichsen', 'Matzen', 'Esbensen', 'Hertz', 'Westh', 'Holmberg', 'Geertsen', 'Raun',
        'Aagaard', 'Kock', 'Falk', 'Munk',
    );

    /**
     * Randomly return a danish name.
     *
     * @return string
     */
    public static function middleName()
    {
        return static::randomElement(static::$middleName);
    }

    /**
     * Randomly return a danish CPR number (Personnal identification number) format.
     *
     * @link http://cpr.dk/cpr/site.aspx?p=16
     * @link http://en.wikipedia.org/wiki/Personal_identification_number_%28Denmark%29
     *
     * @return string
     */
    public static function cpr()
    {
        $birthdate = new \DateTime('@' . mt_rand(0, time()));

        return sprintf('%s-%s', $birthdate->format('dmy'), static::numerify('%###'));
    }
}
                     <?php

namespace Faker\Test;

use Faker\DefaultGenerator;

class DefaultGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneratorReturnsNullByDefault()
    {
        $generator = new DefaultGenerator;
        $this->assertSame(null, $generator->value);
    }

    public function testGeneratorReturnsDefaultValueForAnyPropertyGet()
    {
        $generator = new DefaultGenerator(123);
        $this->assertSame(123, $generator->foo);
        $this->assertNotSame(null, $generator->bar);
    }

    public function testGeneratorReturnsDefaultValueForAnyMethodCall()
    {
        $generator = new DefaultGenerator(123);
        $this->assertSame(123, $generator->foobar());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace Mockery;

use Mockery\Generator\Generator;
use Mockery\Generator\MockConfigurationBuilder;
use Mockery\Loader\Loader as LoaderInterface;

class Container
{
    const BLOCKS = \Mockery::BLOCKS;

    /**
     * Store of mock objects
     *
     * @var array
     */
    protected $_mocks = array();

    /**
     * Order number of allocation
     *
     * @var int
     */
    protected $_allocatedOrder = 0;

    /**
     * Current ordered number
     *
     * @var int
     */
    protected $_currentOrder = 0;

    /**
     * Ordered groups
     *
     * @var array
     */
    protected $_groups = array();

    /**
     * @var Generator
     */
    protected $_generator;

    /**
     * @var LoaderInterface
     */
    protected $_loader;

    /**
     * @var array
     */
    protected $_namedMocks = array();

    public function __construct(Generator $generator = null, LoaderInterface $loader = null)
    {
        $this->_generator = $generator ?: \Mockery::getDefaultGenerator();
        $this->_loader = $loader ?: \Mockery::getDefaultLoader();
    }

    /**
     * Generates a new mock object for this container
     *
     * I apologies in advance for this. A God Method just fits the API which
     * doesn't require differentiating between classes, interfaces, abstracts,
     * names or partials - just so long as it's something that can be mocked.
     * I'll refactor it one day so it's easier to follow.
     *
     * @param array $args
     *
     * @return Mock
     * @throws Exception\RuntimeException
     */
    public function mock(...$args)
    {
        $expectationClosure = null;
        $quickdefs = array();
        $constructorArgs = null;
        $blocks = array();

        if (count($args) > 1) {
            $finalArg = end($args);
            reset($args);
            if (is_callable($finalArg) && is_object($finalArg)) {
                $expectationClosure = array_pop($args);
            }
        }

        $builder = new MockConfigurationBuilder();

        foreach ($args as $k => $arg) {
            if ($arg instanceof MockConfigurationBuilder) {
                $builder = $arg;
                unset($args[$k]);
            }
        }
        reset($args);

        $builder->setParameterOverrides(\Mockery::getConfiguration()->getInternalClassMethodParamMaps());

        while (count($args) > 0) {
            $arg = current($args);
            // check for multiple interfaces
            if (is_string($arg) && strpos($arg, ',') && !strpos($arg, ']')) {
                $interfaces = explode(',', str_replace(' ', '', $arg));
                $builder->addTargets($interface
his->assertEquals('foo', $domResponse->getContent());
    }

    public function testUploadedFile()
    {
        $source = tempnam(sys_get_temp_dir(), 'source');
        file_put_contents($source, '1');
        $target = sys_get_temp_dir().'/sf.moved.file';
        @unlink($target);

        $kernel = new TestHttpKernel();
        $client = new Client($kernel);

        $files = array(
            array('tmp_name' => $source, 'name' => 'original', 'type' => 'mime/original', 'size' => null, 'error' => UPLOAD_ERR_OK),
            new UploadedFile($source, 'original', 'mime/original', UPLOAD_ERR_OK, true),
        );

        $file = null;
        foreach ($files as $file) {
            $client->request('POST', '/', array(), array('foo' => $file));

            $files = $client->getRequest()->files->all();

            $this->assertCount(1, $files);

            $file = $files['foo'];

            $this->assertEquals('original', $file->getClientOriginalName());
            $this->assertEquals('mime/original', $file->getClientMimeType());
            $this->assertEquals(1, $file->getSize());
        }

        $file->move(dirname($target), basename($target));

        $this->assertFileExists($target);
        unlink($target);
    }

    public function testUploadedFileWhenNoFileSelected()
    {
        $kernel = new TestHttpKernel();
        $client = new Client($kernel);

        $file = array('tmp_name' => '', 'name' => '', 'type' => '', 'size' => 0, 'error' => UPLOAD_ERR_NO_FILE);

        $client->request('POST', '/', array(), array('foo' => $file));

        $files = $client->getRequest()->files->all();

        $this->assertCount(1, $files);
        $this->assertNull($files['foo']);
    }

    public function testUploadedFileWhenSizeExceedsUploadMaxFileSize()
    {
        $source = tempnam(sys_get_temp_dir(), 'source');

        $kernel = new TestHttpKernel();
        $client = new Client($kernel);

        $file = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\File\UploadedFile')
            ->setConstructorArgs(array($source, 'original', 'mime/original', UPLOAD_ERR_OK, true))
            ->setMethods(array('getSize', 'getClientSize'))
            ->getMock()
        ;
        /* should be modified when the getClientSize will be removed */
        $file->expects($this->any())
            ->method('getSize')
            ->will($this->returnValue(INF))
        ;
        $file->expects($this->any())
            ->method('getClientSize')
            ->will($this->returnValue(INF))
        ;

        $client->request('POST', '/', array(), array($file));

        $files = $client->getRequest()->files->all();

        $this->assertCount(1, $files);

        $file = $files[0];

        $this->assertFalse($file->isValid());
        $this->assertEquals(UPLOAD_ERR_INI_SIZE, $file->getError());
        $this->assertEquals('mime/original', $file->getClientMimeType());
        $this->assertEquals('original', $file->getClientOriginalName());
        $this->assertEquals(0, $file->getSize());

        unlink($source);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Provides fixed-width byte sizes for reading fixed-width character sets.
 *
 * @author     Chris Corbyn
 * @author     Xavier De Cock <xdecock@gmail.com>
 */
class Swift_CharacterReader_GenericFixedWidthReader implements Swift_CharacterReader
{
    /**
     * The number of bytes in a single character.
     *
     * @var int
     */
    private $width;

    /**
     * Creates a new GenericFixedWidthReader using $width bytes per character.
     *
     * @param int $width
     */
    public function __construct($width)
    {
        $this->width = $width;
    }

    /**
     * Returns the complete character map.
     *
     * @param string $string
     * @param int    $startOffset
     * @param array  $currentMap
     * @param mixed  $ignoredChars
     *
     * @return int
     */
    public function getCharPositions($string, $startOffset, &$currentMap, &$ignoredChars)
    {
        $strlen = strlen($string);
        // % and / are CPU intensive, so, maybe find a better way
        $ignored = $strlen % $this->width;
        $ignoredChars = $ignored ? substr($string, -$ignored) : '';
        $currentMap = $this->width;

        return ($strlen - $ignored) / $this->width;
    }

    /**
     * Returns the mapType.
     *
     * @return int
     */
    public function getMapType()
    {
        return self::MAP_TYPE_FIXED_LEN;
    }

    /**
     * Returns an integer which specifies how many more bytes to read.
     *
     * A positive integer indicates the number of more bytes to fetch before invoking
     * this method again.
     *
     * A value of zero means this is already a valid character.
     * A value of -1 means this cannot possibly be a valid character.
     *
     * @param string $bytes
     * @param int    $size
     *
     * @return int
     */
    public function validateByteSequence($bytes, $size)
    {
        $needed = $this->width - $size;

        return $needed > -1 ? $needed : -1;
    }

    /**
     * Returns the number of bytes which should be read to start each character.
     *
     * @return int
     */
    public function getInitialByteSize()
    {
        return $this->width;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
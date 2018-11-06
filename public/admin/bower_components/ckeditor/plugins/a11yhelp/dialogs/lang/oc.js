= 'Given Json strings do not match';

        $this->assertJsonStringEqualsJsonString($expected, $actual, $message);
    }

    /**
     * @dataProvider validInvalidJsonDataprovider
     */
    public function testAssertJsonStringEqualsJsonStringErrorRaised($expected, $actual)
    {
        $this->expectException(AssertionFailedError::class);

        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }

    public function testAssertJsonStringNotEqualsJsonString()
    {
        $expected = '{"Mascott" : "Beastie"}';
        $actual   = '{"Mascott" : "Tux"}';
        $message  = 'Given Json strings do match';

        $this->assertJsonStringNotEqualsJsonString($expected, $actual, $message);
    }

    /**
     * @dataProvider validInvalidJsonDataprovider
     */
    public function testAssertJsonStringNotEqualsJsonStringErrorRaised($expected, $actual)
    {
        $this->expectException(AssertionFailedError::class);

        $this->assertJsonStringNotEqualsJsonString($expected, $actual);
    }

    public function testAssertJsonStringEqualsJsonFile()
    {
        $file    = __DIR__ . '/../_files/JsonData/simpleObject.json';
        $actual  = \json_encode(['Mascott' => 'Tux']);
        $message = '';

        $this->assertJsonStringEqualsJsonFile($file, $actual, $message);
    }

    public function testAssertJsonStringEqualsJsonFileExpectingExpectationFailedException()
    {
        $file    = __DIR__ . '/../_files/JsonData/simpleObject.json';
        $actual  = \json_encode(['Mascott' => 'Beastie']);
        $message = '';

        try {
            $this->assertJsonStringEqualsJsonFile($file, $actual, $message);
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                'Failed asserting that \'{"Mascott":"Beastie"}\' matches JSON string "{"Mascott":"Tux"}".',
                $e->getMessage()
            );

            return;
        }

        $this->fail('Expected Exception not thrown.');
    }

    public function testAssertJsonStringEqualsJsonFileExpectingException()
    {
        $file = __DIR__ . '/../_files/JsonData/simpleObject.json';

        try {
            $this->assertJsonStringEqualsJsonFile($file, null);
        } catch (Exception $e) {
            return;
        }

        $this->fail('Expected Exception not thrown.');
    }

    public function testAssertJsonStringNotEqualsJsonFile()
    {
        $file    = __DIR__ . '/../_files/JsonData/simpleObject.json';
        $actual  = \json_encode(['Mascott' => 'Beastie']);
        $message = '';

        $this->assertJsonStringNotEqualsJsonFile($file, $actual, $message);
    }

    public function testAssertJsonStringNotEqualsJsonFileExpectingException()
    {
        $file = __DIR__ . '/../_files/JsonData/simpleObject.json';

        try {
            $this->assertJsonStringNotEqualsJsonFile($file, null);
        } catch (Exception $e) {
            return;
        }

        $this->fail('Expected exception not found.');
    }

    public function testAssertJsonFileNotEqualsJsonFile()
    {
        $fileExpected = __DIR__ . '/../_files/JsonData/simpleObject.json';
        $fileActual   = __DIR__ . '/../_files/JsonData/arrayObject.json';
        $message      = '';

        $this->assertJsonFileNotEqualsJsonFile($fileExpected, $fileActual, $message);
    }

    public function testAssertJsonFileEqualsJsonFile()
    {
        $file    = __DIR__ . '/../_files/JsonData/simpleObject.json';
        $message = '';

        $this->assertJsonFileEqualsJsonFile($file, $file, $message);
    }

    public function testAssertInstanceOf()
    {
        $this->assertInstanceOf(\stdClass::class, new \stdClass);

        $this->expectException(AssertionFailedError::class);

        $this->assertInstanceOf(\Exception::class, new \stdClass);
    }

    public function testAssertInstanceOfThrowsExceptionForInvalidArgument()
    {
        $this->expectException(Exception::class);

        $this->assertInstanceOf(null, new \stdClass);
    }

    public function testAssertAttributeInstanceOf()
    {
        $o    = new \stdClass;
        $o->a = new \stdClass;

        $this->assertAttributeInstanceOf(\stdClass::class, 'a', $o);
    }

    public function testAssertNotInstanceOf()
    {
        $this->assertNotInstanceOf(\Exception::class, new \stdClass);

        $this->expectException(AssertionFailedError::class);

        $this->assertNotInstanceOf(\stdClass::class, new \stdClass);
    }

    public function testAssertNotInstanceOfThrowsExceptionForInvalidArgument()
    {
        $this->expectException(Exception::class);

        $this->assertNotInstanceOf(null, new \stdClass);
    }

    public function testAssertAttributeNotInstanceOf()
    {
        $o    = new \stdClass;
        $o->a = new \stdClass;

        $this->assertAttributeNotInstanceOf(\Exception::class, 'a', $o);
    }

    public function testAssertInternalType()
    {
        $this->assertInternalType('integer', 1);

        $this->expectException(AssertionFailedError::class);

        $this->assertInternalType('str
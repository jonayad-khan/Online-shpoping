    $this->assertEquals('logger', $message['CTXfrom']);
    }

    /**
     * @covers Monolog\Formatter\LogstashFormatter::format
     */
    public function testFormatWithExtraV1()
    {
        $formatter = new LogstashFormatter('test', null, null, 'ctxt_', LogstashFormatter::V1);
        $record = array(
            'level' => Logger::ERROR,
            'level_name' => 'ERROR',
            'channel' => 'meh',
            'context' => array('from' => 'logger'),
            'datetime' => new \DateTime("@0"),
            'extra' => array('key' => 'pair'),
            'message' => 'log',
        );

        $message = json_decode($formatter->format($record), true);

        $this->assertArrayHasKey('key', $message);
        $this->assertEquals('pair', $message['key']);

        // Test with extraPrefix
        $formatter = new LogstashFormatter('test', null, 'EXT', 'ctxt_', LogstashFormatter::V1);
        $message = json_decode($formatter->format($record), true);

        $this->assertArrayHasKey('EXTkey', $message);
        $this->assertEquals('pair', $message['EXTkey']);
    }

    public function testFormatWithApplicationNameV1()
    {
        $formatter = new LogstashFormatter('app', 'test', null, 'ctxt_', LogstashFormatter::V1);
        $record = array(
            'level' => Logger::ERROR,
            'level_name' => 'ERROR',
            'channel' => 'meh',
            'context' => array('from' => 'logger'),
            'datetime' => new \DateTime("@0"),
            'extra' => array('key' => 'pair'),
            'message' => 'log',
        );

        $message = json_decode($formatter->format($record), true);

        $this->assertArrayHasKey('type', $message);
        $this->assertEquals('app', $message['type']);
    }

    public function testFormatWithLatin9Data()
    {
        if (version_compare(PHP_VERSION, '5.5.0', '<')) {
            // Ignore the warning that will be emitted by PHP <5.5.0
            \PHPUnit_Framework_Error_Warning::$enabled = false;
        }
        $formatter = new LogstashFormatter('test', 'hostname');
        $record = array(
            'level' => Logger::ERROR,
            'level_name' => 'ERROR',
            'channel' => '¯\_(ツ)_/¯',
            'context' => array(),
            'datetime' => new \DateTime("@0"),
            'extra' => array(
                'user_agent' => "\xD6WN; FBCR/OrangeEspa\xF1a; Vers\xE3o/4.0; F\xE4rist",
            ),
            'message' => 'log',
        );

        $message = json_decode($formatter->format($record), true);

        $this->assertEquals("1970-01-01T00:00:00.000000+00:00", $message['@timestamp']);
        $this->assertEquals('log', $message['@message']);
        $this->assertEquals('¯\_(ツ)_/¯', $message['@fields']['channel']);
        $this->assertContains('¯\_(ツ)_/¯', $message['@tags']);
        $this->assertEquals(Logger::ERROR, $message['@fields']['level']);
        $this->assertEquals('test', $message['@type']);
        $this->assertEquals('hostname', $message['@source']);
        if (version_compare(PHP_VERSION, '5.5.0', '>=')) {
            $this->assertEquals('ÖWN; FBCR/OrangeEspaña; Versão/4.0; Färist', $message['@fields']['user_agent']);
        } else {
            // PHP <5.5 does not return false for an element encoding failure,
            // instead it emits a warning (possibly) and nulls the value.
            $this->assertEquals(null, $message['@fields']['user_agent']);
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                        
                    'nest3' => '[...]',
                    'class' => 'stdClass',
                ),
            ),
            $formattedResult['context']
        );
    }

    public function testFormatDepthException()
    {
        $record = array(
            'message' => 'some log message',
            'context' => array(
                'nest2' => new \Exception('exception message', 987),
            ),
            'level' => Logger::WARNING,
            'level_name' => Logger::getLevelName(Logger::WARNING),
            'channel' => 'test',
            'datetime' => new \DateTime('2014-02-01 00:00:00'),
            'extra' => array(),
        );

        $formatter = new MongoDBFormatter(2, false);
        $formattedRecord = $formatter->format($record);

        $this->assertEquals('exception 
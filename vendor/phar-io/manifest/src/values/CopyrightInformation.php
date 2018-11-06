eturn(false);

            $this->encoder->encodeByteStream($os, $is);
            $this->assertRegExp('~^[a-zA-Z0-9/\+]{3}=$~', $collection->content,
                '%s: Two bytes should have 1 byte of padding'
                );
        }

        for ($i = 0; $i < 30; ++$i) {
            $os = $this->createOutputByteStream();
            $is = $this->createInputByteStream();
            $collection = new Swift_StreamCollector();

            $is->shouldReceive('write')
               ->zeroOrMoreTimes()
               ->andReturnUsing($collection);
            $os->shouldReceive('read')
               ->once()
               ->andReturn(pack('C*', random_int(0, 255), random_int(0, 255), random_int(0, 255)));
            $os->shouldReceive('read')
               ->zeroOrMoreTimes()
               ->andReturn(false);

            $this->encoder->encodeByteStream($os, $is);

ontent
            );
    }

    public function testMaximumLineLengthIsNeverMoreThan76Chars()
    {
        $os = $this->createOutputByteStream();
        $is = $this->createInputByteStream();
        $collection = new Swift_StreamCollector();

        $is->shouldReceive('write')
           ->zeroOrMoreTimes()
           ->andReturnUsing($collection);
        $os->shouldReceive('read')
           ->once()
           ->andReturn('abcdefghijkl'); //12
        $os->shouldReceive('read')
           ->once()
           ->andReturn('mnopqrstuvwx'); //24
        $os->shouldReceive('read')
           ->once()
           ->andReturn('yzabc1234567'); //36
        $os->shouldReceive('read')
           ->once()
           ->andReturn('890ABCDEFGHI'); //48
        $os->shouldReceive('read')
           ->once()
           ->andReturn('JKLMNOPQRSTU'); //60
        $os->shouldRe
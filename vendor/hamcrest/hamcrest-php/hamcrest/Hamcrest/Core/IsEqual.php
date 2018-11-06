such transfers) are
                    known to pad lines of text with SPACEs, and others are
                    known to remove "white space" characters from the end
                    of a line.  Therefore, when decoding a Quoted-Printable
                    body, any trailing white space on a line must be
                    deleted, as it will necessarily have been added by
                    intermediate transport agents.
                    */

        $HT = chr(0x09); //9
        $SPACE = chr(0x20); //32

        //HT
        $os = $this->createOutputByteStream(true);
        $charStream = $this->createCharacterStream();
        $is = $this->createInputByteStream();
        $collection = new Swift_StreamCollector();

        $is->shouldReceive('write')
               ->zeroOrMoreTimes()
               ->andRetur
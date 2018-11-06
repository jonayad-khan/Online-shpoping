()
    {
        $encoder = $this->createEncoderFromContainer();
        $this->assertEquals("a\r\nb\r\nc", $encoder->encodeString("a\rb\rc"));
    }

    public function testEncodingLFCRTextWithDiConfiguredInstance()
    {
        $encoder = $this->createEncoderFromContainer();
        $this->assertEquals("a\r\n\r\nb\r\n\r\nc", $encoder->encodeString("a\n\rb\n\rc"));
    }

    public function testEncodingCRLFTextWithDiConfiguredInstance()
    {
        $encoder = $this->createEncoderFromContainer();
        $this->assertEquals("a\r\nb\r\nc", $encoder->encodeString("a\r\nb\r\nc"));
    }

    public function testEncodingDotStuffingWithDiConfiguredInstance()
    {

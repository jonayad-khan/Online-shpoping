{
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeEquals('foo', 'publicAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeEquals('bar', 'publicAttribute', $obj);
    }

    public function testAssertPublicAttributeNotEquals()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeNotEquals('bar', 'publicAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeNotEquals('foo', 'publicAttribute', $obj);
    }

    public function testAssertPublicAttributeSame()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeSame('foo', 'publicAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeSame('bar', 'publicAttribute', $obj);
    }

    public function testAssertPublicAttributeNotSame()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeNotSame('bar', 'publicAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeNotSame('foo', 'publicAttribute', $obj);
    }

    public function testAssertProtectedAttributeEquals()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeEquals('bar', 'protectedAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeEquals('foo', 'protectedAttribute', $obj);
    }

    public function testAssertProtectedAttributeNotEquals()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeNotEquals('foo', 'protectedAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeNotEquals('bar', 'protectedAttribute', $obj);
    }

    public function testAssertPrivateAttributeEquals()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeEquals('baz', 'privateAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeEquals('foo', 'privateAttribute', $obj);
    }

    public function testAssertPrivateAttributeNotEquals()
    {
        $obj = new \ClassWithNonPublicAttributes;

        $this->assertAttributeNotEquals('foo', 'privateAttribute', $obj);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeNotEquals('baz', 'privateAttribute', $obj);
    }

    public function testAssertPublicStaticAttributeEquals()
    {
        $this->assertAttributeEquals('foo', 'publicStaticAttribute', \ClassWithNonPublicAttributes::class);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeEquals('bar', 'publicStaticAttribute', \ClassWithNonPublicAttributes::class);
    }

    public function testAssertPublicStaticAttributeNotEquals()
    {
        $this->assertAttributeNotEquals('bar', 'publicStaticAttribute', \ClassWithNonPublicAttributes::class);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttr
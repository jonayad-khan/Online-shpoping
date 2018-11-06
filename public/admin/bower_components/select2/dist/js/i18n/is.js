uteEquals('baz', 'privateStaticAttribute', \ClassWithNonPublicAttributes::class);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeEquals('foo', 'privateStaticAttribute', \ClassWithNonPublicAttributes::class);
    }

    public function testAssertPrivateStaticAttributeNotEquals()
    {
        $this->assertAttributeNotEquals('foo', 'privateStaticAttribute', \ClassWithNonPublicAttributes::class);

        $this->expectException(AssertionFailedError::class);

        $this->assertAttributeNotEquals('baz', 'privateStaticAttribute', \ClassWithNonPublicAttributes::class);
    }

    public function testAssertClassHasAttributeThrowsException()
    {
        $this->expectException(Exception::class);

        $this->assertClass
 instanceof MockeryTest_InterfaceWithAbstractMethod);
        $m->shouldReceive('foo')->andReturn(1);
        $this->assertEquals(1, $m->foo());
    }

    public function testCanMockAbstractWithAbstractProtectedMethod()
    {
        $m = $this->container->mock('MockeryTest_AbstractWithAbstractMethod');
        $this->assertTrue($m instanceof MockeryTest_AbstractWithAbstractMethod);
    }

    public function testCanMockInterfaceWithPublicStaticMethod()
    {
        $m = $this->container->mock('MockeryTest_InterfaceWithPublicStaticMethod');
        $this->assertTrue($m instanceof MockeryTest_InterfaceWithPublicStaticMethod);
    }

    public function testCanMockClassWithConstructor()
    {
        $m = $this->container->mock('MockeryTest_ClassConstructor');
        $this->assertTr
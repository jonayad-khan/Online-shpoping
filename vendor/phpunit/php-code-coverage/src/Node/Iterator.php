tialObject()
    {
        $m = $this->container->mock(new MockeryTestBar1, array('foo'=>1, Mockery\Container::BLOCKS => array('method1')));
        $this->assertSame($m, $m->method1());
    }

    public function testPartialWithArrayDefs()
    {
        $m = $this->container->mock(new MockeryTestBar1, array('foo'=>1, Mockery\Container::BLOCKS => array('method1')));
        $this->assertEquals(1, $m->foo());
    }

    public function testPassingClosureAsFinalParameterUsedToDefineExpectations()
    {
        $m = $this->container->mock('foo', function ($m) {
            $m->shouldReceive('foo')->once()->andReturn('bar');
        });
        $this->assertEquals('bar', $m->foo());
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testMockingAKnownConcreteFinalClassThrowsErrors_OnlyPartialMocksCanMockFinalElements()
    {
        $m = $this->container->mock('MockeryFoo3');
    }

    public function testMockingAKnownConcreteClassWithFinalMethodsThrowsNoException()
    {
        $m = $this->container->mock('MockeryFoo4');
    }

    /**
     * @group finalclass
     */
    public function testFinalClassesCanBePartialMocks()
    {
        $m = $this->container->mock(new MockeryFoo3);
        $m->shouldReceive('foo')->andReturn('baz');
        $this->assertEquals('baz', $m->foo());
        $this->assertFalse($m instanceof MockeryFoo3);
    }

    public function testSplClassWithFinalMethodsCanBeMocked()
    {
        $m = $this->container->mock('SplFileInfo');
        $m->shouldReceive('foo')->andReturn('baz');
        $this->assertEquals('baz', $m->foo());
        $this->assertTrue($m instanceof SplFileInfo);
    }

    public function testSplClassWithFinalMethodsCanBeMockedMultipleTimes()
    {
        $this->container->mock('SplFileInfo');
        $m = $this->container->mock('SplFileInfo');
        $m->shouldReceive('foo')->andReturn('baz');
        $this->assertEquals('baz', $m->foo());
        
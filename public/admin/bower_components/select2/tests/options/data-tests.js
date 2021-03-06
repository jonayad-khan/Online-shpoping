   }

    /**
     * @test
     * @expectedException \TypeError
     */
    public function itShouldNotAllowClassToBeNull()
    {
        $mock = $this->container->mock('test\Mockery\Fixtures\MethodWithNullableReturnType');

        $mock->shouldReceive('nonNullableClass')->andReturn(null);
        $mock->nonNullableClass();
    }

    /**
     * @test
     */
    public function itShouldAllowNullalbeClassToBeSet()
    {
        $mock = $this->container->mock('test\Mockery\Fixtures\MethodWithNullableReturnType');

        $mock->shouldReceive('nullableClass')->andReturn(new MethodWithNullableReturnType());
        $mock->nullableClass();
    }

    /**
     * @test
     */
    public function itShouldAllowNullableClassToBeNull()
    {
        $mock = $this->container->mock('test\Mockery\Fixtures\MethodWithNullableReturnType');

        $mock->shouldReceive('nullableClass')->andReturn(null);
        $mock->nullableClass();
    }
}
                                                                                                                     
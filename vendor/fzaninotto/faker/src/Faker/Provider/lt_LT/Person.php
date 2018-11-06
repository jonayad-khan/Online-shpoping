>mock->bar);
    }
    
    public function testSetsPublicPropertiesWhenRequestedMoreTimesThanSetValues()
    {
        $this->mock->bar = null;
        $this->mock->shouldReceive('foo')->andSet('bar', 'baz', 'bazz');
        $this->assertNull($this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('baz', $this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('bazz', $this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('bazz', $this->mock->bar);
    }

    public function testSetsPublicPropertiesWhenRequestedMoreTimesThanSetValuesUsingAlias()
    {
        $this->mock->bar = null;
        $this->mock->shouldReceive('foo')->andSet('bar', 'baz', 'bazz');
        $this->assertNull($this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('baz', $this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('bazz', $this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('bazz', $this->mock->bar);
    }

    public function testSetsPublicPropertiesWhenRequestedMoreTimesThanSetValuesWithDirectSet()
    {
        $this->mock->bar = null;
        $this->mock->shouldReceive('foo')->andSet('bar', 'baz', 'bazz');
        $this->assertNull($this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('baz', $this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('bazz', $this->mock->bar);
        $this->mock->bar = null;
        $this->mock->foo();
        $this->assertNull($this->mock->bar);
    }

    public function testSetsPublicPropertiesWhenRequestedMoreTimesThanSetValuesWithDirectSetUsingAlias()
    {
        $this->mock->bar = null;
        $this->mock->shouldReceive('foo')->set('bar', 'baz', 'bazz');
        $this->assertNull($this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('baz', $this->mock->bar);
        $this->mock->foo();
        $this->assertEquals('bazz', $this->mock->bar);
        $this->mock->bar = null;
        $this->mock->foo();
        $this->assertNull($this->mock->bar);
    }

    public function testReturnsSameValueForAllIfNoArgsExpectationAndSomeGiven()
    {
        $this->mock->shouldReceive('foo')->andReturn(1);
        $this->assertEquals(1, $this->mock->foo('foo'));
    }

    public function testReturnsValueFromSequenceSequentially()
    {
        $this->mock->shouldReceive('foo')->andReturn(1, 2, 3);
        $this->mock->foo('foo');
        $this->assertEquals(2, $this->mock->foo('foo'));
    }

    public function testReturnsValueFromSequenceSequentiallyAndRepeatedlyReturnsFinalValueOnExtraCalls()
    {
        $this->mock->shouldReceive('foo')->andReturn(1, 2, 3);
        $this->mock->foo('foo');
        $this->mock->foo('foo');
        $this->assertEquals(3, $this->mock->foo('foo'));
        $this->assertEquals(3, $this->mock->foo('foo'));
    }

    public function testReturnsValueFromSequenceSequentiallyAndRepeatedlyReturnsFinalValueOnExtraCallsWithManyAndReturnCalls()
    {
        $this->mock->shouldReceive('foo')->andReturn(1)->andReturn(2, 3);
        $this->mock->foo('foo');
        $this->mock->foo('foo');
        $this->assertEquals(3, $this->mock->foo('foo'));
        $this->assertEquals(3, $this->mock->foo('foo'));
    }

    public function testReturnsValueOfClosure()
    {
        $this->mock->shouldReceive('foo')->with(5)->andReturnUsing(function ($v) {return $v+1;});
        $this->assertEquals(6, $this->mock->foo(5));
    }

    public function testReturnsUndefined()
    {
        $this->mock->shouldReceive('foo')->andReturnUndefined();
        $this->assertTrue($this->mock->foo() instanceof \Mockery\Undefined);
    }

    public function testReturnsValuesSetAsArray()
    {
        $this->mock->shouldReceive('foo')->andReturnValues(array(1, 2, 3));
        $this->assertEquals(1, $this->mock->foo());
        $this->assertEquals(2, $this->mock->foo());
        $this->assertEquals(3, $this->mock->foo());
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testThrowsException()
    {
        $this->mock->shouldReceive('foo')->andThrow(new OutOfBoundsException);
        $this->mock->foo();
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testThrowsExceptionBasedOnArgs()
    {
        $this->mock->shouldReceive('foo')->andThrow('OutOfBoundsException');
        $this->mock->foo();
    }

    public function testThrowsExceptionBasedOnArgsWithMessage()
    {
        $this->mock->shouldReceive('foo')->andThrow('OutOfBoundsException', 'foo');
        try {
            $this->mock->foo();
        } catch (OutOfBoundsException $e) {
            $this->assertEquals('foo', $e->getMessage());
        }
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testThrowsExceptionSequentially()
    {
        $this->mock->shouldReceive('foo')->andThrow(new Exception)->andThrow(new OutOfBoundsException);
        try {
            $this->mock->foo();
        } catch (Exception $e) {
        }
        $this->mock->foo();
    }

    public function testAndThrowExceptions()
    {
        $this->mock->shouldReceive('foo')->andThrowExceptions(array(
            new OutOfBoundsException,
            new InvalidArgumentException,
        ));

        try {
            $this->mock->foo();
            throw new Exception("Expected OutOfBoundsException, non thrown");
        } catch (\Exception $e) {
            $this->assertInstanceOf("OutOfBoundsException", $e, "Wrong or no exception thrown: {$e->getMessage()}");
        }

        try {
            $this->mock->foo();
            throw new Exception("Expected InvalidArgumentException, non thrown");
        } catch (\Exception $e) {
            $this->assertInstanceOf("InvalidArgumentException", $e, "Wrong or no exception thrown: {$e->getMessage()}");
        }
    }

    /**
     * @expectedException Mockery\Exception
     * @expectedExceptionMessage You must pass an array of exception objects to andThrowExceptions
     */
    public function testAndThrowExceptionsCatchNonExceptionArgument()
    {
        $this->mock
            ->shouldReceive('foo')
            ->andThrowExceptions(array('NotAnException'));
    }

    public function testMultipleExpectationsWithReturns()
    {
        $this->mock->shouldReceive('foo')->with(1)->andReturn(10);
        $this->mock->shouldReceive('bar')->with(2)->andReturn(20);
        $this->assertEquals(10, $this->mock->foo(1));
        $this->assertEquals(20, $this->mock->bar(2));
    }

    public function testExpectsNoArguments()
    {
        $this->mock->shouldReceive('foo')->withNoArgs();
        $this->mock->foo();
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testExpectsNoArgumentsThrowsExceptionIfAnyPassed()
    {
        $this->mock->shouldReceive('foo')->withNoArgs();
        $this->mock->foo(1);
    }

    public function testExpectsArgumentsArray()
    {
        $this->mock->shouldReceive('foo')->withArgs(array(1, 2));
        $this->mock->foo(1, 2);
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testExpectsArgumentsArrayThrowsExceptionIfPassedEmptyArray()
    {
        $this->mock->shouldReceive('foo')->withArgs(array());
        $this->mock->foo(1, 2);
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testExpectsArgumentsArrayThrowsExceptionIfNoArgumentsPassed()
    {
        $this->mock->shouldReceive('foo')->with();
        $this->mock->foo(1);
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testExpectsArgumentsArrayThrowsExceptionIfPassedWrongArguments()
    {
        $this->mock->shouldReceive('foo')->withArgs(array(1, 2));
        $this->mock->foo(3, 4);
    }

    /**
     * @expectedException \Mockery\Exception
     * @expectedExceptionMessageRegExp /foo\(NULL\)/
     */
    public function testExpectsStringArgumentExceptionMessageDifferentiatesBetweenNullAndEmptyString()
    {
        $this->mock->shouldReceive('foo')->withArgs(array('a string'));
        $this->mock->foo(null);
    }

    public function testExpectsAnyArguments()
    {
        $this->mock->shouldReceive('foo')->withAnyArgs();
        $this->mock->foo();
        $this->mock->foo(1);
        $this->mock->foo(1, 'k', new stdClass);
    }

    public function testExpectsArgumentMatchingRegularExpression()
    {
        $this->mock->shouldReceive('foo')->with('/bar/i');
        $this->mock->foo('xxBARxx');
    }

    public function testExpectsArgumentMatchingObjectType()
    {
        $this->mock->shouldReceive('foo')->with('\stdClass');
        $this->mock->foo(new stdClass);
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testThrowsExceptionOnNoArgumentMatch()
    {
        $this->mock->shouldReceive('foo')->with(1);
        $this->mock->foo(2);
    }

    public function testNeverCalled()
    {
        $this->mock->shouldReceive('foo')->never();
        $this->container->mockery_verify();
    }

    public function testShouldNotReceive()
    {
        $this->mock->shouldNotReceive('foo');
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\Exception\InvalidCountException
     */
    public function testShouldNotReceiveThrowsExceptionIfMethodCalled()
    {
        $this->mock->shouldNotReceive('foo');
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\Exception\InvalidCountException
     */
    public function testShouldNotReceiveWithArgumentThrowsExceptionIfMethodCalled()
    {
        $this->mock->shouldNotReceive('foo')->with(2);
        $this->mock->foo(2);
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testNeverCalledThrowsExceptionOnCall()
    {
        $this->mock->shouldReceive('foo')->never();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledOnce()
    {
        $this->mock->shouldReceive('foo')->once();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCalledOnceThrowsExceptionIfNotCalled()
    {
        $this->mock->shouldReceive('foo')->once();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCalledOnceThrowsExceptionIfCalledTwice()
    {
        $this->mock->shouldReceive('foo')->once();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledTwice()
    {
        $this->mock->shouldReceive('foo')->twice();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCalledTwiceThrowsExceptionIfNotCalled()
    {
        $this->mock->shouldReceive('foo')->twice();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCalledOnceThrowsExceptionIfCalledThreeTimes()
    {
        $this->mock->shouldReceive('foo')->twice();
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledZeroOrMoreTimesAtZeroCalls()
    {
        $this->mock->shouldReceive('foo')->zeroOrMoreTimes();
        $this->container->mockery_verify();
    }

    public function testCalledZeroOrMoreTimesAtThreeCalls()
    {
        $this->mock->shouldReceive('foo')->zeroOrMoreTimes();
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testTimesCountCalls()
    {
        $this->mock->shouldReceive('foo')->times(4);
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testTimesCountCallThrowsExceptionOnTooFewCalls()
    {
        $this->mock->shouldReceive('foo')->times(2);
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testTimesCountCallThrowsExceptionOnTooManyCalls()
    {
        $this->mock->shouldReceive('foo')->times(2);
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledAtLeastOnceAtExactlyOneCall()
    {
        $this->mock->shouldReceive('foo')->atLeast()->once();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledAtLeastOnceAtExactlyThreeCalls()
    {
        $this->mock->shouldReceive('foo')->atLeast()->times(3);
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCalledAtLeastThrowsExceptionOnTooFewCalls()
    {
        $this->mock->shouldReceive('foo')->atLeast()->twice();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledAtMostOnceAtExactlyOneCall()
    {
        $this->mock->shouldReceive('foo')->atMost()->once();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCalledAtMostAtExactlyThreeCalls()
    {
        $this->mock->shouldReceive('foo')->atMost()->times(3);
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCalledAtLeastThrowsExceptionOnTooManyCalls()
    {
        $this->mock->shouldReceive('foo')->atMost()->twice();
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testExactCountersOverrideAnyPriorSetNonExactCounters()
    {
        $this->mock->shouldReceive('foo')->atLeast()->once()->once();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testComboOfLeastAndMostCallsWithOneCall()
    {
        $this->mock->shouldReceive('foo')->atleast()->once()->atMost()->twice();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testComboOfLeastAndMostCallsWithTwoCalls()
    {
        $this->mock->shouldReceive('foo')->atleast()->once()->atMost()->twice();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testComboOfLeastAndMostCallsThrowsExceptionAtTooFewCalls()
    {
        $this->mock->shouldReceive('foo')->atleast()->once()->atMost()->twice();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testComboOfLeastAndMostCallsThrowsExceptionAtTooManyCalls()
    {
        $this->mock->shouldReceive('foo')->atleast()->once()->atMost()->twice();
        $this->mock->foo();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testCallCountingOnlyAppliesToMatchedExpectations()
    {
        $this->mock->shouldReceive('foo')->with(1)->once();
        $this->mock->shouldReceive('foo')->with(2)->twice();
        $this->mock->shouldReceive('foo')->with(3);
        $this->mock->foo(1);
        $this->mock->foo(2);
        $this->mock->foo(2);
        $this->mock->foo(3);
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\CountValidator\Exception
     */
    public function testCallCountingThrowsExceptionOnAnyMismatch()
    {
        $this->mock->shouldReceive('foo')->with(1)->once();
        $this->mock->shouldReceive('foo')->with(2)->twice();
        $this->mock->shouldReceive('foo')->with(3);
        $this->mock->shouldReceive('bar');
        $this->mock->foo(1);
        $this->mock->foo(2);
        $this->mock->foo(3);
        $this->mock->bar();
        $this->container->mockery_verify();
    }

    public function testOrderedCallsWithoutError()
    {
        $this->mock->shouldReceive('foo')->ordered();
        $this->mock->shouldReceive('bar')->ordered();
        $this->mock->foo();
        $this->mock->bar();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testOrderedCallsWithOutOfOrderError()
    {
        $this->mock->shouldReceive('foo')->ordered();
        $this->mock->shouldReceive('bar')->ordered();
        $this->mock->bar();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testDifferentArgumentsAndOrderingsPassWithoutException()
    {
        $this->mock->shouldReceive('foo')->with(1)->ordered();
        $this->mock->shouldReceive('foo')->with(2)->ordered();
        $this->mock->foo(1);
        $this->mock->foo(2);
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testDifferentArgumentsAndOrderingsThrowExceptionWhenInWrongOrder()
    {
        $this->mock->shouldReceive('foo')->with(1)->ordered();
        $this->mock->shouldReceive('foo')->with(2)->ordered();
        $this->mock->foo(2);
        $this->mock->foo(1);
        $this->container->mockery_verify();
    }

    public function testUnorderedCallsIgnoredForOrdering()
    {
        $this->mock->shouldReceive('foo')->with(1)->ordered();
        $this->mock->shouldReceive('foo')->with(2);
        $this->mock->shouldReceive('foo')->with(3)->ordered();
        $this->mock->foo(2);
        $this->mock->foo(1);
        $this->mock->foo(2);
        $this->mock->foo(3);
        $this->mock->foo(2);
        $this->container->mockery_verify();
    }

    public function testOrderingOfDefaultGrouping()
    {
        $this->mock->shouldReceive('foo')->ordered();
        $this->mock->shouldReceive('bar')->ordered();
        $this->mock->foo();
        $this->mock->bar();
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testOrderingOfDefaultGroupingThrowsExceptionOnWrongOrder()
    {
        $this->mock->shouldReceive('foo')->ordered();
        $this->mock->shouldReceive('bar')->ordered();
        $this->mock->bar();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testOrderingUsingNumberedGroups()
    {
        $this->mock->shouldReceive('start')->ordered(1);
        $this->mock->shouldReceive('foo')->ordered(2);
        $this->mock->shouldReceive('bar')->ordered(2);
        $this->mock->shouldReceive('final')->ordered();
        $this->mock->start();
        $this->mock->bar();
        $this->mock->foo();
        $this->mock->bar();
        $this->mock->final();
        $this->container->mockery_verify();
    }

    public function testOrderingUsingNamedGroups()
    {
        $this->mock->shouldReceive('start')->ordered('start');
        $this->mock->shouldReceive('foo')->ordered('foobar');
        $this->mock->shouldReceive('bar')->ordered('foobar');
        $this->mock->shouldReceive('final')->ordered();
        $this->mock->start();
        $this->mock->bar();
        $this->mock->foo();
        $this->mock->bar();
        $this->mock->final();
        $this->container->mockery_verify();
    }

    /**
     * @group 2A
     */
    public function testGroupedUngroupedOrderingDoNotOverlap()
    {
        $s = $this->mock->shouldReceive('start')->ordered();
        $m = $this->mock->shouldReceive('mid')->ordered('foobar');
        $e = $this->mock->shouldReceive('end')->ordered();
        $this->assertTrue($s->getOrderNumber() < $m->getOrderNumber());
        $this->assertTrue($m->getOrderNumber() < $e->getOrderNumber());
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testGroupedOrderingThrowsExceptionWhenCallsDisordered()
    {
        $this->mock->shouldReceive('foo')->ordered('first');
        $this->mock->shouldReceive('bar')->ordered('second');
        $this->mock->bar();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testExpectationMatchingWithNoArgsOrderings()
    {
        $this->mock->shouldReceive('foo')->withNoArgs()->once()->ordered();
        $this->mock->shouldReceive('bar')->withNoArgs()->once()->ordered();
        $this->mock->shouldReceive('foo')->withNoArgs()->once()->ordered();
        $this->mock->foo();
        $this->mock->bar();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testExpectationMatchingWithAnyArgsOrderings()
    {
        $this->mock->shouldReceive('foo')->withAnyArgs()->once()->ordered();
        $this->mock->shouldReceive('bar')->withAnyArgs()->once()->ordered();
        $this->mock->shouldReceive('foo')->withAnyArgs()->once()->ordered();
        $this->mock->foo();
        $this->mock->bar();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testEnsuresOrderingIsNotCrossMockByDefault()
    {
        $this->mock->shouldReceive('foo')->ordered();
        $mock2 = $this->container->mock('bar');
        $mock2->shouldReceive('bar')->ordered();
        $mock2->bar();
        $this->mock->foo();
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testEnsuresOrderingIsCrossMockWhenGloballyFlagSet()
    {
        $this->mock->shouldReceive('foo')->globally()->ordered();
        $mock2 = $this->container->mock('bar');
        $mock2->shouldReceive('bar')->globally()->ordered();
        $mock2->bar();
        $this->mock->foo();
    }

    public function testExpectationCastToStringFormatting()
    {
        $exp = $this->mock->shouldReceive('foo')->with(1, 'bar', new stdClass, array('Spam' => 'Ham', 'Bar' => 'Baz'));
        $this->assertEquals('[foo(1, "bar", object(stdClass), array(\'Spam\'=>\'Ham\',\'Bar\'=>\'Baz\',))]', (string) $exp);
    }

    public function testLongExpectationCastToStringFormatting()
    {
        $exp = $this->mock->shouldReceive('foo')->with(array('Spam' => 'Ham', 'Bar' => 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'Bar', 'Baz', 'End'));
        $this->assertEquals("[foo(array('Spam'=>'Ham','Bar'=>'Baz',0=>'Bar',1=>'Baz',2=>'Bar',3=>'Baz',4=>'Bar',5=>'Baz',6=>'Bar',7=>'Baz',8=>'Bar',9=>'Baz',10=>'Bar',11=>'Baz',12=>'Bar',13=>'Baz',14=>'Bar',15=>'Baz',16=>'Bar',17=>'Baz',18=>'Bar',19=>'Baz',20=>'Bar',21=>'Baz',22=>'Bar',23=>'Baz',24=>'Bar',25=>'Baz',26=>'Bar',27=>'Baz',28=>'Bar',29=>'Baz',30=>'Bar',31=>'Baz',32=>'Bar',33=>'Baz',34=>'Bar',35=>'Baz',36=>'Bar',37=>'Baz',38=>'Bar',39=>'Baz',40=>'Bar',41=>'Baz',42=>'Bar',43=>'Baz',44=>'Bar',45=>'Baz',46=>'Baz',47=>'Bar',48=>'Baz',49=>'Bar',50=>'Baz',51=>'Bar',52=>'Baz',53=>'Bar',54=>'Baz',55=>'Bar',56=>'Baz',57=>'Baz',58=>'Bar',59=>'Baz',60=>'Bar',61=>'Baz',62=>'Bar',63=>'Baz',64=>'Bar',65=>'Baz',66=>'Bar',67=>'Baz',68=>'Baz',69=>'Bar',70=>'Baz',71=>'Bar',72=>'Baz',73=>'Bar',74=>'Baz',75=>'Bar',76=>'Baz',77=>'Bar',78=>'Baz',79=>'Baz',80=>'Bar',81=>'Baz',82=>'Bar',83=>'Baz',84=>'Bar',85=>'Baz',86=>'Bar',87=>'Baz',88=>'Bar',89=>'Baz',90=>'Baz',91=>'Bar',92=>'Baz',93=>'Bar',94=>'Baz',95=>'Bar',96=>'Baz',97=>'Ba...))]", (string) $exp);
    }

    public function testMultipleExpectationCastToStringFormatting()
    {
        $exp = $this->mock->shouldReceive('foo', 'bar')->with(1);
        $this->assertEquals('[foo(1), bar(1)]', (string) $exp);
    }

    public function testGroupedOrderingWithLimitsAllowsMultipleReturnValues()
    {
        $this->mock->shouldReceive('foo')->with(2)->once()->andReturn('first');
        $this->mock->shouldReceive('foo')->with(2)->twice()->andReturn('second/third');
        $this->mock->shouldReceive('foo')->with(2)->andReturn('infinity');
        $this->assertEquals('first', $this->mock->foo(2));
        $this->assertEquals('second/third', $this->mock->foo(2));
        $this->assertEquals('second/third', $this->mock->foo(2));
        $this->assertEquals('infinity', $this->mock->foo(2));
        $this->assertEquals('infinity', $this->mock->foo(2));
        $this->assertEquals('infinity', $this->mock->foo(2));
        $this->container->mockery_verify();
    }

    public function testExpectationsCanBeMarkedAsDefaults()
    {
        $this->mock->shouldReceive('foo')->andReturn('bar')->byDefault();
        $this->assertEquals('bar', $this->mock->foo());
        $this->container->mockery_verify();
    }

    public function testDefaultExpectationsValidatedInCorrectOrder()
    {
        $this->mock->shouldReceive('foo')->with(1)->once()->andReturn('first')->byDefault();
        $this->mock->shouldReceive('foo')->with(2)->once()->andReturn('second')->byDefault();
        $this->assertEquals('first', $this->mock->foo(1));
        $this->assertEquals('second', $this->mock->foo(2));
        $this->container->mockery_verify();
    }

    public function testDefaultExpectationsAreReplacedByLaterConcreteExpectations()
    {
        $this->mock->shouldReceive('foo')->andReturn('bar')->once()->byDefault();
        $this->mock->shouldReceive('foo')->andReturn('bar')->twice();
        $this->mock->foo();
        $this->mock->foo();
        $this->container->mockery_verify();
    }

    public function testDefaultExpectationsCanBeChangedByLaterExpectations()
    {
        $this->mock->shouldReceive('foo')->with(1)->andReturn('bar')->once()->byDefault();
        $this->mock->shouldReceive('foo')->with(2)->andReturn('baz')->once();
        try {
            $this->mock->foo(1);
            $this->fail('Expected exception not thrown');
        } catch (\Mockery\Exception $e) {
        }
        $this->mock->foo(2);
        $this->container->mockery_verify();
    }

    /**
     * @expectedException \Mockery\Exception
     */
    public function testDefaultExpectationsCanBeOrdered()
    {
        $this->mock->shouldReceive('foo')->ordered()->byDefault();
        $this->mock->shouldReceive('bar')->ordered()->byDefault();
        $this->mock->bar();
        $this->mock->foo();
        $this->container->mockery_verif
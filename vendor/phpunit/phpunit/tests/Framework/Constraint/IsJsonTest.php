<?php
namespace Hamcrest\Core;

class SetTest extends \Hamcrest\AbstractMatcherTest
{

    public static $_classProperty;
    public $_instanceProperty;

    protected function setUp()
    {
        self::$_classProperty = null;
        unset($this->_instanceProperty);
    }

    protected function createMatcher()
    {
        return \Hamcrest\Core\Set::set('property_name');
    }

    public function testEvaluatesToTrueIfArrayPropertyIsSet()
    {
        assertThat(array('foo' => 'bar'), set('foo'));
    }

    public function testNegatedEvaluatesToFalseIfArrayPropertyIsSet()
    {
        assertThat(array('foo' => 'bar'), not(notSet('foo')));
    }

    public function testEvaluatesToTrueIfClassPropertyIsSet()
    {
        self::$_classProperty = 'bar';
        assertThat('Hamcrest\Core\SetTest', set('_classProperty'
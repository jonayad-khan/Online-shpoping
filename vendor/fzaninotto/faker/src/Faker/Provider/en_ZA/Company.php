 message);

.. _expectations-setting-public-properties:

Setting Public Properties
-------------------------

Used with an expectation so that when a matching method is called, we can cause
a mock object's public property to be set to a specified value, by using
``andSet()`` or ``set()``:

.. code-block:: php

    $mock = \Mockery::mock('MyClass');
    $mock->shouldReceive('name_of_method')
        ->andSet($property, $value);
    // or
    $mock->shouldReceive('name_of_method')
        ->set($property, $value);

In cases where we want to call the real method of the class that was mocked and
return its result, the ``passthru()`` method tells the expectation to bypass
a return queue:

.. code-block:: php

 
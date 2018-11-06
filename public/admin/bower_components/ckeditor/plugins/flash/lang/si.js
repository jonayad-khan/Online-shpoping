 here assigns `CallPrediction` to our method prophecy.
Predictions are a delayed behavior check for your prophecies. You see, during the entire lifetime
of your doubles, Prophecy records every single call you're making against it inside your
code. After that, Prophecy can use this collected information to check if it matches defined
predictions. You can assign predictions to method prophecies using the
`MethodProphecy::should(PredictionInterface $prediction)` method. As a matter of fact,
the `shouldBeCalled()` method we used earlier is just a shortcut to:

```php
$entityManager->flush()->should(new Prophecy\Prediction\CallPrediction());
```

It checks if your method of interest (that matches both the method name and the arguments wildcard)
was called 1 or more times. If the prediction failed then it throws an exception. When does this
check happen? Whenever you call `checkPredictions()` on the main Prophet object:

```php
$prophet->checkPredictions();
```

In PHPUnit, you would want to put this call into the `tearDown()` method. If no predictions
are defined, it would do nothing. So it won't harm to call it after every test.

There are plenty more predictions you can play with:

- `CallPrediction` or `shouldBeCalled()` - checks that the method has been called 1 or more times
- `NoCallsPrediction` or `shouldNotBeCalled()` - checks that the method has not been called
- `CallTimesPrediction` or `shouldBeCalledTimes($count)` - checks that the method has been called
  `$count` times
- `CallbackPrediction` or `should($callback)` - checks the method against your own custom callback

Of course, you can always create your own custom 
y is loaded before other filters are applied!**

```php
use DeepCopy\DeepCopy;
use DeepCopy\Filter\Doctrine\DoctrineProxyFilter;
use DeepCopy\Matcher\Doctrine\DoctrineProxyMatcher;

$deepCopy = new DeepCopy();
$deepCopy->addFilter(new DoctrineProxyFilter(), new DoctrineProxyMatcher());
$myCopy = $deepCopy->copy($myObject);

// $myCopy should now contain a clone of all entities, including those that were not yet fully loaded.
```

## Contributing

DeepCopy is distributed under the MIT license.

### Tests

Running the tests is simple:

```php
phpunit
```
                                                                                                                                                                                                                                                                            
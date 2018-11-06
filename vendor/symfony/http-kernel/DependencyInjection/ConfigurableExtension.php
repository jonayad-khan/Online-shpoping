ibute matched by `DeepCopy\Matcher`.
  - `DeepCopy\TypeFilter` applies a transformation to any element matched by `DeepCopy\TypeMatcher`.

#### `SetNullFilter`

Let's say for example that you are copying a database record (or a Doctrine entity), so you want the copy not to have any ID:

```php
use DeepCopy\DeepCopy;
use DeepCopy\Filter\SetNullFilter;
use DeepCopy\Matcher\PropertyNameMatcher;

$myObject = MyClass::load(123);
echo $myObject->id; // 123

$deepCopy = new DeepCopy();
$deepCopy->addFilter(new SetNullFilter(), new PropertyNameMatcher('id'));
$myCopy = $deepCopy->copy($myObject);

echo $myCopy->id; // null
```

#### `KeepFilter`

If you want a property to remain untouched (for example, an association to an object):

```php
use DeepCopy\DeepCopy;
use DeepCopy\Filter\KeepFilter;
use DeepCopy\Matcher\PropertyMatcher;

$deepCopy = new DeepCopy();
$deepCopy->addFilter(new KeepFilter(), new PropertyMatcher('MyClass', 'category'));
$myCopy = $deepCopy->copy($myObject);

// $myCopy->category has not been touched
```

#### `ReplaceFilter`

  1. If you want to replace the value of a property:

  ```php
  use DeepCopy\DeepCopy;
  use DeepCopy\Filter\ReplaceFilter;
  use DeepCopy\Matcher\PropertyMatcher;

  $deepCopy = new DeepCopy();
  $callback = function ($currentValue) {
      return $currentValue . ' (copy)'
  };
  $deepCopy->addFilter(new ReplaceFilter(
Version 3.1.2-dev
-----------------

Nothing yet.

Version 3.1.1 (2017-09-02)
--------------------------

### Fixed

* Fixed syntax error on comment after brace-style namespace declaration. (#412)
* Added support for TraitUse statements in trait builder. (#413)

Version 3.1.0 (2017-07-28)
--------------------------

### Added

* [PHP 7.2] Added support for trailing comma in group use statements.
* [PHP 7.2] Added support for `object` type. This means `object` types will now be represented as a
  builtin type (a simple `"object"` string), rather than a class `Name`.
  
### Fixed

* Floating-point numbers are now printed correctly if the LC_NUMERIC locale uses a comma as decimal
  separator.

### Changed

* `Name::$parts` is no longer 
Version 3.1.6-dev
-----------------

Nothing yet.

Version 3.1.5 (2018-02-28)
--------------------------

### Fixed

* Fixed duplicate comment assignment in switch statements. (#469)
* Improve compatibility with PHP-Scoper. (#477)

Version 3.1.4 (2018-01-25)
--------------------------

### Fixed

* Fixed pretty printing of `-(-$x)` and `+(+$x)`. (#459)

Version 3.1.3 (2017-12-26)
--------------------------

### Fixed

* Improve compatibility with php-scoper, by supporting prefixed namespaces in
  `NodeAbstract::getType()`.

Version 3.1.2 (2017-11-04)
--------------------------

### Fixed

* Comments on empty blocks are now preserved on a `Stmt\Nop` node. (#382)

### Added

* A
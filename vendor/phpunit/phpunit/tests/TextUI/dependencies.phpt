ersion 3.0.2 (2016-12-06)
--------------------------

### Fixed

* Fixed name resolution of nullable types. (#324)
* Fixed pretty-printing of nullable types.

Version 3.0.1 (2016-12-01)
--------------------------

### Fixed

* Fixed handling of nested `list()`s: If the nested list was unkeyed, it was directly included in
  the list items. If it was keyed, it was wrapped in `ArrayItem`. Now nested `List_` nodes are
  always wrapped in `ArrayItem`s. (#321)

Version 3.0.0 (2016-11-30)
--------------------------

### Added

* Added support for dumping node positions in the NodeDumper through the `dumpPositions` option.
* Added error recovery support for `$`, `new`, `Foo::`.

Version 3.0.0-beta2 (2016-10-29)
--------------------------------

This release primarily improves our support for error recovery.

### Added

* Added `Node::setDocComment()` method.
* Added `Error::getMessageWithColumnInfo()` method.
* Added support for recovery from lexer errors.
* Added support for recovering from "spe
ry.

### Added

* Added `Node::setDocComment()` method.
* Added `Error::getMessageWithColumnInfo()` method.
* Added support for recovery from lexer errors.
* Added support for recovering from "special" errors (i.e. non-syntax parse errors).
* Added precise location information for lexer errors.
* Added `ErrorHandler` interface, and `ErrorHandler\Throwing` and `ErrorHandler\Collecting` as
  specific implementations. These provide a general mechanism for handling error recovery.
* Added optional `ErrorHandler` argument to `Parser::parse()`, `Lexer::startLexing()` and
  `NameResolver::__construct()`.
* The `NameResolver` now adds a `namespacedName` attribute on name nodes that cannot be statically
  resolved (unqualified unaliased function or constant names in namespaces).
  
### Fixed

* Fixed attribute assignment for `GroupUse` prefix and variables in interpolated strings.

### Changed

* The constants on `NameTraverserInterface` have been moved into the `NameTraverser` class.
* Due to the error handling changes, the `Parser` interface and `Lexer` API have changed.
* The emulative lexer now directly postprocesses tokens, instead of using `~__EMU__~` sequences.
  This changes the protected API of the lexer.
* The `Name::slice()` method now returns `null` for empty slices, previously `new Name([])` was
  used. `Name::concat()` now also supports concatenation with `null`.

### Removed

* Removed `Name::append()` and `Name::prepend()`. These mutable methods have been superseded by
  the immutable `Name::concat()`.
* Removed `Error::getRawLine()` and `Error::setRawLine()`. These methods have been superseded by
  `Error::getStartLine()` and `Error::setStartLine()`.
* Removed support for node cloning in the `NodeTraverser`.
* Removed `$separator` argument from `Name::toString()`.
* Removed `throw_on_error` parser option and `Parser::getErrors()` method. Use the `ErrorHandler`
  mechanism instead.

Version 3.0.0-beta1 (2016-09-16)
--------------------------------

### Added

* [7.1] Function/method and parameter builders now support PHP 7.1 type hints (void, iterable and
  nullable types).
* Nodes and Comments now implement `JsonSerializable`. The node kind is stored in a `nodeType`
  property.
* The `InlineHTML` node now has an `hasLeadingNewline` attribute, that specifies whether the
  preceding closing tag contained a newline. The pretty printer honors this attribute.
* Partial parsing of `$obj->` (with missing property name) is now supported in error recovery mode.
* The error recovery mode is now exposed in the `php-parse` script through the `--with-recovery`
  or `-r` flags.

The following changes are also part of PHP-Parser 2.1.1:

* The PHP 7 parser will now generate a parse error for `$var =& new Obj` assignments.
* Comments on free-standing code blocks will now be retained as comments on the first statement in
  the code block.

Version 3.0.0-alpha1 (2016-07-25)
---------------------------------

### Added

* [7.1] Added support for `void` and `iterable` types. These will now be represented a
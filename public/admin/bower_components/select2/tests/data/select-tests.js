<?php

namespace Egulias\EmailValidator;

use Egulias\EmailValidator\Exception\InvalidEmail;
use Egulias\EmailValidator\Validation\EmailValidation;

class EmailValidator
{
    /**
     * @var EmailLexer
     */
    private $lexer;

    /**
     * @var array
     */
    protected $warnings;

    /**
     * @var InvalidEmail
     */
    protected $error;

    public function __construct()
    {
        $this->lexer = new EmailLexer();
    }

    /**
     * @param                 $email
     * @param EmailValidation $emailValidation
     * @return bool
     */
    public function isValid($email, EmailValidation $emailValidation)
    {
        $isValid = $emailValidation->isValid($email, $this->lexer);
        $this->warnings = $emailValidation->getWarnings();
        $this->error = $emailValidation->getError();

        return $isValid;
    }

    /**
     * @return boolean
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return InvalidEmail
     */
    public function getError()
    {
        return $this->error;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

namespace Illuminate\Routing;

use Illuminate\Support\Arr;

class RouteGroup
{
    /**
     * Merge route groups into a new array.
     *
     * @param  array  $new
     * @param  array  $old
     * @return array
     */
    public static function merge($new, $old)
    {
        if (isset($new['domain'])) {
            unset($old['domain']);
        }

        $new = array_merge(static::formatAs($new, $old), [
            'namespace' => static::formatNamespace($new, $old),
            'prefix' => static::formatPrefix($new, $old),
            'where' => static::formatWhere($new, $old),
        ]);

        return array_merge_recursive(Arr::except(
            $old, ['namespace', 'prefix', 'where', 'as']
        ), $new);
    }

    /**
     * Format the namespace for the new group attributes.
     *
     * @param  array  $new
     * @param  array  $old
     * @return string|null
     */
    protected static function formatNamespace($new, $old)
    {
        if (isset($new['namespace'])) {
            return isset($old['namespace'])
                    ? trim($old['namespace'], '\\').'\\'.trim($new['namespace'], '\\')
                    : trim($new['namespace'], '\\');
        }

        return $old['namespace'] ?? null;
    }

    /**
     * Format the prefix for the new group attributes.
     *
     * @param  array  $new
     * @param  array  $old
     * @return string|null
     */
    protected static function formatPrefix($new, $old)
    {
        $old = $old['prefix'] ?? null;

        return isset($new['prefix']) ? trim($old, '/').'/'.trim($new['prefix'], '/') : $old;
    }

    /**
     * Format the "wheres" for the new group attributes.
     *
     * @param  array  $new
     * @param  array  $old
     * @return array
     */
    protected static function formatWhere($new, $old)
    {
        return array_merge(
            $old['where'] ?? [],
            $new['where'] ?? []
        );
    }

    /**
     * Format the "as" clause of the new group attributes.
     *
     * @param  array  $new
     * @param  array  $old
     * @return array
     */
    protected static function formatAs($new, $old)
    {
        if (isset($old['as'])) {
            $new['as'] = $old['as'].($new['as'] ?? '');
        }

        return $new;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     Anonymous classes
-----
<?php

new class {
    public function test() {}
};
new class extends A implements B, C {};
new class() {
    public $foo;
};
new class($a, $b) extends A {
    use T;
};

class A {
    public function test() {
        return new class($this) extends A {
            const A = 'B';
        };
    }
}
-----
array(
    0: Expr_New(
        class: Stmt_Class(
            flags: 0
            name: null
            extends: null
            implements: array(
            )
            stmts: array(
                0: Stmt_ClassMethod(
                    flags: MODIFIER_PUBLIC (1)
                    byRef: false
                    name: test
                    params: array(
                    )
                    returnType: null
                    stmts: array(
                    )
                )
            )
        )
        args: array(
        )
    )
    1: Expr_New(
        class: Stmt_Class(
            flags: 0
            name: null
            extends: Name(
                parts: array(
                    0: A
                )
            )
            implements: array(
                0: Name(
                    parts: array(
                        0: B
                    )
                )
                1: Name(
                    parts: array(
                        0: C
                    )
                )
            )
            stmts: array(
            )
        )
        args: array(
        )
    )
    2: Expr_New(
        class: Stmt_Class(
            flags: 0
            name: null
            extends: null
            implements: array(
            )
            stmts: array(
                0: Stmt_Property(
                    flags: MODIFIER_PUBLIC (1)
                    props: array(
                        0: Stmt_PropertyProperty(
                            name: foo
                            default: null
                        )
                    )
                )
            )
        )
        args: array(
        )
    )
    3: Expr_New(
        class: Stmt_Class(
            flags: 0
            name: null
            extends: Name(
                parts: ar
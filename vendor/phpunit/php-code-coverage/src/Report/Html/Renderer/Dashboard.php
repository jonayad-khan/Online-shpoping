 // indirect modification
        $subNode =& $node->subNode;
        $subNode = 'newNewValue';
        $this->assertSame('newNewValue', $node->subNode);

        // removal
        unset($node->subNode);
        $this->assertObjectNotHasAttribute('subNode', $node);
    }

    /**
     * @dataProvider provideNodes
     */
    public function testIteration(array $attributes, Node $node) {
        // Iteration is simple object iteration over properties,
        // not over subnodes
        $i = 0;
        foreach ($node as $key => $value) {
            if ($i === 0) {
                $this->assertSame('subNode1', $key);
                $this->assertSame('value1', $value);
            } elseif ($i === 1) {
                $this->assertSame('subNode2', $key);
                $this->assertSame('value2', $value);
            } elseif ($i === 2) {
                $this->assertSame('notSubNode', $key);
                $this->assertSame('value3', $value);
            } else {
                throw new \Exception;
            }
            $i++;
        }
        $this->assertSame(3, $i);
    }

    public function testAttributes() {
        /** @var $node Node */
        $node = $this->getMockForAbstractClass(NodeAbstract::class);

        $this->assertEmpty($node->getAttributes());

        $node->setAttribute('key', 'value');
        $this->assertTrue($node->hasAttribute('key'));
        $this->assertSame('value', $node->getAttribute('key'));

        $this->assertFalse($node->hasAttribute('doesNotExist'));
        $this->assertNull($node->getAttribute('doesNotExist'));
        $this->assertSame('default', $node->getAttribute('doesNotExist', 'default'));

        $node->setAttribute('null', null);
        $this->assertTrue($node->hasAttribute('null'));
        $this->assertNull($node->getAttribute('null'));
        $this->assertNull($node->getAttribute('null', 'default'));

        $this->assertSame(
            [
                'key'  => 'value',
                'null' => null,
            ],
            $node->getAttributes()
        );

        $node->setAttributes(
            [
                'a' => 'b',
                'c' => null,
            ]
        );
        $this->assertSame(
            [
                'a' => 'b',
                'c' => null,
            ],
            $node->getAttributes()
        );
    }

    public function testJsonSerialization() {
        $code = <<<'PHP'
<?php
// comment
/** doc comment */
function functionName(&$a = 0, $b = 1.0) {
    echo 'Foo';
}
PHP;
        $expected = <<<'JSON'
[
    {
        "nodeType": "Stmt_Function",
        "byRef": false,
        "name": {
            "nodeType": "Identifier",
            "name": "functionName",
            "attributes": {
                "startLine": 4,
                "endLine": 4
            }
        },
        "params": [
            {
                "nodeType": "Param",
                "type": null,
                "byRef": true,
                "variadic": false,
                "var": {
                    "nodeType": "Expr_Variable",
                    "name": "a",
                    "attributes": {
                        "startLine": 4,
                        "endLine": 4
                    }
                },
                "default": {
                    "nodeType": "Scalar_LNumber",
                    "value": 0,
                    "attributes": {
                        "startLine": 4,
                        "endLine": 4,
                        "kind": 10
                    }
                },
                "attributes": {
                    "startLine": 4,
                    "endLine": 4
                }
            },
            {
                "nodeType": "Param",
                "type": null,
                "byRef": false,
                "variadic": false,
                "var": {
                    "nodeType": "Expr_Variable",
                    "name": "b",
                    "attributes": {
                        "startLine": 4,
                        "endLine": 4
                    }
                },
                "default": {
                    "nodeType": "Scalar_DNumber",
                    "value": 1,
                    "attributes": {
                        "startLine": 4,
                        "endLine": 4
                    }
                },
                "attributes": {
                    "startLine": 4,
                    "endLine": 4
                }
            }
        ],
        "returnType": null,
        "stmts": [
            {
                "nodeType": "Stmt_Echo",
                "exprs": [
                    {
                        "nodeType": "Scalar_String",
                        "value": "Foo",
                        "attributes": {
                            "startLine": 5,
                            "endLine": 5,
                            "kind": 1
                        }
                    }
                ],
                "attributes": {
                    "startLine": 5,
                    "endLine": 5
                }
            }
        ],
        "attributes": {
            "startLine": 4,
            "comments": [
                {
                    "nodeType": "Comment",
                    "text": "\/\/ comment\n",
                    "line": 2,
                    "filePos": 6,
                    "tokenPos": 1
                },
                {
                    "nodeType": "Comment_Doc",
                    "text": "\/** doc comment *\/",
                    "line": 3,
                    "filePos": 17,
                    "tokenPos": 2
                }
            ],
            "endLine": 6
        }
    }
]
JSON;

        $parser = new Parser\Php7(new Lexer());
        $stmts = $parser->parse(canonicalize($code));
        $json = json_encode($stmts, JSON_PRETTY_PRINT);
        $this->assertEquals(canonicalize($expected), canonicalize($json));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestFailure;

class IsNullTest extends ConstraintTestCase
{
    public function testConstraintIsNull(): void
    {
        $constraint = new IsNull();

        $this->assertFalse($constraint->evaluate(0, '', true));
        $this->assertTrue($constraint->evaluate(null, '', true));
        $this->assertEquals('is null', $constraint->toString());
        $this->assertCount(1, $constraint);

        try {
            $constraint->evaluate(0);
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
Failed asserting that 0 is null.

EOF
                ,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }

    public function testConstraintIsNull2(): void
    {
        $constraint = new IsNull();

        try {
            $constraint->evaluate(0, 'custom message');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
custom message
Failed asserting that 0 is null.

EOF
                ,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }
}
                                                                                                     
Class declaration
-----
<?php

class A extends B implements C, D {
    const A = 'B', C = 'D';

    public $a = 'b', $c = 'd';
    protected $e;
    private $f;

    public function a() {}
    public static function b($a) {}
    public final function c() : B {}
    protected function d() {}
    private function e() {}
}
-----
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: Name(
            parts: array(
                0: B
            )
        )
        implements: array(
            0: Name(
                parts: array(
                    0: C
                )
            )
            1: Name(
                parts: array(
                    0: D
                )
            )
        )
        stmts: array(
            0: Stmt_ClassConst(
                flags: 0
                consts: array(
                    0: Const(
                        name: A
                        value: Scalar_String(
                            value: B
                        )
                    )
                    1: Const(
                        name: C
                        value: Scalar_String(
                            value: D
                        )
                    )
                )
            )
            1: Stmt_Property(
                flags: MODIFIER_PUBLIC (1)
                props: array(
                    0: Stmt_PropertyProperty(
                        name: a
                        default: Scalar_String(
                            value: b
                        )
                    )
                    1: Stmt_PropertyProperty(
                        name: c
                        default: Scalar_String(
                            value: d
                        )
                    )
                )
            )
            2: Stmt_Property(
                flags: MODIFIER_PROTECTED (2)
                props: array(
                    0: Stmt_PropertyProperty(
                        name: e
                        default: null
                    )
                )
            )
            3: Stmt_Property(
                flags: MODIFIER_PRIVATE (4)
                props: array(
                    0: Stmt_PropertyProperty(
                        name: f
                        default: null
                    )
                )
            )
            4: Stmt_ClassMethod(
                flags: MODIFIER_PUBLIC (1)
                byRef: false
                name: a
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
            5: Stmt_ClassMethod(
                flags: MODIFIER_PUBLIC | MODIFIER_STATIC (9)
                byRef: false
                name: b
                params: array(
                    0: Param(
                        type: null
                        byRef: false
                        variadic: false
                        name: a
           
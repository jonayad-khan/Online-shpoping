Braced namespaces
-----
<?php

namespace Foo\Bar {
    foo;
}
namespace {
    bar;
}
-----
array(
    0: Stmt_Namespace(
        name: Name(
            parts: array(
                0: Foo
                1: Bar
            )
        )
        stmts: array(
            0: Expr_ConstFetch(
                name: Name(
                    parts: array(
                        0: foo
                    )
                )
            )
        )
    )
    1: Stmt_Namespace(
        name: null
        stmts: array(
            0: Expr_ConstFetch(
                name: Name(
                    parts: array(
                        0: bar
                    )
                )
            )
  
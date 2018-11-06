Group use declarations
-----
<?php
use A\{B};
use A\{B\C, D};
use \A\B\{C\D, E};
use function A\{b\c, d};
use const \A\{B\C, D};
use A\B\{C\D, function b\c, const D};
-----
array(
    0: Stmt_GroupUse(
        type: TYPE_UNKNOWN (0)
        prefix: Name(
            parts: array(
                0: A
            )
        )
        uses: array(
            0: Stmt_UseUse(
                type: TYPE_NORMAL (1)
                name: Name(
                    parts: array(
                        0: B
                    )
                )
                alias: B
            )
        )
    )
    1: Stmt_GroupUse(
        type: TYPE_UNKNOWN (0)
        prefix: Name(
            parts: array(
                0: A
            )
        )
        uses: array(
            0: Stmt_UseUse(
                type: TYPE_NORMAL (1)
                name: Name(
                    parts: array(
                        0: B
                        1: C
                    )
    
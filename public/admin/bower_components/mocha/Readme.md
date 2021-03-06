If/Elseif/Else
-----
<?php

if      ($a) {}
elseif  ($b) {}
elseif  ($c) {}
else         {}

if ($a) {} // without else

if      ($a):
elseif  ($b):
elseif  ($c):
else        :
endif;

if ($a): endif; // without else
-----
array(
    0: Stmt_If(
        cond: Expr_Variable(
            name: a
        )
        stmts: array(
        )
        elseifs: array(
            0: Stmt_ElseIf(
                cond: Expr_Variable(
                    name: b
                )
                stmts: array(
                )
            )
            1: Stmt_ElseIf(
                cond: Expr_Variable(
                    name: c
                )
                stmts: array(
                )
            )
        )
        else: Stmt_Else(
            stmts: array(
            )
        )
    )
    1: Stmt_If(
        cond: Expr_Variable(
            name: a
        )
        stmts: array(
        )
        elseifs: array(
        )
        else: null
    )
    2: Stmt_If(
        cond: Expr_Variable(
            name: a
        )
        stmts: array(
        )
        elseifs: array(
            0: Stmt_ElseIf(
                cond: Expr_Variable(
                    name: b
                )
                stmts: array(
                )
            )
            1: Stmt_ElseIf(
                cond: Expr_Variable(
                    name: c
                )
                stmts: array(
                )
            )
        )
        else: Stmt_Else(
            stmts: array(
            )
        )
        comments: array(
            0: // without else
        )
    )
    3: Stmt_If(
        cond: Expr_Variable(
            name: a
        )
        stmts: array(
        )
        elseifs: array(
        )
        else: null
    )
    4: Stmt_Nop(
        comments: array(
            0: // without else
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

namespace Faker\Provider\cs_CZ;

class Company extends \Faker\Provider\Company
{
    /**
     * @var array Czech company name formats.
     */
    protected static $formats = array(
        '{{lastName}} {{companySuffix}}',
        '{{lastName}} {{lastName}} {{companySuffix}}',
        '{{lastName}}-{{lastName}} {{companySuffix}}',
        '{{lastName}} a {{lastName}} {{companySuffix}}',
    );

    /**
     * @var array Czech catch phrase formats.
     */
    protected static $catchPhraseFormats = array(
        '{{catchPhraseVerb}} {{catchPhraseNoun}} {{catchPhraseAttribute}}',
        '{{catchPhraseVerb}} {{catchPhraseNoun}} a {{catchPhraseNoun}} {{catchPhraseAttribute}}',
        '{{catchPhraseVerb}} {{catchPhraseNoun}} {{catchPhraseAttribute}} a {{catchPhraseAttribute}}',
        'Ne{{catchPhraseVerb}} {{catchPhraseNoun}} {{catchPhraseAttribute}}',
    );

    /**
     * @var array Czech nouns (used by the catch phrase format).
     */
    protected static $noun = array(
        'bezpečnost', 'pohodlí', 'seo', 'rychlost', 'testování', 'údržbu', 'odebírání', 'výstavbu',
        'návrh', 'prodej', 'nákup', 'zprostředkování', 'odvoz', 'přepravu', 'pronájem'
    );

    /**
     * @var array Czech verbs (used by the catch phrase format).
     */
    protected static $verb = array(
        'zajišťujeme', 'nabízíme', 'děláme', 'provozujeme', 'realizujeme', 'předstihujeme', 'mobilizujeme',
    );

    /**
     * @var array End of sentences (used by the catch phrase format).
     */
    protected static $attribute = array(
        'pro vás', 'pro vaší službu', 'a jsme jednička na trhu', 'pro lepší svět', 'zdarma', 'se zárukou',
        's inovací', 'turbíny', 'mrakodrapů', 'lampiónků a svíček', 'bourací techniky', 'nákupních košíků',
        'vašeho webu', 'pro vaše zákazníky', 'za nízkou cenu', 'jako jediní na trhu', 'webu', 'internetu',
        'vaší rodiny', 'vašich známých', 'vašich stránek', 'čehokoliv na světě', 'za hubičku'
    );

    /**
     * @var array Company suffixes.
     */
    protected static $companySuffix = array('s.r.o.', 's.r.o.', 's.r.o.', 's.r.o.', 'a.s.', 'o.p.s.', 'o.s.');

    /**
     * Returns a random catch phrase noun.
     *
     * @return string
     */
    public function catchPhraseNoun()
    {
        return static::randomElement(static::$noun);
    }

    /**
     * Returns a random catch phrase attribute.
     *
     * @return string
     */
    public function c
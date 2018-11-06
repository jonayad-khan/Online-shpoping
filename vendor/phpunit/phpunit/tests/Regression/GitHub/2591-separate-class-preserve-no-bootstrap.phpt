<?php
namespace Hamcrest;

/*
 Copyright (c) 2009 hamcrest.org
 */

class MatcherAssert
{

    /**
     * Number of assertions performed.
     *
     * @var int
     */
    private static $_count = 0;

    /**
     * Make an assertion and throw {@link Hamcrest\AssertionError} if it fails.
     *
     * The first parameter may optionally be a string identifying the assertion
     * to be included in the failure message.
     *
     * If the third parameter is not a matcher it is passed to
     * {@link Hamcrest\Core\IsEqual#equalTo} to create one.
     *
     * Example:
     * <pre>
     * // With an identifier
     * assertThat("apple flavour", $apple->flavour(), equalTo("tasty"));
     * // Without an identifier
     * assertThat($apple->flavour(), equalTo("tasty"));
     * // Evaluating a boolean expression
     * assertThat("some error", $a > $b);
     * assertThat($a > $b);
     * </pre>
     */
    public sta
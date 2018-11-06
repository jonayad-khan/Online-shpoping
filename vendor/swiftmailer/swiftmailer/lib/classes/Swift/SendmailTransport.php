<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Attribute;

/**
 * This class provides structured storage of session attributes using
 * a name spacing character in the key.
 *
 * @author Drak <drak@zikula.org>
 */
class NamespacedAttributeBag extends AttributeBag
{
    private $namespaceCharacter;

    /**
     * @param string $storageKey         Session storage key
     * @param string $namespaceCharacter Namespace character to use in keys
     */
    public function __construct(string $storageKey = '_sf2_attributes', string $namespaceCharacter = '/')
    {
        $this->namespaceCharacter = $namespaceCharacter;
        parent::__construc
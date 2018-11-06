     )
            );
        }

        return self::load($contents, $isHtml, $filename, $xinclude, $strict);
    }

    public static function removeCharacterDataNodes(DOMNode $node): void
    {
        if ($node->hasChildNodes()) {
            for ($i = $node->childNodes->length - 1; $i >= 0; $i--) {
                if (($child = $node->childNodes->item($i)) instanceof DOMCharacterData) {
                    $node->removeChild($child);
                }
            }
        }
    }

    /**
     * Escapes a string for the use in XML documents
     *
     * Any Unicode character is allowed, excluding the surrogate blocks, FFFE,
     * and FFFF (not even as character reference).
     *
     * @see https://www.w3.org/TR/xml/#charsets
     *
     * @param string $string
     *
     * @return string
     */
    public static function prepareString(string $string): string
    {
        return \preg_replace(
            '/[\\x00-\\x08\\x0b\\x0c\\x0e
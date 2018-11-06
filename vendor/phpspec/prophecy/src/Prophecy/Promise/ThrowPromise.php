rn $this->setHorizontalBorderChars($horizontalBorderChar, $horizontalBorderChar);
    }

    /**
     * Gets horizontal border character.
     *
     * @return string
     *
     * @deprecated since Symfony 4.1, use {@link getBorderChars()} instead.
     */
    public function getHorizontalBorderChar()
    {
        @trigger_error(sprintf('Method %s() is deprecated since Symfony 4.1, use getBorderChars() instead.', __METHOD__), E_USER_DEPRECATED);

        return $this->horizontalOutsideBorderChar;
    }

    /**
     * Sets vertical border characters.
     *
     * <code>
     * ╔═══════════════╤══════════════════════════╤══════════════════╗
     * ║ ISBN          │ Title                    │ Author           ║
     * ╠═══════1═══════╪══════════════════════════╪══════════════════╣
     * ║ 99921-58-10-7 │ Divine Comedy            │ Dante Alighieri  ║
     * ║ 9971-5-0210-0 │ A Tale of Two Cities     │ Charles Dickens  ║
     * ╟───────2───────┼──────────────────────────┼──────────────────╢
     * ║ 960-425-059-0 │ The Lord of the Rings    │ J. R. R. Tolkien ║
     * ║ 80-902734-1-6 │ And Then There Were None │ Agatha Christie  ║
     * ╚═══════════════╧══════════════════════════╧══════════════════╝
     * </code>
     *
     * @param string      $outside Outside border char (see #1 of example)
     * @param string|null $inside  Inside border char (see #2 of example), equals $outside if null
     */
    public function setVerticalBorderChars(string $outside, string $inside = null): self
    {
        $this->verticalOutsideBorderChar = $outside;
        $this->verticalInsideBorderChar = $inside ?? $outside;

        return $this;
    }

    /**
     * Sets vertical border character.
     *
     * @param string $verticalBorderChar
     *
     * @return $this
     *
     * @deprecated since Symfony 4.1, use {@link setVerticalBorderChars()} instead.
     */
    public function setVerticalBorderChar($verticalBorderChar)
    {
        @trigger_error(sprintf('Method %s() is deprecated since Symfony 4.1, use setVerticalBorderChars() instead.', __METHOD__), E_USER_DEPRECATED);

        return $this->setVerticalBorderChars($verticalBorderChar, $verticalBorderChar);
    }

    /**
     * Gets vertical border character.
     *
     * @return string
     *
     * @deprecated since Symfony 4.1, use {@link getBorderChars()} instead.
     */
 

    /**
     * Require comparison values to be of the same type.
     *
     * @param  mixed  $first
     * @param  mixed  $second
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function requireSameType($first, $second)
    {
        if (gettype($first) != gettype($second)) {
            throw new InvalidArgumentException('The values under comparison must be of the same type');
        }
    }

    /**
     * Adds the existing rule to the numericRules array if the attribute's value is numeric.
     *
     * @param  string  $attribute
     * @param  string  $rule
     *
     * @return void
     */
    protected function shouldBeNumeric($attribute, $rule)
    {
        if (is_numeric($this->getValue($attribute))) {
            $this->numericRules[] = $rule;
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    

     */
    public function isArray()
    {
        return self::VALUE_IS_ARRAY === (self::VALUE_IS_ARRAY & $this->mode);
    }

    /**
     * Sets the default value.
     *
     * @param mixed $default The default value
     *
     * @throws LogicException When incorrect default value is given
     */
    public function setDefault($default = null)
    {
        if (self::VALUE_NONE === (self::VALUE_NONE & $this->mode) && null !== $default) {
            throw new LogicException('Cannot set a default value when using InputOption::VALUE_NONE mode.');
        }

        if ($this->isArray()) {
            if (null === $default) {
                $default = array();
            } elseif (!is_array($default)) {
                throw new LogicException('A default value for an array option must be an array.');
            }
        }

        $this->default = $this->acceptValue() ? $default : false;
    }

    /**
     * Returns the default value.
     *
     * @return mixed The default value
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Returns the description text.
     *
     * @return string The description text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Checks whether the given option equals this one.
     *
     * @return bool
     */
    public function equals(self $option)
    {
        return $option->getName() === $this->getName()
            && $option->getShortcut() === $this->getShortcut()
            && $option->getDefault() === $this->getDefault()
            && $option->isArray() === $this->isArray()
            && $option->isValueRequired() === $this->isValueRequired()
            && $option->isValueOptional() === $this->isValueOptional()
        ;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php
/**
 * Random_* Compatibility Library
 * for using the new PHP 7 random_* API in PHP 5 projects
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 - 2018 Paragon Initiative Enterprises
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

if (!is_callable('RandomCompat_strlen')) {
    if (
        defined('MB_OVERLOAD_STRING')
            &&
        ((int) ini_get('mbstring.func_overload')) & MB_OVERLOAD_STRING
    ) {
        /**
         * strlen() implementation that isn't brittle to mbstring.func_overload
         *
         * This version uses mb_strlen() in '8bit' mode to treat strings as raw
         * binary rather than UTF-8, ISO-8859-1, etc
         *
         * @param string $binary_string
         *
         * @throws TypeError
         *
         * @return int
         */
        function RandomCompat_strlen($binary_string)
        {
            if (!is_string($binary_string)) {
                throw new TypeError(
                    'RandomCompat_strlen() expects a string'
                );
            }

            return (int) mb_strlen($binary_string, '8bit');
        }

    } else {
        /**
         * strlen() implementation that isn't brittle to mbstring.func_overload
         *
         * This version just used the default strlen()
         *
         * @param string $binary_string
         *
         * @throws TypeError
         *
         * @return int
         */
        function RandomCompat_strlen($binary_string)
        {
            if (!is_string($binary_string)) {
                throw new TypeError(
                    'RandomCompat_strlen() expects a string'
                );
            }
            return (int) strlen($binary_string);
        }
    }
}

if (!is_callable('RandomCompat_substr')) {

    if (
        defined('MB_OVERLOAD_STRING')
            &&
        ((int) ini_get('mbstring.func_overload')) & MB_OVERLOAD_STRING
    ) {
        /**
         * substr() implementation that isn't brittle to mbstring.func_overload
         *
         * This version uses mb_substr() in '8bit' mode to treat strings as raw
         * binary rather than UTF-8, I
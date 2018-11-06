n($binary_string) - $start;
            } elseif (!is_int($length)) {
                throw new TypeError(
                    'RandomCompat_substr(): Third argument should be an integer, or omitted'
                );
            }

            // Consistency with PHP's behavior
            if ($start === RandomCompat_strlen($binary_string) && $length === 0) {
                return '';
            }
            if ($start > RandomCompat_strlen($binary_string)) {
                return '';
            }

            return (string) mb_substr($binary_string, $start, $length, '8bit');
        }

    } else {

        /**
         * substr() implementation that isn't brittle to mbstring.func_overload
         *
         * This version just uses the default substr()
         *
         * @param string $binary_string
         * @param int $start
         * @param int $length (optional)
         *
         * @throws TypeError
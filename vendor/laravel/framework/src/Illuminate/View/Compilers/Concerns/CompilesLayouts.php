      // this function should not change any of the settings, though it will need to
        // track any directives which change during calculation, so copy them at the start
        // and put them back at the end.
        $store_currentTextState = $this->currentTextState;

        if (!$this->numFonts) {
            $this->selectFont($this->defaultFont);
        }

        $text = str_replace(array("\r", "\n"), "", $text);

        // converts a number or a float to a string so it can get the width
        $text = "$text";

        // hmm, this is where it all starts to get tricky - use the font information to
        // calculate the width of each character, add them up and convert to user units
        $w = 0;
        $cf = $this->currentFont;
        $current_font = $this->fonts[$cf];
        $space_scale = 1000 / ($size > 0 ? $size : 1);
        $n_spaces = 0;

        if ($current_font['isUnicode']) {
            // for Unicode, use the code points array to calculate width rather
            // than just the string itself
            $unicode = $this->utf8toCodePointsArray($text);

            foreach ($unicode as $char) {
                // check if we have to replace character
                if (isset($current_font['differences'][$char])) {
                    $char = $current_font['differences'][$char];
                }

                if (isset($current_font['C'][$char])) {
                    $char_width = $current_font['C'][$char];

                    // add the character width
                    $w += $char_width;

                    // add additional padding for space
                    if (isset($current_font['codeToName'][$char]) && $current_font['codeToName'][$char] === 'space') {  // Space
                        $w += $word_spacing * $space_scale;
                        $n_spaces++;
                    }
                }
            }

            // add additionnal char spacing
            if ($char_spacing != 0) {
                $w += $char_spacing * $space_scale * (count($unicode) + $n_spaces);
            }

        } else {
            // If CPDF is in Unicode mode but the current font does not support Unicode we need to convert the character set to Windows-1252
            if ($this->isUnicode) {
                $text = mb_convert_encoding($text, 'Windows-1252', 'UTF-8');
            }

            $len = mb_strlen($text, 'Windows-1252');

            for ($i = 0; $i < $len; $i++) {
                $c = $text[$i];
                $char = iss
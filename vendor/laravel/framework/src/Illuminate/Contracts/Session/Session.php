ncatMatches($matches);
            d($lower);

            preg_match_all("/(\p{Ll}+)/u", $text, $matches, PREG_SET_ORDER);
            $other = $this->concatMatches($matches);
            d($other);

            //$text = preg_replace_callback("/\p{Ll}/u", array($this, "toUpper"), $text);
        }

        // if there are any open callbacks, then they should be called, to show the start of the line
        if ($this->nCallback > 0) {
            for ($i = $this->nCallback; $i > 0; $i--) {
                // call each function
                $info = array(
                    'x'         => $x,
                    'y'         => $y,
                    'angle'     => $angle,
                    'status'    => 'sol',
                    'p'         => $this->callback[$i]['p'],
                    'nCallback' => $this->callback[$i]['nCallback'],
                    'height'    => $this->callback[$i]['height'],
                    'descender' => $this->callback[$i]['descender']
                );

                $func = $this->callback[$i]['f'];
                $this->$func($info);
            }
        }

        if ($angle == 0) {
            $this->addContent(sprintf("\nBT %.3F %.3F Td", $x, $y));
        } else {
            $a = deg2rad((float)$angle);
            $this->addContent(
                sprintf("\nBT %.3F %.3F %.3F %.3F %.3F %.3F Tm", cos($a), -sin($a), sin($a), cos($a), $x, $y)
            );
        }

        if ($wordSpaceAdjust != 0 || $wordSpaceAdjust != $this->wordSpaceAdjust) {
            $this->wordSpaceAdjust = $wordSpaceAdjust;
            $this->addContent(sprintf(" %.3F Tw", $wordSpaceAdjust));
        }

        if ($charSpaceAdjust != 0 || $charSpaceAdjust != $this->charSpaceAdjust) {
            $this->charSpaceAdjust = $charSpaceAdjust;
            $this->addContent(sprintf(" %.3F Tc", $charSpaceAdjust));
        }

        $len = mb_strlen($text);
        $start = 0;

        if ($start < $len) {
            $part = $text; // OAR - Don't need this anymore, given that $start always equals zero.  substr($text, $start);
            $place_text = $this->filterText($part, false);
            // modify unicode text so that extra word spacing is manually implemented (bug #)
            $cf = $this->currentFont;
            if ($this->fonts[$cf]['isUnicode'] && $wordSpaceAdjust != 0) {
                $space_scale = 1000 / $size;
                //$place_text = str_replace(' ', ') ( ) '.($this->getTextWidth($size, chr(32), $wordSpaceAdjust)*-75).' (', $place_text);
                $place_text = str_replace(' ', ' ) ' . (-round($space_scale * $wordSpaceAdjust)) . ' (', $place_text);
            }
            $this->addContent(" /F$this->currentFontNum " . sprintf('%.1F Tf ', $size));
            $this->addContent(" [($place_text)] TJ");
        }

        $this->addContent(' ET');

        // if there are any open callbacks, then they should be called, to show the end of the line
        if ($this->nCallback > 0) {
            for ($i = $this->nCallback; $i > 0; $i--) {
                // call each function
                $tmp = $this->getTextPo
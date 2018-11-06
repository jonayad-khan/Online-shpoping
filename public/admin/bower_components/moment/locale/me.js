 = -1;
                    $lastChar = 0;
                    $widths = array();
                    $cid_widths = array();

                    foreach ($font['C'] as $num => $d) {
                        if (intval($num) > 0 || $num == '0') {
                            if (!$font['isUnicode']) {
                                // With Unicode, widths array isn't used
                                if ($lastChar > 0 && $num > $lastChar + 1) {
                                    for ($i = $lastChar + 1; $i < $num; $i++) {
                                        $widths[] = 0;
                                    }
                                }
                            }

                            $widths[] = $d;

                            if ($font['isUnicode']) {
                                $cid_widths[$num] = $d;
                            }

                            if ($firstChar == -1) {
                                $firstChar = $num;
                            }

                            $lastChar = $num;
                        }
                    }

                    // also need to adjust the widths for the differences array
                    if (isset($options['differences'])) {
                        foreach ($options['differences'] as $charNum => $charName) {
                            if ($charNum > $lastChar) {
                                if (!$font['isUnicode']) {
                                    // With Unicode, widths array isn't used
                                    for ($i = $lastChar + 1; $i <= $charNum; $i++) {
                                        $widths[] = 0;
                                    }
                                }

                                $lastChar = $charNum;
                            }

                            if (isset($font['C'][$charName])) {
                                $widths[$charNum - $firstChar] = $font['C'][$charName];
                                if ($font['isUnicode']) {
                                    $cid_widths[$charName] = $font['C'][$charName];
                                }
                            }
                        }
                    }

                    if ($font['isUnicode']) {
                        $font['CIDWidths'] = $cid_widths;
                    }

                    $this->addMessage('selectFont: FirstChar = ' . $firstChar);
                    $this->addMessage('selectFont: LastChar = ' . $lastChar);

                    $widthid = -1;

                    if (!$font['isUnicode']) {
                        // With Unicode, widths array isn't used

                        $this->numObj++;
                        $this->o_contents($this->numObj, 'new', 'raw');
                        $this->objects[$this->numObj]['c'] .= '[' . implode(' ', $widths) . ']';
                        $widthid = $this->numObj;
                    }

                    $missing_width = 500;
                    $stemV = 70;

                    if (isset($font['MissingWidth'])) {
                        $missing_width = $font['MissingWidth'];
                    }
                    if (isset($font['StdVW'])) {
                        $stemV = $font['StdVW'];
                    } else {
                        if (isset($font['Weight']) && preg_match('!(bold|black)!i', $font['Weight'])) {
                            $stemV = 120;
                        }
                    }

                    // load the pfb file, and put that into an object too.
                    // note that pdf supports only binary format type 1 font files, though there is a
                    // simple utility to convert them from pfa to pfb.
                    // FIXME: should we move font subset creation to 
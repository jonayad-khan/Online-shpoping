   case 4:
                                $testCSS = ' class="danger"';
                                break;

                            default:
                                $testCSS = '';
                        }

                        $popoverContent .= sprintf(
                            '<li%s>%s</li>',
                            $testCSS,
                            htmlspecialchars($test)
                        );
                    }

                    $popoverContent .= '</ul>';
                    $trClass         = ' class="' . $lineCss . ' popin"';
                }
            }

            if (!empty($popoverTitle)) {
                $popover = sprintf(
                    ' data-title="%s" data-content="%s" data-placement="bottom" data-html="true"',
                    $popoverTitle,
                    htmlspecialchars($popoverContent)
                );
            } else {
                $popover = '';
            }

            $lines .= sprintf(
                '     <tr%s%s><td><div align="right"><a name="%d"></a><a href="#%d">%d</a></div></td><td class="codeLine">%s</td></tr>' . "\n",
                $trClass,
                $popover,
                $i,
                $i,
                $i,
                $line
            );

            $i++;
        }

        return $lines;
    }

    /**
     * @param string $file
     *
     * @return array
     */
    protected function loadFile($file)
    {
        $buffer              = file_get_
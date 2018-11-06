   return;
        }

        if ($r2 == 0) {
            $r2 = $r1;
        }

        if ($nSeg < 2) {
            $nSeg = 2;
        }

        $astart = deg2rad((float)$astart);
        $afinish = deg2rad((float)$afinish);
        $totalAngle = $afinish - $astart;

        $dt = $totalAngle / $nSeg;
        $dtm = $dt / 3;

        if ($angle != 0) {
            $a = -1 * deg2rad((float)$angle);

            $this->addContent(
                sprintf("\n q %.3F %.3F %.3F %.3F %.3F %.3F cm", cos($a), -sin($a), sin($a), cos($a), $x0, $y0)
            );

            $x0 = 0;
            $y0 = 0;
        }

        $t1 = $astart;
        $a0 = $x0 + $r1 * cos($t1);
        $b0 = $y0 + $r2 * sin($t1);
        $c0 = -$r1 * sin($t1);
        $d0 = $r2 * cos($t1);

        if (!$incomplete) {
            $this->addContent(sprintf("\n%.3F %.3F m ", $a0, $b0));
        }

        for ($i = 1; $i <= $nSeg; $i++) {
            // draw this bit of the total curve
            $t1 = $i * $dt + $astart;
            $a1 = $x0 + $r1 * cos($t1);
            $b1 = $y0 + $r2 * sin($t1);
            $c1 = -$r1 * sin($t1);
            $d1 = $r2 * cos($t1);

            $this->addContent(
                sprintf(
                    "\n%.3F %.3F %.3F %.3F %.3F %.3F c",
                    ($a0 + $c0 * $dtm),
                    ($b0 + $d0 * $dtm),
                    ($a1 - $c1 * $dtm),
                    ($b1 - $d1 * $dtm),
                    $a1,
                    $b1
                )
            );

            $a0 = $a1;
            $b0 = $b1;
            $c0 = $c1;
            $d0 = $d1;
        }

        if (!$incomplete) {
            if ($fill) {
                $this->addContent(' f');
            }

            if ($stroke) {
                if ($close) {
                    $this->addContent(' s'); // small 's' signifies closing the path as well
                } else {
                    $this->addContent(' S');
                }
            }
        }

        if ($angle != 0) {
            $this->addContent(' Q');
        }
    }

    /**
     * this sets the line drawing style.
     * width, is the thickness of the line in user units
     * cap is the type of cap to put on the line, values can be 'butt','round','square'
     *    where the diffference between 'square' and 'butt' is that 'square' projects a flat end past the
     *    end of the line.
     * join can be 'miter', 'round', 'bevel'
     * dash is an array which sets the dash pattern, is a series of length values, which are the lengths of the
     *   on and off dashes.
     *   (2) represents 2 on, 2 off, 2 on , 2 off ...
     *   (2,1) is 2 on, 1 off, 2 on, 1 off.. etc
     * phase is a modifier on the dash pattern which is used to shift the point at which the pattern starts.
     */
    function setLineStyle($width = 1, $cap = '', $join = '', $dash = '', $phase = 0)
    {
        // this is quite inefficient in that it sets all the parameters whenever 1 is changed, but will fix another day
        $string = '';

        if ($width > 0) {
            $string .= sprintf("%.3F w", $width);
        }

        $ca = array('butt' => 0, 'round' => 1, 'square' => 2);

        if (isset($ca[$cap])) {
            $string .= " $ca[$cap] J";
        }

        $ja = array('miter' => 0, 'round' => 1, 'bevel' => 2);

        if (isset($ja[$join])) {
            $string .= " $ja[$join] j";
        }

        if (is_array($dash)) {
            $string .= ' [ ' . implode(' ', $dash) . " ] $phase d";
        }

        $this->currentLineStyle = $string;
        $this->addContent("\n$string");
    }

    function rect($x1, $y1, $width, $height)
    {
        $this->addContent(sprintf("\n%.3F %.3F %.3F %.3F re", $x1, $y1, $width, $height));
    }

    function stroke()
    {
        $this->addContent("\nS");
    }

    function fill()
    {
        $this->addContent("\nf".($this->fillRule === "evenodd" ? "*" : ""));
    }

    function fillStroke()
    {
        $this->addContent("\nb".($this->fillRule === "evenodd" ? "*" : ""));
    }

    /**
     * save the current graphic state
     */
    function save()
    {
        $this->addContent("\nq");
    }

    /**
     * restore the last graphic state
     */
    function restore()
    {
        $this->addContent("\nQ");
    }

    /**
     * scale
     *
     * @param float $s_x scaling factor for width as percent
     * @param float $s_y scaling factor for height as percent
     * @param float $x   Origin abscisse
     * @param float $y   Origin ordinate
     */
    function scale($s_x, $s_y, $x, $y)
    {
        $y = $this->currentPageSize["height"] - $y;

        $tm = array(
            $s_x,            0,
            0,               $s_y,
            $x * (1 - $s_x), $y * (1 - $s_y)
        );

        $this->transform($tm);
    }

    /**
     * translate
     *
     * @param float $t_x movement to the right
     * @param float $t_y movement to the bottom
     */
    function translate($t_x, $t_y)
    {
        $tm = array(
            1,    0,
            0,    1,
            $t_x, -$t_y
        );

        $this->transform($tm);
    }

    /**
     * rotate
     *
     * @param float $angle angle in degrees for counter-clockwise rotation
     * @param float $x     Origin abscisse
     * @param float $y     Origin ordinate
     */
    function rotate($angle, $x, $y)
    {
        $y = $this->currentPageSize["height"] - $y;

        $a = deg2rad($angle);
        $cos_a = cos($a);
        $sin_a = sin($a);

        $tm = array(
            $cos_a,                         -$sin_a,
            $sin_a,                         $cos_a,
            $x - $sin_a * $y - $cos_a * $x, $y - $cos_a * $y + $sin_a * $x,
        );

        $this->transform($tm);
    }

    /**
     * skew
     *
     * @param float $angle_x
     * @param float $angle_y
     * @param float $x Origin abscisse
     * @param float $y Origin ordinate
     */
    function skew($angle_x, $angle_y, $x, $y)
    {
        $y = $this->currentPageSize["height"] - $y;

        $tan_x = tan(deg2rad($angle_x));
        $tan_y = tan(deg2rad($angle_y));

        $tm = array(
            1,           -$tan_y,
            -$tan_x,     1,
            $tan_x * $y, $tan_y * $x,
        );

        $this->transform($tm);
    }

    /**
     * apply graphic transformations
     *
     * @param array $tm transformation matrix
     */
    function transform($tm)
    {
        $this->addContent(vsprintf("\n %.3F %.3F %.3F %.3F %.3F %.3F cm", $tm));
    }

    /**
     * add a new page to the document
     * this also makes the new page the current active object
     */
    function newPage($insert = 0, $id = 0, $pos = 'after')
    {
        // if there is a state saved, then go up the stack closing them
        // then on the new page, re-open them with the right setings

        if ($this->nStateStack) {
            for ($i = $this->nStateStack; $i >= 1; $i--) {
                $this->restoreState($i);
            }
        }

        $this->numObj++;

        if ($insert) {
            // the id from the ezPdf class is the id of the contents of the page, not the page object itself
            // query that object to find the parent
            $rid = $this->objects[$id]['onPage'];
            $opt = array('rid' => $rid, 'pos' => $pos);
            $this->o_page($this->numObj, 'new', $opt);
        } else {
            $this->o_page($this->numObj, 'new');
        }

        // if there is a stack saved, then put that onto the page
        if ($this->nStateStack) {
            for ($i = 1; $i <= $this->nStateStack; $i++) {
                $this->saveState($i);
            }
        }

        // and if there has been a stroke or fill color set, then transfer them
        if (isset($this->currentColor)) {
            $this->setColor($this->currentColor, true);
        }

        if (isset($this->currentStrokeColor)) {
            $this->setStrokeColor($this->currentStrokeColor, true);
        }

        // if there is a line style set, then put this in too
        if (mb_strlen($this->currentLineStyle, '8bit')) {
            $this->addContent("\n$this->currentLineStyle");
        }

        // the call to the o_page object set currentContents to the present page, so this can be returned as the page id
        return $this->currentContents;
    }

    /**
     * output the pdf code, streaming it to the browser
     * the relevant headers are set so that hopefully the browser will recognise it
     */
    function stream($options = '')
    {
        // setting the options allows the adjustment of the headers
        // values at the moment are:
        // 'Content-Disposition' => 'filename'  - sets the filename, though not too sure how well this will
        //        work as in my trial the browser seems to use the filename of the php file with .pdf on the end
        // 'Accept-Ranges' => 1 or 0 - if this is not set to 1, then this header is not included, off by default
        //    this header seems to have caused some problems despite tha fact that it is supposed to solve
        //    them, so I am leaving it off by default.
        // 'compress' = > 1 or 0 - apply content stream compression, this is on (1) by default
        // 'Attachment' => 1 or 0 - if 1, force the browser to open a download dialog
        if (!is_array($options)) {
            $options = array();
        }

        if (headers_sent()) {
            die("Unable to stream pdf: headers already sent");
        }

        $debug = empty($options['compression']);
        $tmp = ltrim($this->output($debug));

        header("Cache-Control: private");
        header("Content-type: application/pdf");

        //FIXME: I don't know that this is sufficient for determining content length (i.e. what about transport compression?)
        header("Content-Length: " . mb_strlen($tmp, '8bit'));
        $fileName = (isset($options['Content-Disposition']) ? $options['Content-Disposition'] : 'file.pdf');

        if (!isset($options["Attachment"])) {
            $options["Attachment"] = true;
        }

        $attachment = $options["Attachment"] ? "attachment" : "inline";

        // detect the character encoding of the incoming file
        $encoding = mb_detect_encoding($fileName);
        $fallbackfilename = mb_convert_encoding($fileName, "ISO-8859-1", $encoding);
        $encodedfallbackfilename = rawurlencode($fallbackfilename);
        $encodedfilename = rawurlencode($fileName);

        header(
            "Content-Disposition: $attachment; filename=" . $encodedfallbackfilename . "; filename*=UTF-8''$encodedfilename"
        );

        if (isset($options['Accept-Ranges']) && $options['Accept-Ranges'] == 1) {
            //FIXME: Is this the correct value ... spec says 1#range-unit
            header("Accept-Ranges: " . mb_strlen($tmp, '8bit'));
        }

        echo $tmp;
        flush();
    }

    /**
     * return the height in units of the current font in the given size
     */
    function getFontHeight($size)
    {
        if (!$this->numFonts) {
            $this->selectFont($this->defaultFont);
        }

        $font = $this->fonts[$this->currentFont];

        // for the current font, and the given size, what is the height of the font in user units
        if (isset($font['Ascender']) && isset($font['Descender'])) {
            $h = $font['Ascender'] - $font['Descender'];
        } else {
            $h = $font['FontBBox'][3] - $font['FontBBox'][1];
        }

        // have to adjust by a font offset for Windows fonts.  unfortunately it looks like
        // the bounding box calculations are wrong and I don't know why.
        if (isset($font['FontHeightOffset'])) {
            // For CourierNew from Windows this needs to be -646 to match the
            // Adobe native Courier font.
            //
            // For FreeMono from GNU this needs to be -337 to match the
            // Courier font.
            //
            // Both have been added manually to the .afm and .ufm files.
            $h += (int)$font['FontHeightOffset'];
        }

        return $size * $h / 1000;
    }

    function getFontXHeight($size)
    {
        if (!$this->numFonts) {
            $this->selectFont($this->defaultFont);
        }

        $font = $this->fonts[$this->currentFont];

        // for the current font, and the given size, what is the height of the font in user units
        if (isset($font['XHeight'])) {
            $xh = $font['Ascender'] - $font['Descender'];
        } else {
            $xh = $this->getFontHeight($size) / 2;
        }

        return $size * $xh / 1000;
    }

    /**
     * return the font descender, this will normally return a negative number
     * if you add this number to the baseline, you get the level of the bottom of the font
     * it is in the pdf user units
     */
    function getFontDescender($size)
    {
        // note that this will most likely return a negative value
        if (!$this->numFonts) {
            $this->selectFont($this->defaultFont);
        }

        //$h = $this->fonts[$this->currentFont]['FontBBox'][1];
        $h = $this->fonts[$this->currentFont]['Descender'];

        return $size * $h / 1000;
    }

    /**
     * filter the text, this is applied to all text just before being inserted into the pdf document
     * it escapes the various things that need to be escaped, and so on
     *
     * @access private
     */
    function filterText($text, $bom = true, $convert_encoding = true)
    {
        if (!$this->numFonts) {
            $this->selectFont($this->defaultFont);
        }

        if ($convert_encoding) {
            $cf = $this->currentFont;
            if (isset($this->fonts[$cf]) && $this->fonts[$cf]['isUnicode']) {
                //$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
                $text = $this->utf8toUtf16BE($text, $bom);
            } else {
                //$text = html_entity_decode($text, ENT_QUOTES);
                $text = mb_convert_encoding($text, self::$targetEncoding, 'UTF-8');
            }
        }

        // the chr(13) substitution fixes a bug seen in TCPDF (bug #1421290)
        return strtr($text, array(')' => '\\)', '(' => 
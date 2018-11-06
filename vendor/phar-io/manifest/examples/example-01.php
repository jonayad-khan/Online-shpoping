   ) {
            $props = $bp["top"];
            if ($props["color"] === "transparent" || $props["width"] <= 0) {
                return;
            }

            list($x, $y, $w, $h) = $border_box;
            $width = (float)$style->length_in_pt($props["width"]);
            $pattern = $this->_get_dash_pattern($props["style"], $width);
            $this->_canvas->rectangle($x + $width / 2, $y + $width / 2, (float)$w - $width, (float)$h - $width, $props["color"], $width, $pattern);
            return;
        }

        // Do it the long way
        $widths = array(
            (float)$style->length_in_pt($bp["top"]["width"]),
            (float)$style->length_in_pt($bp["right"]["width"]),
      
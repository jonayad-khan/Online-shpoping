get_column($num_cols - 1);
        } else {
            $draw_right = false;
        }

        // Draw the vertical borders
        foreach ($cells["rows"] as $i) {
            $bp = $cellmap->get_border_properties($i, $j);

            $x = $left_col["x"] - $bp["left"]["width"] / 2;

            $row = $cellmap->get_row($i);

            $y = $row["y"] - $bp["top"]["width"] / 2;
            $h = $row["height"] + ($bp["top"]["width"] + $bp["bottom"]["width"]) / 2;

            if ($bp["left"]["style"] !== "none" && $bp["left"]["width"] > 0) {
                $widths = array(
                    (float)$bp["top"]["width"],
                    (float)$bp["right"]["width"],
                    (float)$bp["bottom"]["width"],
                    (float)$bp["left"]["width"]
                );

                $method = "_border_" . $bp["left"]["style"];
                $this->$method($x, $y, $h, $bp["left"]["color"], $widths, "left", "square");
            }

            if ($draw_right) {
                $bp = $cellmap->get_border_properties($i, $num_cols - 1);
                if ($bp["right"]["style"] === "none" || $bp["right"]["width"] <= 0) {
                    continue;
                }

                $x = $right_col["x"] + $right_col["used-width"] + $bp["right"]["width"] / 2;

                $widths = array(
                    (float)$bp["top"]["width"],
                    (float)$bp["right"]["width"],
                    (float)$bp["bottom"]["width"],
                    (float)$bp["left"]["width"]
                );

                $method = "_border_" . $bp["right"]["style"];
                $this->$method($x, $y, $h, $bp["right"]["color"], $widths, "right", "square");
            }
        }

        $id = $frame->get_node()->getAttribute("id");
        if (strlen($id) > 0)  {
            $this->_canvas->add_named_dest($id);
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
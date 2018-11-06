<?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Dompdf\Renderer;

use Dompdf\Frame;
use Dompdf\FrameDecorator\AbstractFrameDecorator;
use Dompdf\Helpers;

/**
 * Renders block frames
 *
 * @package dompdf
 */
class Block extends AbstractRenderer
{

    /**
     * @param Frame $frame
     */
    function render(Frame $frame)
    {
        $style = $frame->get_style();
        $node = $frame->get_node();

        list($x, $y, $w, $h) = $frame->get_border_box();

        $this->_set_opacity($frame->get_opacity($style->opacity));

        if ($node->nodeName === "body") {
            $h = $frame->get_containing_block("h") - (float)$style->length_in_pt(array(
                        $style->margin_top,
                        $style->border_top_width,
                        $style->border_bottom_width,
                        $style->margin_bottom),
                    (float)$style->length_in_pt($style->width));
        }

        // Handle anchors & links
        if ($node->nodeName === "a" && $href = $node->getAttribute("href")) {
            $href = Helpers::build_url($this->_dompdf->getProtocol(), $this->_dompdf->getBaseHost(), $
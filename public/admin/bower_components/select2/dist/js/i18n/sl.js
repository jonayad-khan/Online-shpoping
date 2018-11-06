<?php
/**
 * @package php-font-lib
 * @link    https://github.com/PhenX/php-font-lib
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace FontLib\Table\Type;
use FontLib\Table\Table;

/**
 * `kern` font table.
 *
 * @package php-font-lib
 */
class kern extends Table {
  protected function _parse() {
    $font = $this->getFont();

    $data = $font->unpack(array(
      "version"         => self::uint16,
      "nTables"         => self::uint16,

      // only the first subtable will be parsed
      "subtableVersion" => self::uint16,
      "length"          => self::uint16,
      "coverage"        => self::uint16,
    ));

    $data["format"] = ($data["coverage"] >> 8);

    $subtable = array();

    switch ($data["format"]) {
      case 0:
        $subtable = $font->unpack(array
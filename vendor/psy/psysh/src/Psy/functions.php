INDX( 	                 (   (	  �      2 t �x �              3=    � r     2=    �A��b��ި����Y��b��A��b�P       J                i n t e r a c t i v e _ o u t p u t _ 1 . t x t       4=    p Z     2=    �e��b��ި����i|��b��e��b��       {                o u t p u t _ 0 . t x t       5=    p Z     2=    ���b��ި����.���b�
���b��       �                o u t p u t _ 1 . t x t       6=    p \     2=    ���b��ި��������b� ���b�`      _               o u 2 p u t _ 1 0 . t x t     7=    p \     2=    ����b��ި�������b�����b��       �                o u t p u t _ 1 1 . t x t     8=    p \     2=    ���b��ި����"&��b����b��      �               o u t p u t _ 1 2 . t x t     9=    p \     2=    I2��b��ި����SI��b�F2��b�       �               o u t p u t _ 1 3 . t x t     :=    p \     2=    ]U��b��ި�����k��b�ZU��b��      �               o u t p u t _ 1 4 . t x t     ;=    p \     2=    iw��b��ި���2 ����b�`w��b�`      _               o u t p u t _ 1 5 . t x t     <=    p \     2=    M���b��ި����J���b�L���b�       8               o u t p u t _ 1 6 . t x t     ==    p \     2=    {���b��ި����k���b�t���b�X       W                o u t p u t _ 1 7 . t x t     >=    p Z     2=    ����b��ި��������b�����b�       �               o u t p u t _ 2 . t x t       ?=    p Z     2=    	��b��ި����3!��b�	��b�8       5                o u t p u t _ 3 . t 2 t       @=    p Z     2=    f.��b��ި����F��b�b.��b�H      D               o u t p u t _ 4 . t x t       A=    � x     2=    6R��b��ި����lj��b�4R��b�H      D               o u t p u t _ 4 _ w i t h _ i t e r a t o r s . t x t B=    p Z     2=    v��b��ި��������b�~v��b�       �               o u t p u t _ 5 . t x t       C=    p Z     2=    ����b��ި����z���b�����b��       �                o u t p u t _ 6 . t x t       D=    p Z     2=    m���b2 �ި����:���b�h���b�P       N                o u t p u t _ 7 . t x t       E=    p Z     2=    5���b��ި�������b�,���b��      �               o u t p u t _ 8 . t x t       F=    p Z     2=    Y��b��ި�������b�T��b�p      m               o u t p u t _ 9 . t x t                                                                                                                                                                                                                   2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2 <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Analyzes US-ASCII characters.
 *
 * @author Chris Corbyn
 */
class Swift_CharacterReader_UsAsciiReader implements Swift_CharacterReader
{
    /**
     * Returns the complete character map.
     *
     * @param string $string
     * @param int    $startOffset
     * @param array  $currentMap
     * @param string $ignoredChars
     *
     * @return int
     */
    public function getCharPositions($string, $startOffset, &$currentMap, &$ignoredChars)
    {
        $strlen = strlen($string);
        $ignoredChars = '';
        for ($i = 0; $i < $strlen; ++$i) {
            if ($string[$i] > "\x07F") {
                // Invalid char
                $currentMap[$i + $startOffset] = $string[$i];
            }
        }

        return $strlen;
    }

    /**
     * Returns mapType.
     *
     * @return int mapType
     */
    public function getMapType()
    {
        return self::MAP_TYPE_INVALID;
    }

    /**
     * Returns an integer which specifies how many more bytes to read.
     *
     * A positive integer indicates the number of more bytes to fetch before invoking
     * this method again.
     * A value of zero means this is already a valid character.
     * A value of -1 means this cannot possibly be a valid character.
     *
     * @param string $bytes
     * @param int    $size
     *
     * @return int
     */
    public function validateByteSequence($bytes, $size)
    {
        $byte = reset($bytes);
        if (1 == count($bytes) && $byte >= 0x00 && $byte <= 0x7F) {
            return 0;
        }

        return -1;
    }

    /**
     * Returns the number of bytes which should be read to start each character.
     *
     * @return int
     */
    public function getInitialByteSize()
    {
        return 1;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        INDX( 	                 (   `  �       �                    �@    � z     �@    �O��b� K���k��b��O��b�       �               C r a m M d 5 A u t h e n t i c a t o r T e s t . p h p       �@    � v     �@    �y��b� K��[���b��y��b�       �               L o g i n A u t h e n t i c a t o r T e s t . p h p    A    � t     �@    a���b� K���Ų�b�\���b� 0      �%               N T L M A u t h e n t i c a t o r T e s t . p h p     A    � v     �@    �ز�b  K��\���b��ز�b�       A               P l a i n A u t h e n t i c a t o r T e s t . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
ut($type); }
    function mb_convert_variables($toEncoding, $fromEncoding, &$a = null, &$b = null, &$c = null, &$d = null, &$e = null, &$f = null) { return p\Mbstring::mb_convert_variables($toEncoding, $fromEncoding, $a, $b, $c, $d, $e, $f); }
}
if (!function_exists('mb_chr')) {
    function mb_ord($s, $enc = null) { return p\Mbstring::mb_ord($s, $enc); }
    function mb_chr($code, $enc = null) { return p\Mbstring::mb_chr($code, $enc); }
    function mb_scrub($s, $enc = null) { $enc = null === $enc ? mb_internal_encoding() : $enc; return mb_convert_encoding($s, $enc, $enc); }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
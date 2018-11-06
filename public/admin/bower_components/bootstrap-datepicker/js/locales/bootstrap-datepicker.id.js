>  %s', $type, $desc);
        $chunks[] = '';
    }

    array_pop($chunks); // get rid of the trailing newline

    return implode("\n", $chunks);
}

function thunk_tags($text)
{
    $tagMap = array(
        'parameter>' => 'strong>',
        'function>'  => 'strong>',
        'literal>'   => 'return>',
        'type>'      => 'info>',
        'constant>'  => 'info>',
    );

    $andBack = array(
        '&amp;'       => '&',
        '&amp;true;'  => '<return>true</return>',
        '&amp;false;' => '<return>false</return>',
        '&amp;null;'  => '<return>null</return>',
    );

    return strtr(strip_tags(strtr($te
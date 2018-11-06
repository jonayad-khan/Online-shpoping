y\Component\VarDumper\Caster\DOMCaster', 'castAttr'),
        'DOMElement' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castElement'),
        'DOMText' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castText'),
        'DOMTypeinfo' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castTypeinfo'),
        'DOMDomError' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castDomError'),
        'DOMLocator' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castLocator'),
        'DOMDocumentType' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castDocumentType'),
        'DOMNotation' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castNotation'),
        'DOMEntity' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castEntity'),
        'DOMProcessingInstruction' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castProcessingInstruction'),
        'DOMXPath' => array('Symfony\Component\VarDumper\Caster\DOMCaster', 'castXPath'),

        'XmlReader' => array('Symfony\Component\VarDumper\Caster\XmlReaderCaster', 'castXmlReader'),

        'ErrorException' => array('Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castErrorException'),
        'Exception' => array('Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castException'),
        'Error' => array('Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castError'),
    
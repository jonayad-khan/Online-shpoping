<?php
namespace JakubOnderka\PhpConsoleHighlighter;

class HighlighterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Highlighter */
    private $uut;

    protected function getConsoleColorMock()
    {
        $mock = $this->getMock('\JakubOnderka\PhpConsoleColor\ConsoleColor');

        $mock->expects($this->any())
            ->method('apply')
            ->will($this->returnCallback(function ($style, $text) {
                return "<$style>$text</$style>";
            }));

        $mock->expects($this->any())
            ->method('hasTheme')
            ->will($this->returnValue(true));

        return $mock;
    }

    protected function setUp()
    {
        $this->uut = new Highlighter($this->getConsoleColorMock());
    }

    protected function compare($original, $expected)
    {
        $output = $this->uut->getWholeFile($original);
        $this->assertEquals($expected, $output);
    }

    public function testVariable()
    {
        $this->compare(
            <<<EOL
<?php
echo \$a;
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>echo </token_keyword><token_default>\$a</token_default><token_keyword>;</token_keyword>
EOL
        );
    }

    public function testInteger()
    {
        $this->compare(
            <<<EOL
<?php
echo 43;
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>echo </token_keyword><token_default>43</token_default><token_keyword>;</token_keyword>
EOL
        );
    }

    public function testFloat()
    {
        $this->compare(
            <<<EOL
<?php
echo 43.3;
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>echo </token_keyword><token_default>43.3</token_default><token_keyword>;</token_keyword>
EOL
        );
    }

    public function testHex()
    {
        $this->compare(
            <<<EOL
<?php
echo 0x43;
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>echo </token_keyword><token_default>0x43</token_default><token_keyword>;</token_keyword>
EOL
        );
    }

    public function testBasicFunction()
    {
        $this->compare(
            <<<EOL
<?php
function plus(\$a, \$b) {
    return \$a + \$b;
}
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>function </token_keyword><token_default>plus</token_default><token_keyword>(</token_keyword><token_default>\$a</token_default><token_keyword>, </token_keyword><token_default>\$b</token_default><token_keyword>) {</token_keyword>
<token_keyword>    return </token_keyword><token_default>\$a </token_default><token_keyword>+ </token_keyword><token_default>\$b</token_default><token_keyword>;</token_keyword>
<token_keyword>}</token_keyword>
EOL
        );
    }

    public function testStringNormal()
    {
        $this->compare(
            <<<EOL
<?php
echo 'Ahoj světe';
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>echo </token_keyword><token_string>'Ahoj světe'</token_string><token_keyword>;</token_keyword>
EOL
        );
    }

    public function testStringDouble()
    {
        $this->compare(
            <<<EOL
<?php
echo "Ahoj světe";
EOL
            ,
            <<<EOL
<token_default><?php</token_default>
<token_keyword>echo </token_keyword><token_string>"Ahoj světe"</token_string><token_keyword>;</token_keyword>
EOL
        );
    }

 
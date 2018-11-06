<?php declare(strict_types=1);

namespace PhpParser;

use PHPUnit\Framework\TestCase;

class DummyNode extends NodeAbstract
{
    public $subNode1;
    public $subNode2;

    public function __construct($subNode1, $subNode2, $attributes) {
        parent::__construct($attributes);
        $this->subNode1 = $subNode1;
        $this->subNode2 = $subNode2;
    }

    public function getSubNodeNames() : array {
        return ['subNode1', 'subNode2'];
    }

    // This method is only overwritten because the node is located in an unusual namespace
    public function getType() : string {
        return 'Dummy';
    }
}

class NodeAbstractTest extends TestCase
{
    public function provideNodes() {
        $attributes = [
            'startLine' => 10,
            'endLine' => 11,
            'startTokenPos' => 12,
            'endTokenPos' => 13,
            'startFilePos' => 14,
            'endFilePos' => 15,
            'comments'  => [
                new Comment('// Comment' . "\n"),
                new Comment\Doc('/** doc comment */'),
            ],
        ];

        $node = new DummyNode('value1', 'value2', $attributes);
        $node->notSubNode = 'value3';

        return [
            [$attributes, $node],
        ];
    }

    /**
     * @dataProvider provideNodes
     */
    public function testConstruct(array $attributes, Node $node) {
        $this->assertSame('Dummy', $node->getType());
        $this->assertSame(['subNode1', 'subNode2'], $node->getSubNodeNames());
        $this->assertSame(10, $node->getLine());
        $this->assertSame(10, $node->getStartLine());
        $this->assertSame(11, $node->getEndLine());
        $this->assertSame(12, $node->getStartTokenPos());
        $this->assertSame(13, $node->getEndTokenPos());
        $this->assertSame(14, $node->getStartFilePos());
        $this->assertSame(15, $node->getEndFilePos());
        $this->assertSame('/** doc comment */', $node->getDocComment()->getText());
        $this->assertSame('value1', $node->subNode1);
        $this->assertSame('value2', $node->subNode2);
        $this->assertObjectHasAttribute('subNode1', $node);
        $this->assertObjectHasAttribute('subNode2', $node);
        $this->assertObjectNotHasAttribute('subNode3', $node);
        $this->assertSame($attributes, $node->getAttributes());
        $this->assertSame($attributes['comments'], $node->getComments());

        return $node;
    }

    /**
     * @dataProvider provideNodes
     */
    public function testGetDocComment(array $attributes, Node $node) {
        $this->assertSame('/** doc comment */', $node->getDocComment()->getText());
        $comments = $node->getComments();

        array_pop($comments); // remove doc comment
        $node->setAttribute('comments', $comments);
        $this->assertNull($node->getDocComment());

        array_pop($comments); // remove comment
        $node->setAttribute('comments', $comments);
        $this->assertNull($node->getDocComment());
    }

    
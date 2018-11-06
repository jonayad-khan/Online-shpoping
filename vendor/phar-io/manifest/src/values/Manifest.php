     $visitor->expects($this->at(3))->method('afterTraverse');
        $traverser = new NodeTraverser;
        $traverser->addVisitor($visitor);
        $this->assertEquals($stmts, $traverser->traverse($stmts));

        // From leaveNode with Node parent
        $visitor = $this->getMockBuilder(NodeVisitor::class)->getMock();
        $visitor->expects($this->at(3))->method('leaveNode')->with($varNode1)
            ->will($this->returnValue(NodeTraverser::STOP_TRAVERSAL));
        $visitor->expects($this->at(4))->method('afterTraverse');
        $traverser = new NodeTraverser;
        $traverser->addVisitor($visitor);
        $this->assertEquals($stmts, $traverser->traverse($stmts));

        // From leaveNode with array parent
        $visitor = $this->getMockBuilder(NodeVisitor::class)->getMock();
        $visitor->expects($this->at(6))->method('leaveNode')->with($mulNode)
            ->will($this->returnValue(NodeTraverser::STOP_TRAVERSAL));
        $visitor->expects($this->at(7))->method('afterTraverse');
        $traverser = new NodeTraverser;
        $traverser->addVisitor($visitor);
        $this->assertEquals($stmts, $traverser->traverse($stmts));

        // Check that pending array modifications are still carried out
        $visitor = $this->getMockBuilder(NodeVisitor::class)->getMock();
        $visitor->expects($this->at(6))->method('leaveNode')->with($mulNode)
            ->will($this->returnValue(NodeTraverser::REMOVE_NODE));
        $visitor->expects($this->at(7))->method('enterNode')->with($printNode)
            ->will($this->returnValue(NodeTraverser::STOP_TRAVERSAL));
        $visitor->expects($this->at(8))->method('afterTraverse');
        $traverser = new NodeTraverser;
        $traverser->addVisitor($visitor);
        $this->assertEquals([$printNode], $traverser->traverse($stmts));

    }

    public function testRemovingVisitor() {
        $visitor1 = $this->getMockBuilder(NodeVisitor::class)->getMock();
        $visitor2 = $this->getMockBuilder(NodeVisitor::class)->getMock();
        $visitor3 = $this->getMockBuilder(NodeVisitor::class)->getMock();

        $traverser = new NodeTraverser;
        $traverser->addVisitor($visitor1);
        $traverser->addVisitor($visitor2);
        $traverser->addVisitor($visitor3);

        $preExpected = [$visitor1, $visitor2, $visitor3];
        $this->assertAttributeSame($preExpected, 'visitors', $traverser, 'The appropriate visitors have not been added');

        $traverser->removeVisitor($visitor2);

        $postExpected = [0 => $visitor1, 2 => $visitor3];
        $this->assertAttributeSame($postExpected, 'visitors', $traverser, 'The appropriate visitors are not present after removal');
    }

    public function testNoCloneNodes() {
        $stmts = [new Node\Stmt\Echo_([new String_('Foo'), new String_('Bar')])];

        $traverser = new NodeTraverser;

        $this->assertSame($stmts, $traverser->traverse($stmts));
    }

    /**
     * @dataProvider provideTestInvalidReturn
     */
   
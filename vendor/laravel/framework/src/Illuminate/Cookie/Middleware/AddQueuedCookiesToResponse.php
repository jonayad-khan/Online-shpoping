Controller',
            $expand(array('**Bundle\\Controller\\'), array('\\FooBundle\\Controller\\DefaultController'))[0]
        );

        $this->assertSame(
            'Acme\\FooBundle\\Controller\\Bar\\DefaultController',
            $expand(array('**Bundle\\Controller\\'), array('\\Acme\\FooBundle\\Controller\\Bar\\DefaultController'))[0]
        );

        $this->assertSame(
            'Bundle\\Controller\\Bar\\DefaultController',
            $expand(array('**Bundle\\Controller\\'), array('\\Bundle\\Controller\\Bar\\DefaultController'))[0]
        );

        $this->assertSame(
            'Acme\\Bundle\\Controller\\Bar\\DefaultController',
            $expand(array('**Bundle\\Controller\\'), array('\\Acme\\Bundle\\Controller\\Bar\\DefaultController'))[0]
        );

        $this->assertSame('Foo\\Bar', $expand(array('Foo\\Bar'), array())[0]);
        $this->assertSame('Foo\\Acme\\Bar', $expand(array('Foo\\**'), array('\\Foo\\Acme\\Bar'))[0]);
 
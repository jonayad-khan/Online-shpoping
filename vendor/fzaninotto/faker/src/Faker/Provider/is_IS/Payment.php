ssage, $context) use (&$line) {
                $this->assertEquals('Notice: Undefined variable: undefVar', $message);
                $this->assertArrayHasKey('exception', $context);
                $exception = $context['exception'];
                $this->assertInstanceOf(SilencedErrorContext::class, $exception);
                $this->assertSame(E_NOTICE, $exception->getSeverity());
                $this->assertSame(__FILE__, $exception->getFile());
                $this->assertSame($line, $exception->getLine());
                $this->assertNotEmpty($exception->getTrace());
                $this->assertSame(1, $exception->count);
            };

         
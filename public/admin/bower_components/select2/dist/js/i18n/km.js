a('bar', \stdClass::class, false, false, null, true),
            new ArgumentMetadata('baz', 'string', false, true, 'value', true),
            new ArgumentMetadata('mandatory', null, false, false, null, true),
        ), $arguments);
    }

    private function signature1(ArgumentMetadataFactoryTest $foo, array $bar, callable $baz)
    {
    }

    private function signature2(ArgumentMetadataFactoryTest $foo = null, FakeClassThatDoesNotExist $bar = null, ImportedAndFake $baz = null)
    {
    }

    private function signature3(FakeClassThatDoesNotExist $bar, ImportedAndFake $baz)
    {
    }

    private function signature4($foo = 'default', $bar = 500, $baz = array())
    {
    }

    private function signature5(array $foo = null, $bar)
    {
    }
}
                                                                                                                                                                                                                                                                                                             
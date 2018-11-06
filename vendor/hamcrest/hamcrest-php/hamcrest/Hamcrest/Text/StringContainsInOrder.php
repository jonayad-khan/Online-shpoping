ethod()
    {
        $container = new ContainerBuilder();
        $container->register('argument_resolver.service')->addArgument(array());

        $container->register('foo', RegisterTestController::class)
            ->addTag('controller.service_arguments', array('action' => 'barAction', 'argument' => 'bar', 'id' => 'bar_service'))
        ;

        $pass = new RegisterControllerArgumentLocatorsPass();
        $pass->process($container);
    }

    /**
     * @expectedException \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     * @expectedExceptionMessage Invalid "controller.service_arguments" tag for service "foo": method "fooAction()" has no "baz" argument on class "Symfony\Component\HttpKernel\Tests\DependencyInjection\RegisterTestController".
     */
    public function testInvalidArgument()
    {
        $container = new ContainerBuilder();
        $container->register('argument_resolver.service')->addArgument(array());

        $container->register('foo', RegisterTestController::class)
            ->addTag('controller.service_arguments', array('action' => 'fooAction', 'argument' => 'baz', 'id' => 'bar'))
        ;

        $pass = new RegisterControllerArgumentLocatorsPass();
        $pass->process($container);
    }

    public function testAllActions()
    {
        $container = new ContainerBuilder();
        $resolver = $container->register('argument_resolver.service')->addArgument(array());

        $container->register('foo', RegisterTestController::class)
            ->addTag('controller.service
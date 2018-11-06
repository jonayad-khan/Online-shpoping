er = $container->register('argument_resolver.service')->addArgument(array());

        $container->register('foo', ArgumentWithoutTypeController::class)
            ->setPublic(false)
            ->addTag('controller.service_arguments');

        $pass = new RegisterControllerArgumentLocatorsPass();
        $pass->process($container);

        $this->assertTrue($container->getDefinition('foo')->isPublic());
    }
}

class RegisterTestController
{
    public function __construct(ControllerDummy $bar)
    {
    }

    public function fooAction(ControllerDummy $bar)
    {
    }

    protected function barAction(ControllerDummy $bar)
    {
    }
}

class ContainerAwareRegisterTestController implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function fooAction(ControllerDummy $bar)
    {
    }
}

class ControllerDummy
{
}

class NonExistentClassController
{
    public function fooAction(NonExistentClass $nonExistent)
    {
    }
}

class NonExistentClassDifferentNamespaceController
{
    public function fooAction(\Acme\NonExistentClass $nonExistent)
    {
    }
}

class NonExistentClassOptionalController
{
    public function fooAction(NonExistentClass $nonExistent = null)
    {
    }

    public function barAction(NonExistentClass $n
array('POST')));

        return array(
           array(new RouteCollection(), 'url_matcher0.php', array()),
           array($collection, 'url_matcher1.php', array()),
           array($redirectCollection, 'url_matcher2.php', array('base_class' => 'Symfony\Component\Routing\Tests\Fixtures\RedirectableUrlMatcher')),
           array($rootprefixCollection, 'url_matcher3.php', array()),
           array($headMatchCasesCollection, 'url_matcher4.php', array()),
           array($groupOptimisedCollection, 'url_matcher5.php', array('base_class' => 'Symfony\Component\Routing\Tests\Fixtures\RedirectableUrlMatcher')),
           array($trailingSlashCollection, 'url_matcher6.php', array()),
           array($trailingSlashCollection, 'url_matcher7.php', array('base_class' => 'Symfony\Component\Routing\Tests\Fixtures\RedirectableUrlMatcher')),
        );
    }

    /**
     * @param $dumper
     */
    private function generateDumpedMatcher(RouteCollection $collection, $redirectableStub = false)
    {
        $options = array('class' => $this->matcherClass);

        if ($redirectableStub) {
            $options['base_class'] = '\Symfony\Com
<?xml version="1.0" encoding="UTF-8" ?>
<routes xmlns="http://symfony.com/schema/routing"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/routing
        http://symfony.com/schema/routing/routing-1.0.xsd">

    <route id="blog" path="/blog">
        <default key="_controller">
            <string>AcmeBlogBundle:Blog:index</string>
        </default>
        <default key="values">
            <list>
                <bool>true</bool>
                <int>1</int>
                <float>3.5</float>
                <string>foo</string>
            </list>
        </default>
    </route>
</routes>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
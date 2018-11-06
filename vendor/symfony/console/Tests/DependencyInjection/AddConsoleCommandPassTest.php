plate)
    {
        if (empty($items)) {
            return '';
        }

        $buffer = '';

        foreach ($items as $name => $item) {
            $numMethods       = count($item['methods']);
            $numTestedMethods = 0;

            foreach ($item['methods'] as $method) {
                if ($method['executedLines'] == $method['executableLines']) {
                    $numTestedMethods++;
                }
            }

            if ($item['executableLines'] > 0) {
                $numClasses                   = 1;
                $numTestedClasses             = $numTestedMethods == $numMethods ? 1 : 0;
                $linesExecutedPercentAsString = Util::percent(
                    $item['executedLines'],
                    $item['executableLines'],
                    true
                );
            } else {
                $numClasses                   = 'n/a';
                $numTestedClasses             = 'n/a';
                $linesExecutedPercentAsString = 'n/a';
            }

            $buffer .= $this->renderItemTemplate(
                $template,
                [
                    'name'                         => $name,
                    'numClasses'                   => $numClasses,
                    'numTestedClasses'             => $numTestedClasses,
                    'numMethods'                   => $numMethods,
                    'numTestedMethods'             => $numTestedMethods,
                    'linesExecutedPercent'         => Util::percent(
                        $item['executedLines'],
                        $item['executableLines'],
                        false
                    ),
                    'linesExecutedPercentAsString' => $linesExecutedPercentAsString,
                    'numExecutedLines'             => $item['executedLines'],
                    'numExecutableLines'           => $item['executableLines'],
                    'testedMethodsPercent'         => Util::percent(
                        $numTestedMethods,
                        $numMethods,
                        false
                    ),
                    'testedMethodsPercentAsString' => Util::percent(
                        $numTestedMethods,
                        $numMethods,
                        true
                    ),
                    'testedClassesPercent'         => Util::percent(
                        $numTestedMethods == $numMethods ? 1 : 0,
                        1,
                        false
                    ),
                    'testedClassesPercentAsString' => Util::percent(
                        $numTestedMethods == $numMethods ? 1 : 0,
                        1,
                        true
                    ),
                    'crap'                         => $item['crap']
                ]
            );

            foreach ($item['methods'] as $method) {
                $buffer .= $this->renderFunctionOrMethodItem(
                    $methodItemTemplate,
                    $method,
                    '&nbsp;'
                );
            }
        }

        return $buffer;
    }

    /**
     * @param array          $functions
     * @param \Text_Template $template
     *
     * @return string
     */
    protected function renderFunctionItems(array $functions, \Text_Template $template)
    {
        if (empty($functions)) {
            return '';
        }

        $buffer = '';

        foreach ($functions as $function) {
            $buffer .= $this->renderFunctionOrMethodItem(
                $template,
                $function
            );
        }

        return $buffer;
    }

    /**
     * @param \Text_Template $template
     *
     * @return string
     */
    protected function renderFunctionOrMethodItem(\Text_Template $template, array $item, $indent = '')
    {
        $numTestedItems = $item['executedLines'] == $item['executableLines'] ? 1 : 0;

        return $this->renderItemTemplate(
            $template,
            [
                'name'                         => sprintf(
                    '%s<a href="#%d"><abbr title="%s">%s</abbr></a>',
                    $indent,
                    $item['startLine'],
                    htmlspecialchars($item['signature']),
                    isset($item['functionName']) ? $item['functionName'] : $item['methodName']
         
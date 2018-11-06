Document->createElement(
                        'package'
                    );

                    $packages[$namespace]->setAttribute('name', $namespace);
                    $xmlProject->appendChild($packages[$namespace]);
                }

                $packages[$namespace]->appendChild($xmlFile);
            }
        }

        $linesOfCode = $report->getLinesOfCode();

        $xmlMetrics = $xmlDocument->createElement('metrics');
        $xmlMetrics->setAttribute('files', count($report));
        $xmlMetrics->setAttribute('loc', $linesOfCode['loc']);
        $xmlMetrics->setAttribute('ncloc', $linesOfCode['ncloc']);
        $xmlMetrics->setAttribute('classes', $report->getNumClassesAndTraits());
        $xmlMetrics->setAttribute('methods', $report->getNumMethods());
        $xmlMetrics->setAttribute('coveredmethods', $report->getNumTestedMethods());
        $xmlMetrics->setAttribute('conditionals', 0);
        $xmlMetrics->setAttribute('coveredconditionals', 0);
        $xmlMetrics->setAttribute('statements', $report->getNumExecutableLines());
        $xmlMetrics->setAttribute('coveredstatements', $report->getNumExecutedLines());
        $xmlMetrics->setAttribute('elements', $report->getNumMethods() + $report->getNumExecutableLines() /* + conditionals */);
        $xmlMetrics->setAttribute('coveredelements', $report->getNumTestedMethods() + $report->getNumExecutedLines() /* + coveredconditionals */);
        $xmlProject->appendChild($xmlMetrics);

        $buffer = $xmlDocument->saveXML();

        if ($target !== null) {
            if (!is_dir(dirname($target))) {
                mkdir(dirname($target), 0777, true);
 
 before the stack was closed down
            // This is to get around not being able to have open 'q' across pages
            $opt = $this->stateStack[$pageEnd];
            // ok to use this as stack starts numbering at 1
            $this->setColor($opt['col'], true);
            $this->setStrokeColor($opt['str'], true);
            $this->addContent("\n" . $opt['lin']);
            //    $this->currentLineStyle = $opt['lin'];
        } else {
            $this->nStateStack++;
            $this->stateStack[$this->nStateStack] = array(
                'col' => $this->currentColor,
                'str' => $this->currentStrokeColor,
                'lin' => $this->currentLineStyle
            );
        }

        $this->save();
    }

    /**
     * restore a previously saved state
     */
    function restoreState($pageEnd = 0)
    {
        if (!$pageEnd) {
            $n = $this->nStateStack;
            $this->currentColor = $this->stateStack[$n]['col'];
            $this->currentStrokeColor = $this->stateStack[$n]['str'];
            $this->addContent("\n" . $this->stateStack[$n]['lin']);
            $this->currentLineStyle = $this->stateStack[$n]['l
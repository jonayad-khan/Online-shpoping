->addLooseObjects[$id] = 'all';

                case 'add':
                    if (isset($this->objects[$this->currentContents]['onPage'])) {
                        // then the destination contents is the primary for the page
                        // (though this object is actually added to that page)
                        $this->o_page($this->objects[$this->currentContents]['onPage'], 'content', $id);
                    }
                    break;

                case 'even':
                    $this->addLooseObjects[$id] = 'even';
                    $pageObjectId = $this->objects[$this->currentContents]['onPage'];
                    if ($this->objects[$pageObjectId]['info']['pageNum'] % 2 == 0) {
                        $this->addObject($id);
                        // hacky huh :)
                    }
                    break;

                case 'odd':
                    $this->addLooseObjects[$id] = 'odd';
                    $pageObjectId = $this->objects[$this->currentContents]['onPage'];
                    if ($this->objects[$pageObjectId]['info']['pageNum'] % 2 == 1) {
                        $this->addObject($id);
                        // hacky huh :)
                    }
                    break;

                case 'next':
                    $this->addLooseObjects[$id] = 'all';
                    break;

                case 'nexteven':
                    $this->addLooseObjects[$id] = 'even';
                    break;

                case 'nextodd':
                    $this->addLooseObjects[$id] = 'odd';
                    break;
            }
        }
    }

    /**
     * return a storable representation of a specific object
     */
    function serializeObject($id)
    {
        if (array_key_exists($id, $this->objects)) {
            return serialize($this->objects[$id]);
        }
    }

    /**
     * restore an object from its stored representation.  returns its new object id.
     */
    function restoreSerializedObject($obj)
    {
        $obj_id = $this->openObject();
        $this->objects[$obj_id] = unserialize($obj);
        $this->closeObject();

        return $obj_id;
    }

    /**
     * add content to the documents info object
     */
    function addInfo($label, $value = 0)
    {
        // this will only work if the label is one of the valid ones.
        // modify this so that arrays can be passed as well.
        // if $label is an array then assume that it is key => value pairs
        // else assume that they are both scalar, anything else will probably error
        if (is_array($label)) {
            foreach ($label as $l => $v) {
                $this->o_info($this->infoObject, $l, $v);
            }
        } else {
            $this->o_info($this->infoObject, $label, $value);
        }
    }

    /**
     * set the viewer preferences of the document, it is up to the browser to obey these.
     */
    function setPreferences($label, $value = 0)
    {
        // this will only work if the label is one of the valid ones.
        if (is_array($label)) {
            foreach ($label as $l => $v) {
                $this->o_catalog($this->catalogId, 'viewerPreferences', array($l => $v));
            }
        } else {
            $this->o_catalog($this->catalogId, 'viewerPreferences', array($label => $value));
        }
    }

    /**
     * extract an integer from a position in a byte stream
     */
    private function getBytes(&$data, $pos, $num)
    {
        // return the integer represented by $num bytes from $pos within $data
        $ret = 0;
        for ($i = 0; $i < $num; $i++) {
            $ret *= 25
TAG);

        $table->appendChild($thead);
        $table->appendChild($tbody);

        $tr = $element->ownerDocument->createElement(static::TR_TAG);
        $thead->appendChild($tr);
        for ($i = 0; $i < $cols; $i++) {
            $th = $element->ownerDocument->createElement(static::TH_TAG);
            $th->textContent = $this->generator->sentence(mt_rand(1, $maxTitle));
            $tr->appendChild($th);
        }
        for ($i = 0; $i < $rows; $i++) {
            $tr = $element->ownerDocument->createElement(static::TR_TAG);
            $tbody->appendChild($tr);
            for ($j = 0; $j < $cols; $j++) {
                $th = $element->ownerDocument->createElement(static::TD_TAG);
                $th->textContent = $this->generator->sentence(mt_rand(1, $maxLength));
                $tr->appendChild($th);
            }
        }
        $element->appendChild($table);
    }

    private function addRandomUL(\DOMElement $element, $maxItems = 11, $maxLength = 4)
    {
        $num = mt_rand(1, $maxItems);
        $ul = $element->ownerDocument->createElement(static::UL_TAG);
        for ($i = 0; $i < $num; $i++) {
            $li = $element->ownerDocument->createElement(static::LI_TAG);
            $li->textContent = $this->generator->sentence(mt_rand(1, $maxLength));
            $ul->appendChild($li);
        }
        $element->appendChild($ul);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
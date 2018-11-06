<?php

namespace Faker\Provider;

use Faker\Generator;
use Faker\UniqueGenerator;

class HtmlLorem extends Base
{

    const HTML_TAG = "html";
    const HEAD_TAG = "head";
    const BODY_TAG = "body";
    const DIV_TAG = "div";
    const P_TAG = "p";
    const A_TAG = "a";
    const SPAN_TAG = "span";
    const TABLE_TAG = "table";
    const THEAD_TAG = "thead";
    const TBODY_TAG = "tbody";
    const TR_TAG = "tr";
    const TD_TAG = "td";
    const TH_TAG = "th";
    const UL_TAG = "ul";
    const LI_TAG = "li";
    const H_TAG = "h";
    const B_TAG = "b";
    const I_TAG = "i";
    const TITLE_TAG = "title";
    const FORM_TAG = "form";
    const INPUT_TAG = "input";
    const LABEL_TAG = "label";

    private $idGenerator;

    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
        $generator->addProvider(new Lorem($generator));
        $generator->addProvider(new Internet($generator));
    }

    /**
     * @param integer $maxDepth
     * @param integer $maxWidth
     *
     * @return string
     */
    public function randomHtml($maxDepth = 4, $maxWidth = 4)
    {
        $document = new \DOMDocument();
        $this->idGenerator = new UniqueGenerator($this->generator);

        $head = $document->createElement("head");
        $this->addRandomTitle($head);

        $body = $document->createElement("body");
        $this->addLoginForm($body);
        $this->addRandomSubTree($body, $maxDepth, $maxWidth);

        $html = $document->createElement("html");
        $html->appendChild($head);
        $html->appendChild($body);

        $document->appendChild($html);
        return $document->saveHTML();
    }

    private function addRandomSubTree(\DOMElement $root, $maxDepth, $maxWidth)
    {
        $maxDepth--;
        if ($maxDepth <= 0) {
            return $root;
        }

        $siblings = mt_rand(1, $maxWidth);
        for ($i = 0; $i < $siblings; $i++) {
            if ($maxDepth == 1) {
                $this->addRandomLeaf($root);
            } else {
                $sibling = $root->ownerDocument->createElement("div");
                $root->appendChild($sibling);
                $this->addRandomAttribute($sibling);
                $this->addRandomSubTree($sibling, mt_rand(0, $maxDepth), $maxWidth);
            }
        };
        return $root;
    }

    private function addRandomLeaf(\DOMElement $node)
    {
        $rand = mt_rand(1, 10);
        switch($rand){
            case 1:
                $this->addRandomP($node);
                break;
            case 2:
                $this->addR
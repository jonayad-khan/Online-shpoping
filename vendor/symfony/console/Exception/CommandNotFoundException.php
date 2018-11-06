<?php

namespace Faker\ORM\Propel2;

use \Propel\Generator\Model\PropelTypes;
use \Propel\Runtime\Map\ColumnMap;

class ColumnTypeGuesser
{
    protected $generator;

    /**
     * @param \Faker\Generator $generator
     */
    public function __construct(\Faker\Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param ColumnMap $column
     * @return \Closure|null
     */
    public function guessFormat(ColumnMap $column)
    {
        $generator = $this->generator;
        if ($column->isTemporal()) {
            if ($column->getType() == PropelTypes::BU_DATE || $column->getType() == PropelTypes::BU_TIMESTAMP) {
                return function () use ($generator) {
                    return $generator->dateTime;
                };
            } else {
                return function () use ($generator) {
                    return $generator->dateTimeAD;
                };
            }
        }
        $type = $column->getType();
        switch ($type) {
            case PropelTypes::BOOLEAN:
            case PropelTypes::BOOLEAN_EMU:
                return function () use ($generator) {
                    return $generator->boolean;
                }
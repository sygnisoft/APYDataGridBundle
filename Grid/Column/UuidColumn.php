<?php

namespace APY\DataGridBundle\Grid\Column;

class UuidColumn extends Column
{
    protected const FORMAT_SHORT = 'short';
    protected const FORMAT_FULL = 'full';

    protected static $formats = [
        self::FORMAT_FULL,
        self::FORMAT_SHORT,
    ];

    protected static $availableOperators = [
        self::OPERATOR_EQ,
        self::OPERATOR_LIKE,
    ];

    protected $format;

    public function __initialize(array $params)
    {
        parent::__initialize($params);
        $this->setFormat($this->getParam('format') ?? self::FORMAT_SHORT);
        $this->setDefaultOperator($this->getParam('defaultOperator') ?? self::OPERATOR_LIKE);

        $this->setOperators($this->getParam('operators', [
            self::OPERATOR_EQ,
            self::OPERATOR_LIKE,
        ]));
    }

    public function isQueryValid($query)
    {
        return true;
    }

    public function renderCell($value, $row, $router)
    {
        $value = $this->getDisplayedValue($value);

        if (is_callable($this->callback)) {
            return call_user_func($this->callback, $value, $row, $router);
        }

        return $value;
    }

    public function getDisplayedValue($value): string
    {
        if ($this->format === self::FORMAT_SHORT) {
            return (string) substr($value, 0, 8);
        }

        return (string) $value;
    }

    public function setFormat($format)
    {
        if (in_array($format, self::$formats, true)) {
            $this->format = $format;
        }

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getType()
    {
        return 'uuid';
    }
}

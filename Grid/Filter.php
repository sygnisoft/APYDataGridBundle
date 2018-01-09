<?php

/*
 * This file is part of the DataGridBundle.
 *
 * (c) Abhoryo <abhoryo@free.fr>
 * (c) Stanislav Turza
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APY\DataGridBundle\Grid;

class Filter
{
    protected $value;
    protected $operator;
    protected $columnName;
    protected $trim = false;


    /**
     * @param string      $operator
     * @param mixed|null  $value
     * @param string|null $columnName
     * @param boolean     $trim
     */
    public function __construct($operator, $value = null, $columnName = null, $trim = false)
    {
        $this->value = $value;
        $this->operator = $operator;
        $this->columnName = $columnName;
        $this->trim = $trim;
    }

    /**
     * @param string $operator
     *
     * @return Filter
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $value
     *
     * @return Filter
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getValue()
    {
        if ($this->isTrim()) {
            $this->value = trim($this->value);
        }

        return $this->value;
    }

    /**
     * @return bool
     */
    public function hasColumnName()
    {
        return $this->columnName !== null;
    }

    /**
     * @param string $columnName
     *
     * @return Filter
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * @return bool
     */
    public function isTrim()
    {
        return $this->trim && is_string($this->value);
    }

    /**
     * @param bool $trim
     * @return Filter
     */
    public function setTrim($trim)
    {
        $this->trim = $trim;

        return $this;
    }
}

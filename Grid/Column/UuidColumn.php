<?php

namespace APY\DataGridBundle\Grid\Column;

class UuidColumn extends Column
{
    public function __initialize(array $params)
    {
        parent::__initialize($params);

        $this->setOperators($this->getParam('operators', [
            self::OPERATOR_EQ,
        ]));
    }

    public function getType()
    {
        return 'uuid';
    }

    public function isQueryValid($query)
    {
        $isValid = uuid_is_valid($query);

        return $isValid === true ? true : false;
    }
}
<?php

declare(strict_types=1);

namespace APY\DataGridBundle\Grid\Source;

use APY\DataGridBundle\Grid\Column\Column;
use APY\DataGridBundle\Grid\Rows;

class MaxResultsEntity extends Entity
{
    protected $resultsLimit;

    protected $overLimit = false;

    public function __construct(
        int $resultsLimit,
        string $entityName,
        string $group = 'default',
        ?string $managerName = null
    ) {
        $this->resultsLimit = $resultsLimit;
        parent::__construct($entityName, $group, $managerName);
    }

    /**
     * @return bool
     */
    public function isOverLimit(): bool
    {
        return $this->overLimit;
    }

    public function getTotalCount($maxResults = null)
    {
        $count = parent::getTotalCount($maxResults);
        if ($count > $this->resultsLimit) {
            $this->overLimit = true;

            return 0;
        }

        return $count;
    }

    public function execute(
        $columns,
        $page = 0,
        $limit = 0,
        $maxResults = null,
        $gridDataJunction = Column::DATA_CONJUNCTION
    ) {
        if ($this->overLimit) {
            return new Rows();
        }
        $result = parent::execute(
            $columns,
            $page,
            $limit,
            $maxResults,
            $gridDataJunction
        );
        if ($result->count() > $this->resultsLimit) {
            $this->overLimit = true;

            return new Rows();
        }

        return $result;
    }
}

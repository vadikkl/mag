<?php

namespace Mvk\InstagramWall\Model\ResourceModel\Block;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mvk\InstagramWall\Model\Block', 'Mvk\InstagramWall\Model\ResourceModel\Block');
    }
}
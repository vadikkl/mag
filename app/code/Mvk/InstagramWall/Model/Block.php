<?php

namespace Mvk\InstagramWall\Model;

use \Magento\Framework\Model\AbstractModel;

class Block extends AbstractModel
{
    /**
     * @var \Mvk\InstagramWall\Model\ResourceModel\Block\Collection
     */
    protected $_defaultCollection;

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mvk\InstagramWall\Model\ResourceModel\Block');
    }
}
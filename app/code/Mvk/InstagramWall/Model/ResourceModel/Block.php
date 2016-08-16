<?php

namespace Mvk\InstagramWall\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Block extends AbstractDb
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mvk_instagramwall_blocks', 'entity_id');
    }
}
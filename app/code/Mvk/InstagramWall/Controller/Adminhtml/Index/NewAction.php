<?php

namespace Mvk\InstagramWall\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\Registry;
//use \Ewave\TrendingNow\Model\BlockFactory;

class NewAction extends Action
{
    /**
     * @var PageFactory $_resultPageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var Registry $_registry
     */
    protected $_registry;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        parent::__construct($context);
    }

    /**
     * New trending category page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        die('111');
    }

    /**
     * Check access (in the ACL) for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mvk_InstagramWall::menu');
    }
}
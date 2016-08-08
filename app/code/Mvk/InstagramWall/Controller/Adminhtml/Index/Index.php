<?php

namespace Mvk\InstagramWall\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action\Context;
use \Magento\Backend\App\Action;
use \Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
    }

    /**
     * Index page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu('Mvk_InstagramWall::mvk');
        $resultPage->addBreadcrumb(__('Instagram Wall Management'), __('Instagram Wall Management'));
        $resultPage->getConfig()->getTitle()->prepend(__('Instagram Wall Management'));

        return $resultPage;
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
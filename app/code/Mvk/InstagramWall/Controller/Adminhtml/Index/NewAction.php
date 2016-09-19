<?php

namespace Mvk\InstagramWall\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\Registry;
use \Mvk\InstagramWall\Model\BlockFactory;

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
     * @var BlockFactory
     */
    protected $_blocksFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param BlockFactory $blocksFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        BlockFactory $blocksFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        $this->_blocksFactory = $blocksFactory;
        parent::__construct($context);
    }

    /**
     * New trending category page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $model = $this->_blocksFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This block item doesn\'t exist'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_registry->register('instagramwall_block_item', $model);

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Mvk_InstagramWall::menu')
            ->addBreadcrumb(__('Instagram Wall'), __('Instagram Wall'))
            ->addBreadcrumb(
                $id ? __('Edit Instagram Wall Item') : __('New Instagram Wall Item'),
                $id ? __('Edit Instagram Wall Item') : __('New Instagram Wall Item')
            );
        $resultPage->getConfig()->getTitle()->prepend(__('Instagram Wall Items'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Instagram Wall Item'));

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
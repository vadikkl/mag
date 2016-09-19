<?php

namespace Mvk\InstagramWall\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Mvk\InstagramWall\Model\BlockFactory;
use \Mvk\InstagramWall\Model\ResourceModel\Block\CollectionFactory;

class Save extends Action
{
    /**
     * @var \Mvk\InstagramWall\Model\BlockFactory
     */
    protected $_instagramBlockFactory;

    /**
     * @param Context $context
     * @param BlockFactory $instagramBlockFactory
     */
    public function __construct(
        Context $context,
        BlockFactory $instagramBlockFactory
    ) {
        $this->_instagramBlockFactory = $instagramBlockFactory;
        parent::__construct($context);
    }

    /**
     * Save trending now category
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /* @var \Mvk\InstagramWall\Model\Block $model */
            $model = $this->_instagramBlockFactory->create();
            if ($id) {
                $model->load($id);
                $data[$model->getIdFieldName()] = $id;
            }

            $model->setData($data);
            try {
                $model->save();
                $id = $model->getId();
                $this->messageManager->addSuccessMessage(__('Imstagram item was successfully saved.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the instagram item')
                );
            }

            $this->_getSession()->setFormData($data);
        } else {
            $this->messageManager->addErrorMessage(__('Incorrect data'));
        }

        return $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);
    }
}
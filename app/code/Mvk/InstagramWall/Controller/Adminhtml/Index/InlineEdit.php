<?php
namespace Mvk\InstagramWall\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Mvk\InstagramWall\Model\BlockFactory;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class InlineEdit
 *
 * @package Mvk\InstagramWall\Controller\Adminhtml\Index
 */
class InlineEdit extends Action
{
    /**
     * BlockFactory
     *
     * @var \Mvk\InstagramWall\Model\BlockFactory
     */
    protected $_instagramWallBlockFactory;

    /**
     * JsonFactory
     *
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * InlineEdit constructor.
     *
     * @param Context $context
     * @param BlockFactory $instagramWallBlockFactory
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        BlockFactory $instagramWallBlockFactory,
        JsonFactory $jsonFactory
    ) {
        $this->_instagramWallBlockFactory = $instagramWallBlockFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * Edit trending now category
     *
     * @return string
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();

        $postData = $this->getRequest()->getPostValue();
        $isAjax = (bool)$this->getRequest()->getParam('isAjax');

        try {
            if (!$isAjax || empty($postData['items']) || !is_array($postData['items'])) {
                throw new \Magento\Framework\Exception\LocalizedException(__('Incorrect data'));
            }

            $data = current($postData['items']);
            $id = intval($data['entity_id']);

            /* @var \Mvk\InstagramWall\Model\Block $model */
            $model = $this->_instagramWallBlockFactory->create();
            $model->load($id);
            $model->addData($data);
            $model->save();
        } catch (\Exception $e) {
            return $resultJson->setData(['messages' => [$e->getMessage()], 'error' => true]);
        }

        return $resultJson->setData(['error' => false]);
    }
}
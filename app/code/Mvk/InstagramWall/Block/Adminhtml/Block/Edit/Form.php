<?php

namespace Mvk\InstagramWall\Block\Adminhtml\Block\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;
use \Magento\Backend\Block\Template\Context;
use \Magento\Framework\Registry;
use \Magento\Framework\Data\FormFactory;
use \Magento\Store\Model\System\Store;

class Form extends Generic
{
    const INSTA_TAG = 'tag';
    const INSTA_USER = 'user';
    const INSTA_LOCATION = 'location';
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;


    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('edit_form');
        $this->setTitle(__('Instagramm Wall Item Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('instagramwall_block_item');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $fieldset = $form->addFieldset(
            'base_fieldset',
            [
                'legend' => __('Trending now category information'),
                'class' => 'fieldset-wide'
            ]
        );

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
                'class' => ''
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'options' => $this->_getStatusOptions(),
                'required' => true
            ]
        );

        $fieldset->addField(
            'type',
            'select',
            [
                'label' => __('Type'),
                'title' => __('Type'),
                'name' => 'type',
                'options' => $this->_getTypeOptions(),
                'required' => true
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Get options for Enabled/Disabled dropdown
     *
     * @return array
     */
    protected function _getStatusOptions()
    {
        return [
            '0' => __('Disabled'),
            '1' => __('Enabled'),
        ];
    }

    /**
     * Get options for Type dropdown
     *
     * @return array
     */
    protected function _getTypeOptions()
    {
        return [
            self::INSTA_USER => __(ucwords(self::INSTA_USER)),
            self::INSTA_TAG => __(ucwords(self::INSTA_TAG)),
            self::INSTA_LOCATION => __(ucwords(self::INSTA_LOCATION))
        ];
    }

    /**
     * Initialize form fileds values
     *
     * @return $this
     */
    protected function _initFormValues()
    {
        $model = $this->_coreRegistry->registry('instagramwall_block_item');

        $form = $this->getForm();
        $data = $model->getData();
        $form->setValues($data);
        return $this;
    }

    /**
     * Check if category is active
     *
     * @return int
     */
    protected function _isItemActive()
    {
        $model = $this->_coreRegistry->registry('instagramwall_block_item');
        return $model->getIsActive();
    }
}
<?php

namespace Mvk\InstagramWall\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('mvk_instagramwall_blocks'))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity Id'
            )->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Store Id'
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50,
                ['nullable' => false],
                'Block Title'
            )->addColumn(
                'type',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                50,
                ['nullable' => false],
                'Type'
            )->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'unsigned' => true, 'default' => 0],
                'Is Active'
            )->addForeignKey(
                $installer->getFkName('mvk_instagramwall_blocks', 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->addIndex(
                $setup->getIdxName(
                    $installer->getTable('mvk_instagramwall_blocks'),
                    ['title'],
                    AdapterInterface::INDEX_TYPE_INDEX
                ),
                ['title'],
                ['type' => AdapterInterface::INDEX_TYPE_INDEX]
            )->setComment(
                'Mvk Instagram Wall Blocks Table'
            );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
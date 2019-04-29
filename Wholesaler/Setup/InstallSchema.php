<?php

namespace Sander\Wholesaler\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        if ( ! $installer->tableExists('sander_wholesaler_sales')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('sander_wholesaler_sales')
            )
                               ->addColumn(
                                   'sale_id',
                                   \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'identity' => true,
                                       'nullable' => false,
                                       'primary'  => true,
                                       'unsigned' => true,
                                   ],
                                   'Sale ID'
                               )
                               ->addColumn(
                                   'sku',
                                   \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                   255,
                                   ['nullable => false'],
                                   'SKU'
                               )
                               ->addColumn(
                                   'qty',
                                   \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                   null,
                                   ['nullable => false'],
                                   'Quantity'
                               )
                               ->setComment('Sales Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('sander_wholesaler_sales'),
                $setup->getIdxName(
                    $installer->getTable('sander_wholesaler_sales'),
                    ['sku'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['sku'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}

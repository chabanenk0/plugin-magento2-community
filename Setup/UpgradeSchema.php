<?php
/**
 * Altapay Module for Magento 2.x.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2018 Altapay
 * @category  payment
 * @package   altapay
 */
namespace SDM\Altapay\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

/**
 * Class UpgradeSchema
 * @package SDM\Altapay\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $orderTable = 'sales_order';
        //Add a new attribute for the redirect to the payment form
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'altapay_payment_form_url',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 65536,
                    'nullable' => true,
                    'visible' => false,
                    'comment' =>'Altapay Payment Form Url'
                ]
            );

        $setup->endSetup();
    }
}

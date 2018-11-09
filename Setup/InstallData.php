<?php
/**
 * Installs module data
 *
 * @category  Rain2o
 * @package   Rain2o_MultiselectSourceSample
 * @author    Joel Rainwater <joel.rain2o@gmail.com>
 * @copyright 2018 Joel Rainwater
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/rain2o/magento2-Rain2o_MultiselectSourceSample
 */
namespace Rain2o\MultiselectSourceSample\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Rain2o\MultiselectSourceSample\Model\Product\Attribute\Source\SourceSample;

class InstallData implements InstallDataInterface
{

    /**
     * Eav setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory EAV Setup Factory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Installs custom multiselect product attribute
     *
     * @SuppressWarnings(Generic.CodeAnalysis.UnusedFunctionParameter)
     *
     * @param ModuleDataSetupInterface $setup   Setup interface
     * @param ModuleContextInterface   $context Context interface
     *
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {

        /** @var $eavSetup EavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'rain2o_multiselectsample',
            [
                'type' => 'varchar',
                'label' => 'Multiselect Sample',
                'input' => 'multiselect',
                'backend' => ArrayBackend::class,
                'source' => SourceSample::class,
                'required' => false,
                'sort_order' => 150,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General',
                'visible' => 1,
                'searchable' => 1,
                'filterable' => 1,
                'visible_on_front' => 1,
                'filterable_in_search' => 1,
                'used_in_product_listing' => 1,
                'visible_in_advanced_search' => 1,
            ]
        );
    }
}

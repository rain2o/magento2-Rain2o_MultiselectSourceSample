<?php
/**
 * Provides a sample custom source for the multiselect attribute type.
 *
 * @category  Rain2o
 * @package   Rain2o_MultiselectSourceSample
 * @author    Joel Rainwater <joel.rain2o@gmail.com>
 * @copyright 2018 Joel Rainwater
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/rain2o/magento2-Rain2o_MultiselectSourceSample
 */
namespace Rain2o\MultiselectSourceSample\Model\Product\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Store\Model\StoreManagerInterface;

class SourceSample extends AbstractSource
{

    /**
     * Options array
     *
     * @var array
     */
    private $options;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param StoreManagerInterface $storeManager Store Manager
     */
    public function __construct(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $storeId = $this->getAttribute()->getStoreId();
        if ($storeId === null) {
            $storeId = $this->storeManager->getStore()->getId();
        }
        if (!is_array($this->_options)) {
            $this->_options = [];
        }
        if (!isset($this->_options[$storeId])) {
            $this->_options[$storeId] = [
                ['label' => 'Do', 'value' => 0],
                ['label' => 'Re', 'value' => 1],
                ['label' => 'Mi', 'value' => 2],
                ['label' => 'Fa', 'value' => 3],
                ['label' => 'So', 'value' => 4],
                ['label' => 'La', 'value' => 5],
                ['label' => 'Ti', 'value' => 6],
            ];
        }

        return $this->_options[$storeId];
    }

    /**
     * Get a text for option value
     *
     * @param  string|int $value
     * @return string|bool
     */
    public function getOptionText($value)
    {
        $isMultiple = false;
        if (strpos($value, ',') !== false) {
            $isMultiple = true;
            $value = explode(',', $value);
        }
        if (!is_array($value)) {
            $value = [$value];
        }

        $options = array_intersect_key(
            $this->getAllOptions(),
            array_flip($value)
        );

        if ($isMultiple) {
            $values = [];
            foreach ($options as $item) {
                if (in_array($item['value'], $value)) {
                    $values[] = $item['label'];
                }
            }
            return $values;
        }

        foreach ($options as $item) {
            if ($item['value'] == $value) {
                return $item['label'];
            }
        }
        return false;
    }
}

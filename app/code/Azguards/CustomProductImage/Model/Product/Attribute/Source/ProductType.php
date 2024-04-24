<?php
declare(strict_types=1);

namespace Azguards\CustomProductImage\Model\Product\Attribute\Source;

class ProductType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
        ['value' => 'Standard', 'label' => __('Standard')],
        ['value' => 'custom', 'label' => __('Custom')]
        ];
        return $this->_options;
    }
}


<?php

namespace Azguards\CustomProductImage\Api;

interface ProductTypeInterface
{
    /**
     * Set product type for a specific SKU
     *
     * @param string $sku
     * @param string $type
     * @return bool
     */
    public function setProductType($sku, $type);
}

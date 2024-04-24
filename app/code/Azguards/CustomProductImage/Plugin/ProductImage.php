<?php

namespace Azguards\CustomProductImage\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Block\Product\Image as ImageBlock;

class ProductImage
{
    
    public function aroundCreate(
        \Magento\Catalog\Block\Product\ImageFactory $subject,
        \Closure $proceed,
        Product $product,
        string $imageId,
        array $attributes = null
    ): ImageBlock {
        $result = $proceed($product, $imageId, $attributes);
        $attributeCode = 'product_type';
        $productTypeAttribute = $product->getCustomAttribute($attributeCode);

        if (!$productTypeAttribute || $productTypeAttribute->getValue() !== 'custom') {
            return $result;
        }
        $result->setData('image_url', 'https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg');
        return $result;
    }
}

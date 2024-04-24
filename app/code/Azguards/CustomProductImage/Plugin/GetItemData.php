<?php

namespace Azguards\CustomProductImage\Plugin;

use Magento\Checkout\CustomerData\AbstractItem;
use Magento\Catalog\Api\ProductRepositoryInterface;

class GetItemData
{
    /**
     * AfterGetImageData constructor.
     */
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @param AbstractItem $item
     * @param $result
     * @return mixed
     */
    public function afterGetItemData(AbstractItem $item, $result)
    {
        try {
            if ($result['product_id'] > 0) {
                $attributeCode = 'product_type';
                $product = $this->productRepository->getById($result['product_id']);
                $productTypeAttribute =  $product->getCustomAttribute($attributeCode);

                if ($productTypeAttribute && $productTypeAttribute->getValue() === 'custom') {
                    
                    $image = 'https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg';
                    $result['product_image']['src'] = $image;
                }
            }
        } catch (\Exception $e) {
            
        }

        return $result;
    }
}
<?php

namespace Azguards\CustomProductImage\Model;

use Azguards\CustomProductImage\Api\ProductTypeInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductType implements ProductTypeInterface
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function setProductType($sku, $type)
    {
        try {
            $product = $this->productRepository->get($sku);
            $product->setCustomAttribute('product_type', $type);
            $this->productRepository->save($product);
            return true;
        } catch (NoSuchEntityException $e) {
            return false;
        }
    }
}

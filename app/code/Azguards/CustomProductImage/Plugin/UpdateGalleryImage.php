<?php

namespace Azguards\CustomProductImage\Plugin;

use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\Data\Collection;
use Magento\Framework\Data\CollectionFactory;
use Magento\Framework\DataObject;

class UpdateGalleryImage
{
    /**
     * @var CollectionFactory
     */
    protected $dataCollectionFactory;

    /**
     *
     * @param CollectionFactory $dataCollectionFactory
     */
    public function __construct(
        CollectionFactory $dataCollectionFactory
    ) {
        $this->dataCollectionFactory = $dataCollectionFactory;
    }

    /**
     *
     * @param Gallery $subject
     * @param Collection|null $images
     * @return Collection|null
     */
    public function afterGetGalleryImages(Gallery $subject, $images) {
        try {
            $attributeCode = 'product_type';
            $product = $subject->getProduct();
            $productTypeAttribute = $product->getCustomAttribute($attributeCode);

            if (!$productTypeAttribute || $productTypeAttribute->getValue() !== 'custom') {
                return $images;
            }

            $images = $this->dataCollectionFactory->create();
            $productName = $product->getName();
            $externalImages = ["https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg"]; // Array of images
            foreach ($externalImages as $item) {
                $imageId    = uniqid();
                $small      = $item;
                $medium     = $item;
                $large      = $item;
                $image = [
                    'file' => $large,
                    'media_type' => 'image',
                    'value_id' => $imageId, // unique value
                    'row_id' => $imageId, // unique value
                    'label' => $productName,
                    'label_default' => $productName,
                    'position' => 100,
                    'position_default' => 100,
                    'disabled' => 0,
                    'url'  => $large,
                    'path' => '',
                    'small_image_url' => $small,
                    'medium_image_url' => $medium,
                    'large_image_url' => $large
                ];
                $images->addItem(new DataObject($image));
            }

            return $images;
        } catch (\Exception $e) {
            return $images;
        }

    }
}

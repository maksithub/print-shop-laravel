<?php

namespace App\Shop\ProductAttributes\Repositories;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Shop\Products\Product;
use App\Shop\Attributes\Attribute;
use App\Shop\ProductAttributes\ProductAttribute;

interface ProductAttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function associateProduct(Product $product, attribute $attribute);
	public function dissociateFromAttribute() : bool;
    public function findProductAttributeById(int $id);
}

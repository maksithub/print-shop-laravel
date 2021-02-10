<?php

namespace App\Shop\ProductAttributes\Repositories;

use Jsdecena\Baserepo\BaseRepository;
use App\Shop\ProductAttributes\Exceptions\ProductAttributeNotFoundException;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\Products\Product;
use App\Shop\Attributes\Attribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductAttributeRepository extends BaseRepository implements ProductAttributeRepositoryInterface
{
    /**
     * ProductAttributeRepository constructor.
     * @param ProductAttribute $productAttribute
     */
    public function __construct(ProductAttribute $productAttribute)
    {
        parent::__construct($productAttribute);
        $this->model = $productAttribute;
    }

    /**
     * Create the attribute value and associate to the attribute
     *
     * @param Product $product
     * @return Attribute
     */
    public function associateProduct(Product $product, Attribute $attribute)
    {
        $this->model->product()->associate($product);
        $this->model->attribute()->associate($attribute);
        $this->model->save();
        return $this->model;
    }

    /**
     * Remove association from the attribute
     */
    public function dissociateFromAttribute() : bool
    {
        return $this->model->delete();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ProductAttributeNotFoundException
     */
    public function findProductAttributeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductAttributeNotFoundException($e);
        }
    }
}

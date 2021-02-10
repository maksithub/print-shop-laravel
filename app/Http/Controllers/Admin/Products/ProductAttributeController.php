<?php

namespace App\Http\Controllers\Admin\Products;

use App\Shop\Attributes\Exceptions\AttributeNotFoundException;
use App\Shop\Attributes\Exceptions\CreateAttributeErrorException;
use App\Shop\Attributes\Exceptions\UpdateAttributeErrorException;
use App\Shop\Attributes\Repositories\AttributeRepository;
use App\Shop\Attributes\Repositories\AttributeRepositoryInterface;
use App\Shop\Attributes\Requests\CreateAttributeRequest;
use App\Shop\Attributes\Requests\UpdateAttributeRequest;


use App\Shop\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use App\Shop\Brands\Repositories\BrandRepositoryInterface;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\ProductAttributes\Repositories\ProductAttributeRepository;
use App\Shop\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use App\Shop\ProductAttributes\Requests\CreateProductAttributeRequest;
use App\Shop\Products\Exceptions\ProductInvalidArgumentException;
use App\Shop\Products\Exceptions\ProductNotFoundException;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Repositories\ProductRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductAttributeController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepo;

    /**
     * @var ProductAttribute
     */
    private $productAttribute;

    /**
     * ProductController constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param AttributeRepositoryInterface $attributeRepository
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @param ProductAttribute $productAttribute
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(
    ProductRepositoryInterface $productRepository,
    ProductAttribute $productAttribute,
    AttributeRepositoryInterface $attributeRepository,
    ProductAttributeRepositoryInterface $productAttributeRepo
    ) {
        $this->productRepo = $productRepository;
        $this->attributeRepo = $attributeRepository;
        $this->productAttribute = $productAttribute;
        $this->productAttributeRepo = $productAttributeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($productID)
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $productID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeRequest $request, $productID)
    {

        $attribute = $this->attributeRepo->createAttribute($request->except('_token'));

        $product = $this->productRepo->findProductById($productID);

        $productAttribute = new ProductAttribute($request->except('_token'));
        
        $productAttributeRepo = new ProductAttributeRepository($productAttribute);

        $productAttributeRepo->associateProduct($product, $attribute);
        $request->session()->flash('message', 'Create attribute successful!');
        return redirect()->route('admin.products.edit', $productID);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productID, $attributeID)
    {
        $attribute = $this->attributeRepo->findAttributeById($attributeID);
        $attributeRepo = new AttributeRepository($attribute);
        return view('admin.attributes.show', [
            'attribute' => $attribute,
            'values' => $attributeRepo->listAttributeValues()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productID, $attributeID)
    {
        $attribute = $this->attributeRepo->findAttributeById($attributeID);
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productID, $attributeID)
    {
        $this->attributeRepo->findAttributeById($attributeID)->delete();

        request()->session()->flash('message', 'Attribute deleted successfully!');

        return redirect()->route('admin.products.index');
    }
}

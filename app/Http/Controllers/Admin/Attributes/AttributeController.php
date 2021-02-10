<?php

namespace App\Http\Controllers\Admin\Attributes;

use App\Http\Controllers\Controller;
use App\Shop\Attributes\Exceptions\AttributeNotFoundException;
use App\Shop\Attributes\Exceptions\CreateAttributeErrorException;
use App\Shop\Attributes\Exceptions\UpdateAttributeErrorException;
use App\Shop\Attributes\Repositories\AttributeRepository;
use App\Shop\Attributes\Repositories\AttributeRepositoryInterface;
use App\Shop\AttributeValues\Repositories\AttributeValueRepository;
use App\Shop\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use App\Shop\Attributes\Requests\CreateAttributeRequest;
use App\Shop\Attributes\Requests\UpdateAttributeRequest;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Repositories\ProductRepository;

class AttributeController extends Controller
{
    private $attributeRepo;

    private $attributeValueRepo;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * AttributeController constructor.
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $AttributeValueRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->attributeRepo = $attributeRepository;
        $this->attributeValueRepo = $AttributeValueRepository;
        $this->productRepo = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $results = $this->attributeRepo->listAttributes();
        $attributes = $this->attributeRepo->paginateArrayResults($results->all());

        return view('admin.attributes.list', compact('attributes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($productID)
    {
        return view('admin.attributes.create', ['productID'=>$productID]);
    }

    /**
     * @param CreateAttributeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeRequest $request, $id)
    {
        $product = $this->productRepo->findProductById($id);
        $attribute = $this->attributeRepo->createAttribute($product, $request->except('_token'));

        $request->session()->flash('message', 'Create attribute successful!');

        return redirect()->route('admin.products.edit', $id)->with('message', 'Attribute created');;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($productID, $attributeID)
    {
        try {
            $attribute = $this->attributeRepo->findAttributeById($attributeID);
            $attributeRepo = new AttributeRepository($attribute);
            return view('admin.attributes.show', [
                'productID' => $productID,
                'attribute' => $attribute,
                'values' => $attributeRepo->listAttributeValues()
            ]);
        } catch (AttributeNotFoundException $e) {
            request()->session()->flash('error', 'The attribute you are looking for is not found.');

            return redirect()->route('admin.attributes.index');
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($productID, $id)
    {
        $attribute = $this->attributeRepo->findAttributeById($id);
        return view('admin.attributes.edit', [
            'productID' => $productID,
            'attribute' => $attribute
        ]);
    }

    /**
     * @param UpdateAttributeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAttributeRequest $request, $productID, $id)
    {
        try {
            $attribute = $this->attributeRepo->findAttributeById($id);

            $attributeRepo = new AttributeRepository($attribute);
            $attributeRepo->updateAttribute($request->except('_token'));

            $request->session()->flash('message', 'Attribute update successful!');

            return redirect()->route('admin.products.edit', $productID);
        } catch (UpdateAttributeErrorException $e) {
            $request->session()->flash('error', $e->getMessage());

            return redirect()->route('admin.products.edit', $productID)->withInput();
        }
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function destroy($productID, $id)
    {
        $attribute = $this->attributeRepo->findAttributeById($id);
        $attributeRepo = new AttributeRepository($attribute);
        $attributeValues = $attributeRepo->listAttributeValues();
        foreach ($attributeValues as $attributeValue) {
            $attributeValueRepo = new AttributeValueRepository($attributeValue);
            $attributeValueRepo->dissociateFromAttribute();
        }
        $attribute->delete();
        
        request()->session()->flash('message', 'Attribute deleted successfully!');

        return redirect()->route('admin.products.edit', $productID);
    }
}

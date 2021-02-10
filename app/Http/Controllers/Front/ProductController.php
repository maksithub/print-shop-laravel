<?php

namespace App\Http\Controllers\Front;

use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;
use App\Shop\Categories\Repositories\CategoryRepository;
use Naoray\LaravelReviewable\Models\Review;
use App\User;


class ProductController extends Controller
{
    use ProductTransformable;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;
    private $cats;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'), request()->input('product_cat'));
        } else {
            $list = $this->productRepo->listProducts();
        }

        $products = $list->where('status', 1)->map(function (Product $item) {
            return $this->transformProduct($item);
        });

        return view('front.products.product-search', [
            'products' => $this->productRepo->paginateArrayResults($products->all(), 10), 
        ]);
    }

    /**
     * Get the product
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $product = $this->productRepo->findProductBySlug(['slug' => $slug]);
        $images = $product->images()->get();
        $category = $product->categories()->first();
        $productAttributes = $product->attributes;

        return view('front.products.product', compact(
            'product',
            'images',
            'productAttributes',
            'category',
            'combos'
        ));
    }

    public function review()
    {
        
        $productid = request()->input('comment_parent');
        $product = $this->productRepo->findProductById($productid);
        $data = [
            'score' => request()->input('rating'),
            'body' => request()->input('comment'),
        ];
        $author = \Auth::user();
        $review = Review::firstOrNew(['reviewable_id' => $product->id, 'author_id' => $author->id]);

        $review->fill($data);
        $review->author()->associate($author);
        $review->reviewable()->associate($product);
        $review->save();
        return redirect()->back();
    }
}

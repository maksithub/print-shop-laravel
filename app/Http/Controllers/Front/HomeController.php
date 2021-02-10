<?php

namespace App\Http\Controllers\Front;

use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;
use App\Shop\Products\Product;

class HomeController extends Controller
{
    use ProductTransformable;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * HomeController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::limit(6)->get();
        $best_deals = Product::limit(6)->orderByRaw('sale_price/price desc')->get();
        $latests = Product::where('new', 1)->limit(6)->get();
        $features = Product::where('featured', '=', 1)->limit(6)->get();
        $toprates = Product::where('top_rated', '=', 1)->limit(6)->get();
        return view('front.index', compact('products', 'latests', 'features', 'toprates', 'best_deals'));
    }
}

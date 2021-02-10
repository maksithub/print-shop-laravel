<?php

namespace App\Providers;

use App\Shop\Carts\Repositories\CartRepository;
use App\Shop\Carts\ShoppingCart;
use App\Shop\Categories\Category;
use App\Shop\Categories\Repositories\CategoryRepository;
use App\Shop\Employees\Employee;
use App\Shop\Employees\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Shop\Products\Product;

/**
 * Class GlobalTemplateServiceProvider
 * @package App\Providers
 * @codeCoverageIgnore
 */
class GlobalTemplateServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'layouts.admin.app',
            'layouts.admin.sidebar',
            'admin.shared.products'
        ], function ($view) {
            $view->with('admin', Auth::guard('employee')->user());
        });

        view()->composer(['layouts.front.navigation.department-menu', 'front.categories.sidebar-category', 'layouts.front.header.navbar-search', 'layouts.front.header.handheld-navigation'], function ($view) {
            $view->with('categories', $this->getCategories());
            $view->with('cartCount', $this->getCartCount());
            $view->with('banners', $this->getCategoryBySlug('banners'));
            $view->with('businesscards', $this->getCategoryBySlug('business-cards'));
            $view->with('flyers', $this->getCategoryBySlug('flyers'));
            $view->with('labels', $this->getCategoryBySlug('labels'));
            $view->with('signs', $this->getCategoryBySlug('signs'));
            $view->with('postcards', $this->getCategoryBySlug('postcards'));
            $view->with('stickers', $this->getCategoryBySlug('stickers'));
        });

        view()->composer(['layouts.front.category-nav'], function ($view) {
            $view->with('categories', $this->getCategories());
        });
    }

    /**
     * Get all the categories
     *
     */
    private function getCategories()
    {
        $categoryRepo = new CategoryRepository(new Category);
        $category_list = $categoryRepo->listCategories('name', 'asc', 1)->whereIn('parent_id', [1]);
        $product_list = Product::doesntHave('categories')->get();
        $ret = $category_list->merge($product_list)->sortBy('name');
        //dd($ret);
        return $ret;

    }

    private function getCategoryBySlug(string $slug)
    {

        $categoryRepo = new CategoryRepository(new category);

        $category = $categoryRepo->findCategoryBySlug(['slug' => $slug]);

        $products = $categoryRepo->findProducts()->where('status', 1)->all();

        // return view('front.categories.category', [
        //     'category' => $category,
        //     'products' => $repo->paginateArrayResults($products, 20)
        // ]);
        return $category;
    }

    /**
     * @return int
     */
    private function getCartCount()
    {
        $cartRepo = new CartRepository(new ShoppingCart);
        return $cartRepo->countItems();
    }

    /**
     * @param Employee $employee
     * @return bool
     */
    private function isAdmin(Employee $employee)
    {
        $employeeRepo = new EmployeeRepository($employee);
        return $employeeRepo->hasRole('admin');
    }
}

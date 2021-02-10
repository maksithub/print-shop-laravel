<?php

namespace App\Http\Controllers\Front;

use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Orders\Order;
use App\Shop\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use App\Shop\Orders\Repositories\OrderRepository;
use App\Shop\OrderStatuses\OrderStatus;
use App\Shop\Orders\Transformers\OrderTransformable;

class AccountsController extends Controller
{
    use OrderTransformable;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepo;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    /**
     * @var CourierRepositoryInterface
     */
    private $courierRepo;

    /**
     * AccountsController constructor.
     *
     * @param CourierRepositoryInterface $courierRepository
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->orderRepo = $orderRepository;
        $this->customerRepo = $customerRepository;
        $this->courierRepo = $courierRepository;
    }

    public function index()
    {
        $customer = $this->customerRepo->findCustomerById(auth()->user()->id);

        $customerRepo = new CustomerRepository($customer);
        $orders = $customerRepo->findOrders(['*'], 'created_at');

        $orders->transform(function (Order $order) {
            return $this->transformOrder($order);
        });
        $order_items = array();
        foreach ($orders as $key => $order) {
            $orderId = $order->id;
            $order = $this->orderRepo->findOrderById($orderId);
            $orderRepo = new OrderRepository($order);
            
            $order_items[$key] = $orderRepo->listOrderedProducts();
        }

        $billing_addresses = $customerRepo->findAddressesByShippingType('billing');
        $shipping_addresses = $customerRepo->findAddressesByShippingType('shipping');

        return view('front.accounts', [
            'customer' => $customer,
            'orders' => $this->customerRepo->paginateArrayResults($orders->toArray(), 15),
            'items' => $order_items,
            'billing_addresses' => $billing_addresses,
            'shipping_addresses' => $shipping_addresses
        ]);
    }
}

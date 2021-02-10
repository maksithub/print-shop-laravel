<?php

namespace App\Mail;

use App\Shop\Addresses\Transformations\AddressTransformable;
use App\Shop\Orders\Order;
use App\Shop\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use App\Shop\Orders\Repositories\OrderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmailNotificationToAdminMailable extends Mailable
{
    use Queueable, SerializesModels, AddressTransformable;

    public $order;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepo;

    /**
     * Create a new message instance.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderRepo = new OrderRepository($this->order);

        $product_items = $orderRepo->listOrderedProducts();
        $data = [
            'order' => $this->order,
            'products' => $product_items,
            'customer' => $this->order->customer,
            'courier' => $this->order->courier,
            'address' => $this->order->address,
            'status' => $this->order->orderStatus,
            'payment' => $this->order->paymentMethod
        ];

        return $this->view('emails.admin.OrderNotificationEmail', $data);
    }
}

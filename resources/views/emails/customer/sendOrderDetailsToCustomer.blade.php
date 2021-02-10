<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        table {
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
          border: 1px solid #ddd;
          margin-bottom:20px;
        }

        th, td {
          text-align: left;
          padding: 16px;
        }
        section{
            margin-bottom: 20px;
        }
        section.text-center{text-align: center;}
        section.footer{
            background:#00abc5;
            padding: 10px;
            color: #fff;
        }
        section.footer a{
            color: #fff;
        }
    </style>
</head>
<body>
<section style="padding:10px;background-color:#00abc5;">
    <h1>Thank you for your order</h1>
</section>
<section class="row">
    <div class="pull-left">
        <p>Your order(#{{$order->id}}) has been received and is now being processed. Your order details are shown below for your reference:</p>
    </div>
</section>
<section class="row">
    <div class="col-md-12">
        <h2>Order Details:</h2>
        <table class="table table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->pivot->quantity}}</td>
                    <td>{{number_format($product->price * $product->pivot->quantity, 2)}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td>Subtotal:</td>
                <td>{{$order->total_products}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Discounts:</td>
                <td>{{$order->discounts}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tax:</td>
                <td>{{$order->tax}}</td>
            </tr>
            <tr>
                <td></td>
                <td><strong>Total:</strong></td>
                <td><strong>{{$order->total}}</strong></td>
            </tr>
            </tfoot>
        </table>
    </div>
</section>
<section>
    <div><h2>Customer Details</h2></div>
    <div class="section_body">
        <p>Name: {{$customer->name}}</p>
        <p>Email: {{$customer->email}}</p>
    </div>
</section>
@if($order->payment == 'bank transfer')
<section>
    <h2>Bank Details</h2>
    <div>Please call us (01) 323 876 3500 to get the bank details.</div>
</section>
@endif
</body>
</html>
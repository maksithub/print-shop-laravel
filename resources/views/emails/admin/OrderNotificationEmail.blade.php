<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
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
<section class="row">
    <div class="pull-left">
        An order has been created by {{$customer->name}}({{$customer->email}})!
    </div>
</section>
<section class="row">
    <div class="col-md-12">
        <h2>Here are the details of the order</h2>
        <table class="table table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->sku}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
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
</body>
</html>
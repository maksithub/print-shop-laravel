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
        }
        table td, table th{
            border: 1px solid #000;
            padding: 5px;
        }
    </style>
</head>
<body>
    <section class="row">
        <div class="pull-left">
            Invoice to: {{$customer->name}} <br />
            Deliver to: <strong>{{ $address->alias }} <br /></strong>
            {{ $address->address_1 }} {{ $address->address_2 }} <br />
            {{ $address->city }}{{ $address->state_code }} <br />
            {{ $address->country }} {{ $address->zip }} <br />
        </div>
        <div class="pull-right">
            <p>From: {{config('app.name')}}</p>
        </div>
    </section>
    <section class="row">
        <div class="col-md-12">
            <h2>Details</h2>
            <table class="table table-striped" width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->sku}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border:0;"></td>
                        <td>Subtotal:</td>
                        <td>{{$order->total_products}}</td>
                    </tr>
                    <tr>
                        <td style="border:0;"></td>
                        <td>Discounts:</td>
                        <td>{{$order->discounts}}</td>
                    </tr>
                    <tr>
                        <td style="border:0;"></td>
                        <td>Tax:</td>
                        <td>{{$order->tax}}</td>
                    </tr>
                    <tr>
                        <td style="border:0;"></td>
                        <td><strong>Total:</strong></td>
                        <td><strong>{{$order->total}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
</body>
</html>
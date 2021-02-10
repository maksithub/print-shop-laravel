<div class="row billing_address">
    <div class="col-md-12">
        <h4 style="display: inline-block;margin-right: 20px;">Billing address</h4>
        @if(sizeof($billing_addresses)==0)
        <a href="{{ route('customer.address.create', [auth()->user()->id, 'addressType=billing']) }}" class="btn btn-primary">Create your billing address</a>
        @endif
    </div>

@if(sizeof($billing_addresses)>0)
    <table class="table address-table">
    <thead>
        <th>Alias</th>
        <th>Address 1</th>
        <th>Address 2</th>
        <th>City</th>
        @if(isset($billing_addresses->province))
        <th>Province</th>
        @endif
        <th>State</th>
        <th>Country</th>
        <th>Zip</th>
        <th>Phone</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach($billing_addresses as $address)
            <tr>
                <td>{{$address->alias}}</td>
                <td>{{$address->address_1}}</td>
                <td>{{$address->address_2}}</td>
                <td>{{$address->city}}</td>
                @if(isset($address->province))
                <td>{{$address->province->name}}</td>
                @endif
                <td>{{$address->state_code}}</td>
                <td>{{$address->country->name}}</td>
                <td>{{$address->zip}}</td>
                <td>{{$address->phone}}</td>
                <td>
                    <form method="post" action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}" class="form-horizontal">
                        <div class="btn-group">
                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}
                            <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}" class="btn btn-primary"> <i class="fa fa-pencil"></i> Edit</a>
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
</div><!-- endrow -->
<hr>
<div class="row shipping_address">
    <div class="col-md-12">
        <h4 style="display: inline-block;margin-right: 20px;">Shipping address</h4>
        @if(sizeof($shipping_addresses)==0)
        <a href="{{ route('customer.address.create', [auth()->user()->id, 'addressType=shipping']) }}" class="btn btn-primary">Create your shipping address</a>
        @endif
    </div>

    @if(sizeof($shipping_addresses)>0)
        <table class="table address-table">
        <thead>
            <th>Alias</th>
            <th>Address 1</th>
            <th>Address 2</th>
            <th>City</th>
            @if(isset($shipping_addresses->province))
            <th>Province</th>
            @endif
            <th>State</th>
            <th>Country</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($shipping_addresses as $address)
                <tr>
                    <td>{{$address->alias}}</td>
                    <td>{{$address->address_1}}</td>
                    <td>{{$address->address_2}}</td>
                    <td>{{$address->city}}</td>
                    @if(isset($address->province))
                    <td>{{$address->province->name}}</td>
                    @endif
                    <td>{{$address->state_code}}</td>
                    <td>{{$address->country->name}}</td>
                    <td>{{$address->zip}}</td>
                    <td>{{$address->phone}}</td>
                    <td>
                        <form method="post" action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}" class="form-horizontal">
                            <div class="btn-group">
                                <input type="hidden" name="_method" value="delete">
                                {{ csrf_field() }}
                                <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}" class="btn btn-primary"> <i class="fa fa-pencil"></i> Edit</a>
                                <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
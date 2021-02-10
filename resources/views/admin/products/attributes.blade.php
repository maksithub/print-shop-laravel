@if(!$productAttributes->isEmpty())
    <h2>Product Attribute List</h2>

            <table class="attributeTable">
                <thead>
                    <tr>
                        <td>Attribute name</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($attributes as $attribute)
                    <tr>
                        <td>
                            <a href="{{ route('admin.products.attributes.show', [$productID, $attribute->id]) }}">{{ $attribute->name }} <strong>({{ $attribute->values->count() }})</strong></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.products.attributes.destroy', [$productID, $attribute->id]) }}" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                
                                <div class="btn-group">
                                    <a href="{{ route('admin.products.attributes.values.create', [$productID, $attribute->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-plus" target="_blank"></i> Add values</a>
                                    <a href="{{ route('admin.products.attributes.edit', [$productID, $attribute->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>

    <div class="box-footer">
        <div class="btn-group">
            <a class="btn btn-sm btn-primary" href="{{ route('admin.products.attributes.create', $productID) }}"><i class="fa fa-plus"></i> Create attribute</a>
        </div>
    </div>

@endif
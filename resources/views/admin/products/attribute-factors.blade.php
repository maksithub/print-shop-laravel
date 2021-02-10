<h2>Attribute Factors</h2>
<form action="{{route('admin.products.updateProductAttribute', $productID)}}" method="post" class="form">
    {{ csrf_field() }}
<div class="form-group">
    <ul class="list-unstyled attribute-lists">
        @foreach($attributes as $attribute)
            <li>
                <label for="attribute{{ $attribute->id }}" class="checkbox-inline">
                    {{ $attribute->name }}
                </label>

                <label for="attributeValue{{ $attribute->id }}" style="display: none; visibility: hidden"></label>
                @if(!$attribute->values->isEmpty())
                <table id="attribute{{ $attribute->id }}" class="attributeTable">
                    @foreach($attribute->values as $attr)
                    <tr>
                    <td><label for="attributeValueFactor{{$attr->id}}">{{ $attr->value }}</label></td>
                    <td>
                    <input type="text" name="attributeValueFactor[{{$attr->id}}]" id="attributeValueFactor{{$attr->id}}" value="{{ $attr->default == 1 ? '1' : $attr->factor }}"></td>
                    </tr>
                    @endforeach
                </table>

                @endif
            </li>
        @endforeach
    </ul>
</div>

<div class="box-footer">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-default" onclick="backToInfoTab()">Back</button>
        <button id="createCombinationBtn" type="submit" class="btn btn-sm btn-primary">Save Factors</button>
    </div>
</div>
</form>
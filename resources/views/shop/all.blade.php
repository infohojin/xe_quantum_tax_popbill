<h1>Quantum Shop</h1>

<a href="/quantum/shop/tax">전체발행내역</a>
<br/><br/><br/><br/>

<table>
    @foreach($shop as $item)
    <tr>

        <td>
            <a href='/quantum/shop/{{$item->shop_id}}/tax'>{{$item->shop_name}}</a>
        </td>
        <td>
            {{$item->business_id}}
        </td>
    </tr>
    @endforeach
</table>

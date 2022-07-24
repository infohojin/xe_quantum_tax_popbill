<h1>Desginer</h1>

<a href="/quantum/shop/tax">전체발행내역</a>
<br/><br/><br/><br/>

<table>
    @foreach($designer as $item)
    <tr>

        <td>
            <a href='/quantum/desginer/{{$item->user_id}}/tax'>{{$item->display_name}}</a>
        </td>

    </tr>
    @endforeach
</table>

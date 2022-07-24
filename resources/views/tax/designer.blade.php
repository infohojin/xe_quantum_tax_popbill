<h1>designers Tax</h1>

<table>
    <thead>
        <tr>
            <th>작성일자</th>
            <th>문서번호</th>
            <th>공급자</th>
            <th>받는자</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trans as $item)
        <tr>
            <td>
                {{$item->write_date}}
            </td>
            <td>
                {{$item->invoicer_mgt_key}}
            </td>
            <td>
                {{$item->invoicer_corp_num}}
            </td>
            <td>
                {{$item->invoicee_corp_name}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<table id="tax-products" class="">
    <thead>
    <tr>
        <th class="p-1w-8">월</th>
        <th class="p-1w-8">일</th>
        <th class="p-1">품목</th>
        <th class="p-1">규격</th>
        <th class="p-1">수량</th>
        <th class="p-1">단가</th>
        <th class="p-1">공급가액</th>
        <th class="p-1">세액</th>
        <th class="p-1">비고</th>
        <th class="p-1">
            <button type="button" id="btn-product-add"
            class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-700 hover:border-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-50 active:bg-gray-500 active:border-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                  </svg>
            </button>
        </th>
    </tr>
    </thead>
    <tbody>

        @foreach($products as $item)
        <tr>
            @php
                $month = substr($item->purchase_dt,4,2);
                $day = substr($item->purchase_dt,6,2);
            @endphp

            <input type="hidden" name="products[id][]" value="{{ old('pid', $item->id) }}">


            <td class="p-1 w-8">
                <input type="text" name="products[purchase_month][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('purchase_month', $month) }}">
            </td>
            <td class="p-1 w-8">
                <input type="text" name="products[purchase_day][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('purchase_day', $day) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[item_name][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('item_name', $item->item_name) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[spec][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('spec', $item->spec) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[qty][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('qty', $item->qty) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[unit_cost][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('unit_cost', $item->unit_cost) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[supply_cost][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('supply_cost', $item->supply_cost) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[tax][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('tax', $item->tax) }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[remark][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('remark', $item->remark) }}">
            </td>

        </tr>
        @endforeach

        <tr>
            <input type="hidden" name="products[id][]" value="{{ old('pid', '') }}">
            <td class="p-1 w-8">
                <input type="text" name="products[purchase_month][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('purchase_month', '') }}">
            </td>
            <td class="p-1 w-8">
                <input type="text" name="products[purchase_day][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('purchase_day', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[item_name][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('item_name', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[spec][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('spec', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[qty][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('qty', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[unit_cost][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('unit_cost', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[supply_cost][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('supply_cost', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[tax][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('tax', '') }}">
            </td>
            <td class="p-1">
                <input type="text" name="products[remark][]"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('remark', '') }}">
            </td>
            <td class="p-1">
                <button type="button" id="btn-product-del"
                class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none text-sm border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-700 hover:border-red-700 focus:ring focus:ring-red-300 focus:ring-opacity-50 active:bg-red-500 active:border-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </td>
        </tr>



    </tbody>
</table>



<script>
    document.addEventListener("DOMContentLoaded", function(){
        let btn_product_add = document.querySelector('#btn-product-add');
        btn_product_add.addEventListener('click', function(){

            let tbody = document.querySelector('table#tax-products tbody');
            let product = tbody.querySelector('tr').cloneNode(true);

            product.querySelectorAll('input').forEach(el => {
                el.value = "";
            });

            product.querySelector('#btn-product-del').addEventListener('click',function(){
                this.parentElement.parentElement.remove();
            });

            tbody.appendChild(product);

        });
    });
</script>

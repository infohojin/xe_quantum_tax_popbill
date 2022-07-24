<div class="flex">
    <div class="w-32">
        <div class="p-1">
            <span>작성일자</span>
            <button type="button" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
        <div class="p-1">
            <input type="text" name="write_date"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('write_date', $info->write_date) }}">
        </div>
    </div>
    <div class="flex-grow">
        <div class="p-1">공급가액</div>
        <div class="p-1">
            <input type="text" name="supply_cost_total"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('supply_cost_total', $info->supply_cost_total) }}">
        </div>
    </div>
    <div class="flex-grow">
        <div class="p-1">세액</div>
        <div class="p-1">
            <input type="text" name="tax_total"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('tax_total', $info->tax_total) }}">
        </div>
    </div>
</div>

<div class="flex">
    <div class="w-32 p-1">
        비고1
    </div>
    <div class="flex-grow p-1">
        <input type="text" name="remark1"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('remark1', $info->remark1) }}">
    </div>
</div>

<div class="flex">
    <div class="w-32 p-1">
        비고2
    </div>
    <div class="flex-grow p-1">
        <input type="text" name="remark2"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('remark2', $info->remark2) }}">
    </div>
</div>

<div class="flex">
    <div class="w-32 p-1">
        비고3
    </div>
    <div class="flex-grow p-1">
        <input type="text" name="remark3"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('remark3', $info->remark3) }}">
    </div>
</div>



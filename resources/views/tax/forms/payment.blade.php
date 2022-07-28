<div class="flex">
    <div>
        <div class="p-1">합계정보</div>
        <div class="p-1">
            <input type="text" name="total_amount"
        class="text-sm border border-stone-400 p-0.5 w-full"
        value="{{ old('total_amount', $info->total_amount) }}">
        </div>
    </div>
    <div>
        <div class="p-1">현금</div>
        <div class="p-1">
            <input type="text" name="cash"
        class="text-sm border border-stone-400 p-0.5 w-full"
        value="{{ old('cash', $info->cash) }}">
        </div>
    </div>
    <div>
        <div class="p-1">수표</div>
        <div class="p-1">
            <input type="text" name="chk_bill"
        class="text-sm border border-stone-400 p-0.5 w-full"
        value="{{ old('chk_bill', $info->chk_bill) }}">
        </div>
    </div>
    <div>
        <div class="p-1">어음</div>
        <div class="p-1">
            <input type="text" name="note"
        class="text-sm border border-stone-400 p-0.5 w-full"
        value="{{ old('note', $info->note) }}">
        </div>
    </div>

    <div>
        <div class="p-1">외상미수금</div>
        <div class="p-1">
            <input type="text" name="credit"
        class="text-sm border border-stone-400 p-0.5 w-full"
        value="{{ old('credit', $info->credit) }}">
        </div>
    </div>

    <div class="flex-grow p-1">
          <!-- Radios Stacked -->
        <div class="flex flex-col justify-center items-center space-y-2">
            <div class="font-medium">이금액을</div>
            <div class="mt-2">
                <label class="inline-flex items-center">
                  <input type="radio"
                  class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio1"
                  name="purpose_type" value="영수">
                  <span class="ml-2">영수</span>
                </label>
                <label class="inline-flex items-center ml-6">
                  <input type="radio"
                  class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2"
                  name="purpose_type"  value="청구" checked>
                  <span class="ml-2">청구</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio"
                    class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2"
                    name="purpose_type" value="없음">
                    <span class="ml-2">없음</span>
                  </label>
            </div>
            <div class="font-medium">함</div>
        </div>
        <!-- END Radios Stacked -->

    </div>
</div>

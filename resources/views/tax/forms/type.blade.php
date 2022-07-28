<div class="flex justify-between">
    <div class="flex">
        <div class="w-32">
            과세형태
        </div>
        <div class="flex-grow">
            <div>
                <label class="inline-flex items-center">
                  <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio1"
                  name="tax_type" value="과세" checked>
                  <span class="ml-2">과세(10%)</span>
                </label>
                <label class="inline-flex items-center ml-6">
                  <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2"
                  name="tax_type" value="영세" >
                  <span class="ml-2">영세(0%)</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2"
                    name="tax_type" value="면세" >
                    <span class="ml-2">면세(세액없음)</span>
                  </label>
            </div>
        </div>
    </div>

    <div class="flex">
        <div class="w-32">
            거래처유형
        </div>
        <div class="flex-grow">
            <div>
                <label class="inline-flex items-center">
                  <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio1"
                  name="invoicee_type" value="사업자" checked>
                  <span class="ml-2">사업자</span>
                </label>
                <label class="inline-flex items-center ml-6">
                  <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2"
                  name="invoicee_type" value="개인" >
                  <span class="ml-2">개인</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" class="border border-gray-200 h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="radio2"
                    name="invoicee_type" value="외국인" >
                    <span class="ml-2">외국인</span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="flex mb-2">
    <div class="flex-grow">
        <div class="flex mr-2">
            <div class="w-20 mr-2 text-sm">등록번호</div>
            <div class="flex-grow">
                <input type="text" name="invoicee_corp_num"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('invoicee_corp_num', $info->invoicee_corp_num) }}">
            </div>
            <div class="ml-2">
                <button type="button" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="w-1/3">
        <div class="flex">
            <div class="w-20 text-sm">종사업장</div>
            <div class="flex-grow">
                <input type="text" name="invoicee_tax_reg_id"
                    class="text-sm border border-stone-400 p-0.5 w-full"
                    value="{{ old('invoicee_tax_reg_id', $info->invoicee_tax_reg_id) }}">
            </div>
        </div>
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">상호</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_corp_name"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_corp_name', $info->invoicee_corp_name) }}">
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">대표자</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_ceo_name"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_ceo_name', $info->invoicee_ceo_name) }}">
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">사업장 주소</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_addr"
            class="text-sm border border-stone-400 p-0.5 w-full"
            value="{{ old('invoicee_addr', $info->invoicee_addr) }}">
    </div>
    <div class="ml-2">
        <button type="button" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm border-gray-700 bg-gray-700 text-white hover:text-white hover:bg-gray-800 hover:border-gray-800 focus:ring focus:ring-gray-500 focus:ring-opacity-50 active:bg-gray-700 active:border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">업태</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_biz_class"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_biz_class', $info->invoicee_biz_class) }}">
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">업종</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_biz_type"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_biz_type', $info->invoicee_biz_type) }}">
    </div>
</div>

<hr class="mb-2">

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">담당자</div>
    <div class="">
        <input type="text" name="invoicee_contact_name1"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_contact_name1', $info->invoicee_contact_name1) }}">
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">이메일</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_email1"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_email1', $info->invoicee_email1) }}">
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">연락처</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_tel1"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_tel1', $info->invoicee_tel1) }}">
    </div>
</div>

<div class="flex mb-2">
    <div class="w-20 mr-2 text-sm">핸드폰</div>
    <div class="flex-grow">
        <input type="text" name="invoicee_hp1"
            class="text-sm border border-stone-400 p-0.5"
            value="{{ old('invoicee_hp1', $info->invoicee_hp1) }}">
    </div>
</div>



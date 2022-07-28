<form onsubmit="return false;" class="space-y-6">
    <div class="space-y-1 md:space-y-0 md:flex md:items-center">
      <label for="month" class="font-medium md:w-1/3 flex-none md:mr-2">발행월</label>
      <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
      type="text" id="month" name="month" placeholder="요일 선택">
    </div>
    <div class="space-y-1 md:space-y-0 md:flex md:items-center">
        <label for="seller" class="font-medium md:w-1/3 flex-none md:mr-2">공급자</label>
        <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
        type="text" id="seller" name="seller" placeholder="공급자">
    </div>
    <div class="space-y-1 md:space-y-0 md:flex md:items-center">
        <label for="buyer" class="font-medium md:w-1/3 flex-none md:mr-2">공급받는자</label>
        <input class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
        type="text" id="buyer" name="buyer" placeholder="공급받는자">
    </div>

    <div class="md:w-2/3 ml-auto">
      <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-2 px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
        검색
      </button>
    </div>
</form>

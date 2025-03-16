@if(session()->has('success'))
    <div x-data = "{show: true}"
         x-init="setTimeout(() => show= false, 5000)"
         x-show="show"
         class="fixed bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md rounded-xl right-3 bottom-3" role="alert">
        <div class="flex">
            <div>
                <p class="font-bold">{{session('success')}}</p>
            </div>
        </div>
    </div>
@endif

@if(session()->has('error'))
    <div x-data = "{show: true}"
         x-init="setTimeout(() => show= false, 5000)"
         x-show="show"
         class="fixed bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md rounded-xl right-3 bottom-3" role="alert">
        <div class="flex">
            <div>
                <p class="font-bold">{{session('error')}}</p>
            </div>
        </div>
    </div>
@endif

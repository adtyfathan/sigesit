@if (session()->has('message'))
    <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-md text-center" role="alert">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md text-center" role="alert">
        {{ session('error') }}
    </div>
@endif
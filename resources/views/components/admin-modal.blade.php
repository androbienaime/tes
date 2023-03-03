<div x-data="{ open: true }" class="absolute inset-0 flex items-center justify-center">
    <div x-transition x-show="open === true" class="flex justify-center items-center p-5 fixed inset-0 bg-black bg-opacity-50 z-50">
        <div @click.outside="open = false" class="flex flex-col relative max-w-2xl w-full rounded-lg shadow-lg p-12 bg-white">
{{--            <h1 class="text-3xl font-semibold text-slate-900 text-green-700">Confirm</h1>--}}
            <p class="mt-2 text-slate-700">
                <h1 class="text-3xl text-green-600 font-semibold text-center">{{ $slot }}</h1>
            </p>
            <div class="mt-4 flex space-x-5">
                <button @click="open = false" class="text-sm bg-blue-500 bg-opacity-25 text-blue-500 p-2 rounded-sm shadow-sm">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

@props(["icon_class", "title", "qty"])

<div class="p-5 bg-white rounded shadow-sm">
    <div class="flex items-center space-x-4">
        <div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-600 text-white">
                <i width="32" class="{{ $icon_class }}"></i>
            </div>
        </div>
        <div>
            <div class="text-gray-400">{{ $title }}</div>
            <div class="text-2xl font-bold text-gray-900"> {{ $qty }}</div>
        </div>
    </div>
</div>

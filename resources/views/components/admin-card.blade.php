@props(["icon_class", "title", "qty", "sub_title"=>''])

<div {!! $attributes->merge(["class" => "p-5 bg-white rounded shadow-sm" ]) !!}>
    <div class="flex items-center space-x-4">
        <div>
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-600 text-white">
                <i width="32" class="{{ $icon_class }}"></i>
            </div>
        </div>
        <div>
            <div class="text-gray-400">
                {{ $title }}
                @if($sub_title)
                    <div class="text-[10px]">{{ $sub_title }}</div>
                @endif
            </div>
            <div class="text-2xl font-bold text-gray-900"> {{ $qty }}</div>
        </div>
    </div>
</div>

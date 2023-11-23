<div {!! $attributes->merge(["class" => "bg-white border-t-2 text-md font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700"]) !!}>
    <ul class="flex flex-wrap -mb-px">
        {{ $slot }}
    </ul>
</div>

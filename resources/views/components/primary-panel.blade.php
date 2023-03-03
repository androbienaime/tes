@props(['title', 'cs'])

<!-- Panel -->
<div class="max-w-7xl mb-2 border-solid border-grey-light rounded border shadow-sm m-5 ">
    <div class="bg-white px-2 py-3 text-gray-700 border border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
      @if($title)
            <span class='text-md'><i class='{{ $cs }}'></i> {{ $title }}</span>
        @endif
    </div>
    <div class="p-3 bg-white">
        {{ $slot }}
    </div>
</div>

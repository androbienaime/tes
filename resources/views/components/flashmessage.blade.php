@props(['status'])

@if ($status)

    <div class="max-w-7xl  mb-2 m-5 border text-green-700 bg-green-200 px-1 py-2 rounded">
        {{ $status }}
    </div>
@endif

@props([
    "td_head" => [],
])
<table {!! $attributes->merge(['class'=> "min-w-full bg-white"]) !!}>
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            @foreach($td_head as $th)
                <th scope="col" class="text-center py-3 px-3 uppercase font-semibold text-sm @if($th == 'Action') no-print @endif ">{{ $th }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        {{ $slot }}
    </tbody>
</table>

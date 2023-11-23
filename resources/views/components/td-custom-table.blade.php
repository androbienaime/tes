@props(['align' => 'center'])

@php
    switch ($align){
        case 'left':
            $alignementClass = "text-left";
            break;
        case 'center':
            $alignementClass = "text-center";
            break;
        case 'right':
            $alignementClass = "text-right";
            break;
        default:
            $alignementClass = "text-center";
            break;
    }
@endphp
<td {!! $attributes->merge(['class' => "uppercase border-b w-1/3 py-2 px-2 border-r $alignementClass "]) !!}>
    {{ $slot}}
</td>

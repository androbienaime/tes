@props(['value', 'required'])

<label {{ $attributes->merge(
        [
            'class'=> "block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
        ])
        }}
> {{ $value ?? $slot }}
    @isset($required) @if($required == 'true') <span class="text-red-600"> *</span>@endif @endisset
</label>

@props(['value', 'required'])

<label {{ $attributes->merge(
        [
            'class'=> "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        ])
        }}
> {{ $value ?? $slot }}
    @isset($required) @if($required == 'true') <span class="text-red-600"> *</span>@endif @endisset
</label>

@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#FF9D00]']) }}>
    {{ $value ?? $slot }}
</label>

@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[0.125rem] border-[#FF9D00] focus:border-[#8b4f17] focus:ring-[#8b4f17] rounded-md shadow-sm' ]) }}>

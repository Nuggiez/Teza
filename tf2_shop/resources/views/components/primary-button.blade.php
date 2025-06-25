<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#FF9D00] border border-transparent  font-semibold text-white uppercase tracking-widest hover:bg-[#8b4f17] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center text-2xl']) }}>
    {{ $slot }}
</button>

<x-app-layout>
    <div class="px-4 py-2 ">
        <h1 class="text-3xl font-bold mb-6 text-center">Categories Available</h1>
        <div class="grid grid-cols-3 lg:flex lg:flex-row gap-[1rem] mx-auto w-max justify-items-center">
            @foreach ($categories as $category)
                <a href="{{ url('/categories/' . $category->id) }}">
                    <div class="w-24 h-24 bg-cover bg-[#a9661b]  border border-[var(--color-border)] transition-all duration-300 ease-in hover:bg-[#8b4f17] flex flex-col items-center justify-center"
                        style="background-image: url('{{ asset('uploads/category/' . $category->image) }}')">
                        <span
                            class="bg-black bg-opacity-60 text-white text-center w-full block mt-[4rem] py-1">{{ $category->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="grid grid-cols-3 lg:flex lg:flex-row gap-[1rem] mx-auto w-max justify-items-center">
        @foreach($categories as $category)
            <a href="{{ url('frontend/category/' . $category->id) }}">
                <div class="w-24 h-24 bg-cover bg-[#a9661b] rounded-xl border border-white transition-all duration-300 ease-in hover:bg-[#8b4f17] flex flex-col items-center justify-center"
                    style="background-image: url('{{ asset('uploads/category/' . $category->image) }}')">
                    <span class="bg-black bg-opacity-60 text-white text-center w-full block mt-20 py-1 rounded-b-xl">{{ $category->name }}</span>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
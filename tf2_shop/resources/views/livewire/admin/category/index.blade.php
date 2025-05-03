<div>
    <table class="w-full border-[var(--color-border)] border-[0.25rem]">
        <thead>
            <tr>
                <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Id</th>
                <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Name</th>
                <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Image</th>
                <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Description</th>
                <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2 text-center ">{{ $category->id }}</td>
                    <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">{{ $category->name }}</td>
                    <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2 "><img src="{{ asset('uploads/category/' . $category->image) }}" class="h-20" /></td>
                    <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">{{ $category->description }}</td>
                    <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">
                        <a href="{{ url('admin/category/edit/' . $category->id) }}">Edit</a>
                        <a href="">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $categories->links() }}
    </div>
</div>

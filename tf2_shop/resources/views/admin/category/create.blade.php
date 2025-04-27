<x-app-layout>
    <form action="{{url("admin/category")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div>
            <label>description</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div>
            <label>image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    </x-app-layout>
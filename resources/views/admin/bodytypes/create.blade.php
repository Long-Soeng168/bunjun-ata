@extends('admin.layouts.admin')

@section('content')
<div class="p-4">
    <x-form-header :value="__('Create Body Type')" />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="w-full" action="{{ route('admin.bodytypes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6">
            <div>
                <x-input-label for="name" :value="__('Name')" /><span class="text-red-500">*</span>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="name_kh" :value="__('Name Kh')" /><span class="text-red-500">*</span>
                <x-text-input id="name_kh" class="block mt-1 w-full" type="text" name="name_kh" :value="old('name_kh')" required autofocus placeholder="Name in Khmer" />
                <x-input-error :messages="$errors->get('name_kh')" class="mt-2" />
            </div>
        </div>

        <div class="my-4 mb-6">
            <div class="flex items-center space-4">
                <div class="max-w-40">
                    <img id="selected-image" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Selected Image" class="hidden max-w-full max-h-40 pr-4" />
                </div>
                <div class="flex-1">
                    <x-input-label for="image" :value="__('Upload Image (max : 2MB)')" />
                    <x-file-input id="image" name="image" accept="image/png, image/jpeg, image/gif" onchange="displaySelectedImage(event)" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>
        </div>

        <div>
            <x-outline-button href="{{ URL::previous() }}">
                Go back
            </x-outline-button>
            <x-submit-button>
                Submit
            </x-submit-button>
        </div>
    </form>
</div>

<script>
    function displaySelectedImage(event) {
        const fileInput = event.target;
        const file = fileInput.files[0];
        const imgElement = document.getElementById('selected-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result;
                imgElement.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imgElement.src = "{{ asset('assets/images/placeholder.jpg') }}";
            imgElement.classList.add('hidden');
        }
    }
</script>
@endsection

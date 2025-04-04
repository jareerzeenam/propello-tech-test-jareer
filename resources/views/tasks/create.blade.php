@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="pb-4">
                    <x-forms.input-label for="name" :value="__('Name')" />
                    <x-forms.text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-forms.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <h1 class="text-xl font-bold py-2">Tags</h1>
                <div class="grid grid-cols-4 gap-4 py-4">
                    @foreach($tags as $tag)
                        <div class="flex items-center space-x-2">
                            <x-forms.checkbox-input id="tag-{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" />
                            <x-forms.input-label for="tag-{{ $tag->id }}" :value="$tag->name" />
                        </div>
                    @endforeach
                </div>

                <x-elements.primary-button>
                    Create
                </x-elements.primary-button>
            </form>
        </div>
    </div>
@endsection

@props([
    'tag'  => null,
])

<div class="w-full flex py-2 border-b border-gray-100">
    <div class="w-5/12 flex items-center">{{ $tag?->name }}</div>
    <div class="w-2/12 flex items-center">{{ $tag?->created_at->format('jS M Y') }}</div>
    <div class="w-5/12 flex flex-wrap">
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tags.edit', ['tag' => $tag]) }}">
            Edit
        </x-elements.link-button>

        <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="post">
            @csrf
            @method('delete')

            <button x-data x-on:click="$dispatch('show-modal{{$tag->id}}')" type="button" class="bg-red-500 text-white px-4 py-2 rounded">
                Delete
            </button>

            <x-modals.delete-modal :id="$tag->id" />

        </form>

    </div>
</div>

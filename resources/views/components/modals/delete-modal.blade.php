@props([
    'id' => null,
])

<div
    x-data="{show:false, id: '{{ $id }}'}"
    x-show="show"
    x-on:show-modal{{$id}}.window = "show = true"
    x-on:close-modal{{$id}}.window = "show = false"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg p-6 shadow-lg w-1/3">
        <h2 class="text-lg font-semibold">Are you sure?</h2>
        <p class="text-gray-600">This action cannot be undone.</p>

        <div class="flex justify-end space-x-4 mt-4">
            <button type="button"
                    x-on:click="$dispatch('close-modal{{$id}}')"
                    class="px-4 py-2 bg-gray-300 rounded">
                Cancel
            </button>

            <x-forms.danger-button class="mt-1">
                Delete
            </x-forms.danger-button>
        </div>
    </div>
</div>

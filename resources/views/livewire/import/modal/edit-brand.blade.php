<div>
    <div class="bg-white divide-y divide-gray-200">
        <div class="flex items-center justify-between px-5 py-4 bg-white">
            <div class="flex items-center space-x-4">
                <p class="text-xl font-semibold text-gray-800">
                    Edit Nama Brand {{ $category->categories }}
                </p>
            </div>
            <button class="text-gray-400 hover:text-gray-600" wire:click="$emit('closeModal')">
                <svg class="w-4 transition duration-150 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512.001 512.001">
                    <path
                        d="M284.286 256.002L506.143 34.144c7.811-7.811 7.811-20.475 0-28.285-7.811-7.81-20.475-7.811-28.285 0L256 227.717 34.143 5.859c-7.811-7.811-20.475-7.811-28.285 0-7.81 7.811-7.811 20.475 0 28.285l221.857 221.857L5.858 477.859c-7.811 7.811-7.811 20.475 0 28.285a19.938 19.938 0 0014.143 5.857 19.94 19.94 0 0014.143-5.857L256 284.287l221.857 221.857c3.905 3.905 9.024 5.857 14.143 5.857s10.237-1.952 14.143-5.857c7.811-7.811 7.811-20.475 0-28.285L284.286 256.002z" />
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-12 gap-4 p-8">
            <div class="col-span-12 md:col-span-8">
                <p class="text-sm font-semibold">Brand Baru : </p>
                <input type="text" class="form-input" wire:model="category_name">
                @error('category_name') <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>
    <div class="flex justify-end px-4 py-3 space-x-4 bg-gray-50">
        <button wire:click.prevent="editBrand({{ $category->id }})"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm sm:mt-0">
            Update
        </button>
        <button type="button" wire:click.prevent="$emit('closeModal')"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Kembali
        </button>
    </div>
</div>

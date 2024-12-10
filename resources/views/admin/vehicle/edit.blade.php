<x-adminlayout.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Vehicle Information') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <form action="{{ route('vehicle.update', ['vehicle' => $vehicle->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Vehicle Name -->
                    <div class="mb-4">
                        <label for="name"
                            class="block text-sm font-medium text-gray-700">{{ __('Vehicle Name') }}</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2"
                            value="{{ old('name', $vehicle->name) }}" placeholder="{{ __('Enter vehicle name') }}">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Vehicle Description -->
                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <input type="text" name="description" id="description" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2"
                            value="{{ old('description', $vehicle->description) }}"
                            placeholder="{{ __('Enter description') }}">
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Vehicle Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                        <input type="number" name="price" id="price" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2"
                            value="{{ old('price', $vehicle->price) }}" placeholder="{{ __('Enter price') }}"
                            step="0.01">
                        @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Vehicle Picture -->
                    <div class="mb-4">
                        <label for="picture" class="block text-sm font-medium text-gray-700">{{ __('Picture') }}</label>
                        <input type="file" name="picture" id="picture" accept="image/*"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 p-2">

                        @if(isset($vehicle->picture))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $vehicle->picture) }}" alt="Vehicle Image"
                                class="w-32 h-32 object-cover rounded-md">
                        </div>
                        @endif

                        @error('picture')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">
                            {{ __('Update Vehicle') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-adminlayout.app>
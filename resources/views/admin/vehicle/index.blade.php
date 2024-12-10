<x-adminlayout.app>

    <div class="container py-6">
        <!-- Add Equipment Button -->
        <a href="{{ route('vehicle.create') }}" class="btn btn-success mb-4">
            {{ __('Add Vehicle') }}
        </a>

        <!-- Success Message -->
        @if(session('success'))
        <!-- Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong class="font-bold">Success!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // Automatically show the modal when the page loads if the success message exists
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        </script>
        @endif


        <!-- Row for Vehicles -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
            @forelse ($vehicles as $item)
            <div class="col mb-4">
                <!-- Vehicle Card -->
                <div class="card h-100 shadow-sm">
                    <!-- Vehicle Image (Use 100x100 placeholder if no image) -->
                    <img src="{{ $item->picture ? Storage::url($item->picture) : 'https://via.placeholder.com/100x100' }}"
                        class="card-img-top" alt="{{ $item->name }}">

                    <div class="card-body">
                        <!-- Name -->
                        <p><strong class="font-weight-bold">Name:</strong> {{ $item->name }}</p>

                        <!-- Description -->
                        <p><strong class="font-weight-bold">Description:</strong> {{ $item->description }}</p>

                        <!-- Price -->
                        <p><strong class="font-weight-bold">Price:</strong> Php {{ number_format($item->price, 2) }}</p>

                        <!-- Action Buttons (Aligned to the left) -->
                        <div class="d-flex">
                            <a href="{{ route('vehicle.edit', $item) }}" class="btn btn-warning btn-sm me-2">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('vehicle.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center col-12">{{ __('No equipment found.') }}</p>
            @endforelse
        </div>
    </div>
</x-adminlayout.app>
<x-customerlayout.app>

    <div class="container mx-auto p-6 bg-gray-100">
        <div class="bg-white w-3/4 mx-auto p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Rent Vehicle</h1>

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

            <!-- Rent Form -->
            <form id="rentForm" action="{{ route('customer.rentedVehicle.store') }}" method="POST">
                @csrf

                <div class="form-group mb-4">
                    <label for="vehicle" class="form-label">Vehicle</label>
                    <select name="vehicles_id" id="vehicles_id" class="form-select" required
                        onchange="updatePrice(), updateDescription()">
                        <option value="">-- Select Equipment --</option>
                        @foreach($vehicles as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->price }}"
                            data-description="{{ $item->description }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="price" class="form-label">Price:</label>
                    <div id="price-display" class="fs-5 fw-semibold"></div>
                </div>

                <div class="form-group mb-4">
                    <label for="description" class="form-label">Description:</label>
                    <div id="description-display" class="fs-5 fw-semibold"></div>
                </div>

                <div class="form-group mb-4">
                    <label for="rented_date" class="form-label">Rented Date</label>
                    <input type="date" name="rented_date" id="rented_date" class="form-control" required>
                    @error('rented_date')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="button" class="btn btn-success me-2" onclick="showConfirmationModal()">Rent</button>
            </form>

            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Rent</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to rent this vehicle?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="submitRentForm()">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Show confirmation modal
                function showConfirmationModal() {
                    var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    confirmationModal.show();
                }

                // Submit the form
                function submitRentForm() {
                    document.getElementById('rentForm').submit();
                }

                function updatePrice() {
                    const select = document.getElementById('vehicles_id');
                    const priceDisplay = document.getElementById('price-display');
                    const selectedOption = select.options[select.selectedIndex];

                    if (selectedOption.value) {
                        const price = selectedOption.getAttribute('data-price');
                        priceDisplay.textContent = `Php ${parseFloat(price).toFixed(2)}`;
                    } else {
                        priceDisplay.textContent = '';
                    }
                }

                function updateDescription() {
                    const select = document.getElementById('vehicles_id');
                    const descriptionDisplay = document.getElementById('description-display');
                    const selectedOption = select.options[select.selectedIndex];

                    if (selectedOption.value) {
                        const description = selectedOption.getAttribute('data-description');
                        descriptionDisplay.textContent = description;
                    } else {
                        descriptionDisplay.textContent = '';
                    }
                }
            </script>
        </div>
    </div>

</x-customerlayout.app>

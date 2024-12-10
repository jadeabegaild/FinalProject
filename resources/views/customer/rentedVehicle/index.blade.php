<x-customerlayout.app>

    <div class="container py-4 bg-light">

        <a href="{{ route('customer.rentedVehicle.create') }}" class="btn btn-success mb-4 shadow-sm">
            {{ __('Rent Vehicle') }}
        </a>

        <div class="table-responsive">
            <table class="table table-bordered shadow bg-white">
                <thead class="table-success">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Price</th>
                        <th>Rented Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentedVehicle as $rented)
                    <tr class="table-row-hover">
                        <td>{{ $rented->vehicles->name }}</td>
                        <td>{{ $rented->vehicles->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($rented->rented_date)->format('F d, Y') }}</td>
                        <td>
                            <form action="{{ route('customer.rentedVehicle.destroy', $rented) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="showConfirmationModal(this)">Cancel</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No rented vehicle found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this rental? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go Back</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let formToSubmit;

        function showConfirmationModal(button) {
            const form = button.closest('.delete-form');
            formToSubmit = form; // Store reference to the form
            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
        }

        document.getElementById('confirmDelete').addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    </script>

    <style>
        .table-row-hover:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }
    </style>

</x-customerlayout.app>

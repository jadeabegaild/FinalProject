<x-customerlayout.app>

    <div class="container py-4 bg-light">

        @if(session('success'))
        <div class="position-fixed top-50 start-50 translate-middle z-index-modal">
            <div class="bg-white rounded shadow w-75 w-md-50 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-success fw-bold">Success</h3>
                    <button class="btn-close" aria-label="Close" onclick="closeModal()"></button>
                </div>
                <p class="text-success">{{ session('success') }}</p>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
        <div id="modal-backdrop" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" onclick="closeModal()"></div>
        <script>
            function closeModal() {
                const modal = document.querySelector('.position-fixed');
                const backdrop = document.getElementById('modal-backdrop');
                if (modal && backdrop) {
                    modal.style.display = 'none';
                    backdrop.style.display = 'none';
                }
            }
        </script>
        @endif

        <!-- Approved Requests -->
        <h3 class="fw-bold text-success mb-4 fs-4">Approved Requests</h3>
        <div class="table-responsive mb-5">
            <table class="table table-bordered border-success shadow bg-white">
                <thead class="table-success">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Price</th>
                        <th>Rented Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvedVehicle as $vehicle)
                    <tr class="table-row-hover">
                        <td>{{ $vehicle->vehicles->name }}</td>
                        <td>{{ $vehicle->vehicles->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($vehicle->rented_date)->format('F d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No approved requests found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Rejected Requests -->
        <h3 class="fw-bold text-danger mb-4 fs-4">Rejected Requests</h3>
        <div class="table-responsive mb-5">
            <table class="table table-bordered border-danger shadow bg-white">
                <thead class="table-danger">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Price</th>
                        <th>Rented Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rejectedVehicle as $vehicle)
                    <tr class="table-row-hover">
                        <td>{{ $vehicle->vehicles->name }}</td>
                        <td>{{ $vehicle->vehicles->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($vehicle->rented_date)->format('F d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No rejected requests found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Returned Vehicle -->
        <h3 class="fw-bold text-warning mb-4 fs-4">Returned Vehicle</h3>
        <div class="table-responsive">
            <table class="table table-bordered border-warning shadow bg-white">
                <thead class="table-warning">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Price</th>
                        <th>Rented Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($returnedVehicle as $vehicle)
                    <tr class="table-row-hover">
                        <td>{{ $vehicle->vehicles->name }}</td>
                        <td>{{ $vehicle->vehicles->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($vehicle->rented_date)->format('F d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No returned vehicles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .table-row-hover:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .table {
            border-radius: 0.25rem;
            overflow: hidden;
        }
    </style>

</x-customerlayout.app>

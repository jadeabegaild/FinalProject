<x-adminlayout.app>

    <div class="container mt-5">
        <div class="mb-4">
            <form action="{{ route('rentedVehicle.index') }}" method="GET" class="d-flex w-100">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user or vehicle"
                    class="form-control me-2 w-85 rounded-3">
                <button type="submit" class="btn btn-success rounded-3">Search</button>
            </form>
        </div>

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
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        </script>
        @endif

        <!-- Pending Requests -->
        <h3 class="fw-semibold text-lg text-dark mb-3">Pending Rentals</h3>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped rounded-3">
                <thead class="table-warning">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>User</th>
                        <th>Rent Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $rent)
                    <tr>
                        <td>{{ $rent->vehicles->name }}</td>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ $rent->rented_date }}</td>
                        <td>
                            <form action="{{ route('rentedVehicle.update', $rent) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" required class="form-select form-select-sm rounded-3">
                                    <option value="approved">Approve</option>
                                    <option value="rejected">Reject</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-2 rounded-3">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pending->links() }}
        </div>

        <!-- Approved Requests -->
        <h3 class="fw-semibold text-lg text-dark mb-3">Approved Requests</h3>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped rounded-3">
                <thead class="table-success">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>User</th>
                        <th>Rented Date</th>
                        <th>Returned</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($approved as $rent)
                    <tr>
                        <td>{{ $rent->vehicles->name }}</td>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ $rent->rented_date }}</td>
                        <td>
                            @if($rent->returned)
                                <span class="badge bg-success">Returned</span>
                            @else
                                <span class="badge bg-warning">Not Returned</span>
                            @endif
                        </td>
                        <td>
                            @if(!$rent->returned)
                            <form action="{{ route('rentedVehicle.update', $rent) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="returned" value="1">
                                <button type="submit" class="btn btn-success btn-sm rounded-3">Mark as Returned</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $approved->links() }}
        </div>

        <!-- Rejected Requests -->
        <h3 class="fw-semibold text-lg text-dark mb-3">Rejected Requests</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped rounded-3">
                <thead class="table-danger">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>User</th>
                        <th>Rented Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rejected as $rent)
                    <tr>
                        <td>{{ $rent->vehicles->name }}</td>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ $rent->rented_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rejected->links() }}
        </div>
    </div>

</x-adminlayout.app>

<!-- Add the custom border-radius style -->
<style>
    .rounded-3 {
        border-radius: 20px !important;
    }
</style>

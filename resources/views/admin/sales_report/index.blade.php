<x-adminlayout.app>

    <div class="container py-5">
        <!-- Filters -->
        <form method="GET" action="{{ route('sales_report.index') }}" class="mb-4 row g-3">
            <!-- Start Date -->
            <div class="col-md-4">
                <label for="start_date" class="form-label fw-bold text-primary">Start Date:</label>
                <input type="date" name="start_date" id="start_date"
                    value="{{ request('start_date') ?? $startDate->format('Y-m-d') }}"
                    class="form-control border border-primary rounded shadow-sm">
            </div>

            <!-- End Date -->
            <div class="col-md-4">
                <label for="end_date" class="form-label fw-bold text-primary">End Date:</label>
                <input type="date" name="end_date" id="end_date"
                    value="{{ request('end_date') ?? $endDate->format('Y-m-d') }}"
                    class="form-control border border-primary rounded shadow-sm">
            </div>

            <!-- Vehicle -->
            <div class="col-md-3">
                <label for="vehicles_id" class="form-label fw-bold text-primary">Vehicles Option:</label>
                <select name="vehicles_id" id="vehicles_id" class="form-select border border-primary rounded shadow-sm">
                    <option value="">All Vehicles</option>
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $vehicleId == $vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="col-md-1">
                <button type="submit" class="btn btn-success fw-bold shadow-sm px-4 mt-4">Filter</button>
            </div>
        </form>


        <!-- Summary Boxes -->
        <div class="row g-4 mb-4">
            <div class="col-lg-5 col-md-6">
                <div class="bg-white p-4 rounded-lg shadow border border-success">
                    <h5 class="text-black fw-bold"><strong>Total Sales</strong></h5>
                    <p class="text-success fs-4 fw-semibold">{{ number_format($totalSales, 2) }} PHP</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="bg-white p-4 rounded-lg shadow border border-success">
                    <h5 class="text-black fw-bold">Monthly Sales</h5>
                    <ul class="list-unstyled">
                        @foreach($monthlySales as $sale)
                        <li class="mb-2">
                            <span
                                class="fw-bold">{{ \Carbon\Carbon::createFromFormat('Y-m', $sale->year . '-' . $sale->month)->format('F Y') }}:</span>
                            <span class="text-success">{{ number_format($sale->monthly_sales, 2) }} PHP</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="table-responsive bg-white p-4 rounded-lg shadow border border-success">
            <table class="table table-hover table-striped">
                <thead class="table-success text-black">
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Price (PHP)</th>
                        <th>Total Rents</th>
                        <th>Total Sales (PHP)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicleSales as $sale)
                    <tr>
                        <td>{{ $sale->vehicle_name }}</td>
                        <td>{{ number_format($sale->vehicle_price, 2) }}</td>
                        <td>{{ $sale->total_rented }}</td>
                        <td>{{ number_format($sale->total_sales, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-adminlayout.app>
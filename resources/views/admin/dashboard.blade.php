<x-adminlayout.app>

    <div class="container py-6">
        <!-- Dashboard Summary -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Total Farmers -->
            <div class="col">
                <div class="bg-white p-4 rounded-lg shadow border border-success">
                    <h3 class="text-lg font-semibold text-success">Total Customers</h3>
                    <p class="text-2xl text-success">{{ $totalCustomers }}</p>
                </div>
            </div>

            <!-- Total Pending Borrowed Equipment -->
            <div class="col">
                <div class="bg-white p-4 rounded-lg shadow border border-warning">
                    <h3 class="text-lg font-semibold text-warning">Pending Rent Requests</h3>
                    <p class="text-2xl text-warning">{{ $totalPending }}</p>
                </div>
            </div>

            <!-- Total Sales -->
            <div class="col">
                <div class="bg-white p-4 rounded-lg shadow border border-primary">
                    <h3 class="text-lg font-semibold text-primary">Total Sales</h3>
                    <p class="text-2xl text-primary">{{ number_format($totalSales, 2) }} PHP</p>
                </div>
            </div>
        </div>

        <!-- Sales Per Equipment Chart -->
        <div class="bg-white p-4 rounded-lg shadow border border-light mt-6">
            <h3 class="text-lg font-semibold text-dark">Sales Per Vehicle</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Sales Per Equipment Table -->
        <div class="bg-white p-4 rounded-lg shadow border border-light mt-6">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-lg font-semibold text-dark">Rent Sales</h3>
                <button onclick="printReport()" class="btn btn-primary px-4 py-2 rounded shadow hover:bg-blue-600">
                    Print Report
                </button>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-hover mt-4" id="salesTable">
                <thead class="table-primary">
                    <tr>
                        <th class="px-4 py-2 text-left">Vehicle Name</th>
                        <th class="px-4 py-2 text-left">Total Sales (PHP)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesPerVehicle as $sale)
                    <tr>
                        <td class="px-4 py-2">{{ $sale->vehicle_name }}</td>
                        <td class="px-4 py-2">{{ number_format($sale->total_sales, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Prepare data for the chart
    const salesData = @json($salesPerVehicle);

    const labels = salesData.map(sale => sale.vehicle_name);
    const data = salesData.map(sale => sale.total_sales);

    // Chart.js code
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Sales (PHP)',
                data: data,
                backgroundColor: 'rgba(34, 197, 94, 0.5)', // Green color
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Print function for the equipment sales report
    function printReport() {
        const printContent = document.getElementById('salesTable').outerHTML;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Equipment Sales Report</title></head><body>');
        printWindow.document.write('<h2>Equipment Sales Report</h2>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
    </script>
</x-adminlayout.app>
<x-customerlayout.app>

    <div class="container mx-auto px-4 py-6">
        <!-- Statistics Section -->
        <div class="row row-cols-4 g-6">
            <!-- Pending Borrowed Equipment -->
            <div class="col">
                <div class="bg-warning-light text-dark p-4 rounded shadow hover-container">
                    <h4 class="fw-semibold fs-5">Total Pending Rents</h4>
                    <p class="fs-2 fw-bold">{{ $totalPending }}</p>
                </div>
            </div>

            <!-- Approved Borrowed Equipment -->
            <div class="col">
                <div class="bg-success-light text-dark p-4 rounded shadow hover-container">
                    <h4 class="fw-semibold fs-5">Total Approved Rents</h4>
                    <p class="fs-2 fw-bold">{{ $totalApproved }}</p>
                </div>
            </div>

            <!-- Rejected Borrowed Equipment -->
            <div class="col">
                <div class="bg-danger-light text-dark p-4 rounded shadow hover-container">
                    <h4 class="fw-semibold fs-5">Total Rejected Rents</h4>
                    <p class="fs-2 fw-bold">{{ $totalRejected }}</p>
                </div>
            </div>

            <!-- Returned Borrowed Equipment -->
            <div class="col">
                <div class="bg-primary-light text-dark p-4 rounded shadow hover-container">
                    <h4 class="fw-semibold fs-5">Total Returned Rents</h4>
                    <p class="fs-2 fw-bold">{{ $totalReturned }}</p>
                </div>
            </div>
        </div>


        <!-- Equipment Section -->
        <hr class="my-6">

        <h2 class="fs-4 fw-bold mb-4">Vehicles</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($vehicleWithPrices as $vehicle)
            <div class="col">
                <div class="card shadow border-light hover-container">
                    <img src="{{ $vehicle->picture ? Storage::url($vehicle->picture) : 'https://via.placeholder.com/400x400' }}"
                        class="card-img-top" alt="{{ $vehicle->name }}">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $vehicle->name }}</strong></h5>
                        <p class="card-text">{{ $vehicle->description }}</p>
                        <p class="text-success"><strong>Price: {{ number_format($vehicle->price, 2) }}</strong></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

</x-customerlayout.app>

<style>
/* Hover effect for enlarging the container */
.hover-container {
    transition: transform 0.3s ease, background-color 0.3s ease;
}

/* Enlarge the container on hover */
.hover-container:hover {
    transform: scale(1.05);
    /* Slightly enlarges the container */
}

/* Light shades for the statistics cards */
.bg-warning-light {
    background-color: #f8e1a1;
    /* Light shade of yellow */
}

.bg-success-light {
    background-color: #a8e6cf;
    /* Light shade of green */
}

.bg-danger-light {
    background-color: #f8a3a8;
    /* Light shade of red */
}

/* Hover effect for statistics cards */
.bg-warning-light:hover {
    background-color: #f3c25f;
    /* Darker light yellow shade */
}

.bg-success-light:hover {
    background-color: #80d0b0;
    /* Darker light green shade */
}

.bg-danger-light:hover {
    background-color: #f58f95;
    /* Darker light red shade */
}

/* Hover effect for vehicle cards */
.card:hover {
    transform: scale(1.05);
    /* Slightly enlarges the vehicle card */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    /* Subtle shadow effect on hover */
}

/* Optional: add image zoom effect */
.card-img-top {
    transition: transform 0.3s ease;
}

/* Zoom in on the image */
.card-img-top:hover {
    transform: scale(1.1);
    /* Zoom effect on image */
}
</style>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
    /* Tailwind CSS styles */
    </style>
    @endif
</head>

<body class="font-sans antialiased text-white/50 bg-cover bg-center" style="background-image: url('{{ asset('images/3.jpg') }}');">
    <div class="bg-green-50 text-white/50 bg-black text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#28a745] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3 relative">
                    <!-- Other Header Content -->
                    @if (Route::has('login'))
                    <nav class="flex flex-1 justify-end">
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-green/70 focus:outline-none focus-visible:ring-[#28a745] hover:text-green/80 focus-visible:ring-green">
                            Dashboard
                        </a>
                        @else
                        <!-- Top Right Buttons -->
                        <div class="absolute top-0 right-0 flex items-center space-x-4 p-4">
                            <!-- Log in Button -->
                            <a href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-white bg-black ring-1 ring-transparent transition hover:text-green/70 focus:outline-none focus-visible:ring-[#28a745] hover:text-green/80 focus-visible:ring-green">
                                Log in
                            </a>
                            @if (Route::has('register'))
                            <!-- Register Button -->
                            <a href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-green/70 focus:outline-none focus-visible:ring-[#28a745] hover:text-green/80 focus-visible:ring-green">
                                Register
                            </a>
                            @endif
                        </div>
                        @endauth
                    </nav>
                    @endif
                </header>


                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <a href="https://example.com/about"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-black p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#28a745] md:row-span-3 lg:p-10 lg:pb-10 bg-zinc-900 ring-zinc-800 hover:text-white/70 hover:ring-zinc-700 focus-visible:ring-[#28a745]"
                            style="background-image: url('{{ asset('images/1.jpg') }}'); background-size: cover; background-position: center;">
                            <div class="relative flex w-full flex-1 items-stretch">
                                <img src="{{ asset('images/1.jpg') }}" alt="About Us"
                                    class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] hidden" />
                                <div class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)]">
                                </div>
                            </div>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div class="flex items-start gap-6 lg:flex-col">
                                    
                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-white">About Us</h2>
                                        <p class="mt-4 text-sm/relaxed">
                                            Welcome to JRM Rental Management Inc., a trusted name in equipment and
                                            vehicle rental services. Established with a vision to simplify access to
                                            high-quality vehicles and equipment, we are committed to providing reliable,
                                            cost-effective, and professional solutions tailored to meet the needs of
                                            individuals, businesses, and organizations.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>


                        <a href="https://example.com/services"
                            class="relative flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#28a745] lg:pb-10 bg-zinc-900 ring-zinc-800 hover:text-white/70 hover:ring-zinc-700 focus-visible:ring-[#28a745]">
                            <!-- Background Image with Opacity -->
                            <div
                                class="absolute inset-0 bg-[url('{{ asset('images/2.jpg') }}')] bg-cover bg-center opacity-50">
                            </div>

                            <!-- Content Overlay -->
                            

                            <div class="relative z-10 pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-white">Our Purpose</h2>
                                <p class="mt-4 text-sm/relaxed">
                                    At JRM Rental Management Inc., our mission is to empower our customers by offering
                                    them easy and efficient rental solutions. We aim to bridge the gap between
                                    accessibility and affordability, enabling our clients to focus on their goals
                                    without the burden of ownership costs. Whether you need a vehicle for personal use
                                    or specialized equipment for an event, JRM Rental Management Inc. is here to serve
                                    you.
                                </p>
                            </div>
                        </a>



                        <a href="https://example.com/contact"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#28a745] lg:pb-10 bg-zinc-900 ring-zinc-800 hover:text-white/70 hover:ring-zinc-700 focus-visible:ring-[#28a745]">
                            
                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-white">Contact Us</h2>
                                <p class="mt-4 text-sm/relaxed">
                                    Have questions or want to get involved? Reach out to us through our contact page. We
                                    would love to hear from you and discuss how you can be part of our community.
                                </p>
                            </div>
                        </a>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black text-white/70">
                    JRM Rental Management Inc © {{ date('Y') }}. All rights reserved.
                </footer </div>
            </div>
        </div>
</body>

</html>
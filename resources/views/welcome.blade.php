<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: true }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RJSC | Advanced Inventory Intelligence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .geist-dot-grid {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .dark .geist-dot-grid {
            background-image: radial-gradient(#333 1px, transparent 1px);
        }
    </style>
</head>

<body
    class="bg-white font-sans text-slate-900 antialiased transition-colors duration-300 dark:bg-[#000] dark:text-white">

    <nav
        class="sticky top-0 z-50 border-b border-gray-200 bg-white/80 backdrop-blur-md dark:border-white/10 dark:bg-black/80">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-2 text-xl font-bold tracking-tighter">
                <div class="flex h-8 w-8 items-center justify-center rounded bg-blue-600 text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                RJSC<span class="text-blue-600">Inventory</span>
            </div>

            <div class="hidden items-center gap-8 text-sm font-medium md:flex">
                <a class="transition hover:text-blue-500" href="#features">Features</a>
                <a class="transition hover:text-blue-500" href="#tracking">Real-time Tracking</a>
                <a class="transition hover:text-blue-500" href="#analytics">Analytics</a>
            </div>
            <div class="flex items-center gap-4">
                <button class="rounded-full p-2 transition hover:bg-gray-100 dark:hover:bg-white/10"
                    @click="darkMode = !darkMode">
                    <template x-if="darkMode">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </template>
                    <template x-if="!darkMode">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </template>
                </button>

                @auth
                    <a class="rounded-full bg-black px-6 py-2 text-sm font-medium text-white transition-all hover:bg-gray-800 dark:bg-white dark:text-black dark:hover:bg-gray-200"
                        href="{{ url('/dashboard') }}">
                        Dashboard
                    </a>

                    <a class="dark:border-red/50 rounded-full border border-gray-200 px-6 py-2 text-sm font-medium transition-all hover:bg-gray-50 dark:hover:bg-white/5"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form class="hidden" id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                @endauth

                @guest
                    <a class="rounded-full border border-gray-200 px-6 py-2 text-sm font-medium transition-all hover:bg-gray-50 dark:border-white/10 dark:hover:bg-white/5"
                        href="{{ route('login') }}">
                        Sign In
                    </a>
                    <a class="rounded-full bg-black px-6 py-2 text-sm font-medium text-white transition-all hover:bg-gray-800 dark:bg-white dark:text-black dark:hover:bg-gray-200"
                        href="{{ route('register') }}">
                        Get Started
                    </a>
                @endguest
            </div>
        </div>
        </div>
    </nav>

    <header class="geist-dot-grid relative overflow-hidden px-6 pb-24 pt-32 text-center">
        <div class="relative mx-auto max-w-4xl">
            <div class="absolute -top-24 left-1/2 -z-10 h-64 w-64 -translate-x-1/2 bg-blue-500/20 blur-[100px]"></div>

            <h1 class="mb-8 text-5xl font-extrabold leading-[1.1] tracking-tighter sm:text-7xl lg:text-8xl">
                Every asset, <br class="hidden md:block" />
                <span class="bg-gradient-to-r from-blue-600 to-cyan-400 bg-clip-text italic text-transparent">accounted
                    for.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-gray-500 dark:text-gray-400">
                The modern operating system for your physical inventory. Track depreciation, assign ownership, and
                manage lifecycle events with zero friction.
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <button
                    class="rounded-full bg-blue-600 px-8 py-4 font-semibold text-white shadow-xl shadow-blue-500/25 transition-all hover:-translate-y-1 hover:bg-blue-700">
                    Start Inventory Audit
                </button>
                <button
                    class="rounded-full border border-gray-200 bg-white/50 px-8 py-4 font-semibold backdrop-blur-sm transition-all hover:bg-gray-50 dark:border-white/10 dark:bg-white/5 dark:hover:bg-white/10">
                    Watch Demo
                </button>
            </div>
        </div>
    </header>

    <section class="mx-auto max-w-7xl px-6 py-32" id="features">
        <div class="grid gap-4 md:grid-cols-6 lg:grid-rows-2">
            <div
                class="row-span-1 rounded-3xl border border-gray-200 bg-gray-50/50 p-10 md:col-span-4 dark:border-white/10 dark:bg-white/5">
                <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="mb-4 text-3xl font-bold">Smart Lifecycle Tracking</h3>
                <p class="max-w-md text-lg text-gray-500 dark:text-gray-400">From procurement to disposal. Track
                    maintenance schedules, warranty expiration, and real-time custodian history in one unified timeline.
                </p>
            </div>

            <div class="rounded-3xl border border-gray-200 p-8 md:col-span-2 dark:border-white/10">
                <h4 class="mb-2 text-xl font-bold">QR Code Ready</h4>
                <p class="text-sm text-gray-500">Generate instant asset tags. Scan with any mobile device to update
                    location or status.</p>
                <div
                    class="mt-6 flex h-20 w-20 items-center justify-center rounded-lg border border-dashed border-gray-300 bg-white p-2 dark:border-white/20 dark:bg-white/10">
                    <svg class="h-full w-full text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M3 3h4v4H3V3zm0 7h4v4H3v-4zm0 7h4v4H3v-4zm7-14h4v4h-4V3zm0 7h4v4h-4v-4zm0 7h4v4h-4v-4zm7-14h4v4h-4V3zm0 7h4v4h-4v-4zm0 7h4v4h-4v-4z" />
                    </svg>
                </div>
            </div>

            <div class="rounded-3xl border border-gray-200 p-8 md:col-span-2 dark:border-white/10">
                <h4 class="mb-2 text-xl font-bold">Depreciation Engine</h4>
                <p class="text-sm text-gray-500">Automatic calculation using Straight Line or Double Declining methods.
                </p>
            </div>

            <div
                class="rounded-3xl border border-gray-200 bg-gradient-to-br from-blue-600 to-blue-800 p-10 text-white md:col-span-4">
                <h3 class="mb-4 text-3xl font-bold">Powerful Analytics</h3>
                <p class="mb-8 text-lg text-blue-100">Visualize your entire asset fleet. Identify underutilized
                    equipment and optimize capital expenditure.</p>
                <div class="flex h-24 items-end gap-2">
                    <div class="h-1/2 w-full rounded-t-md bg-white/20"></div>
                    <div class="h-3/4 w-full rounded-t-md bg-white/40"></div>
                    <div class="h-full w-full rounded-t-md bg-white/60"></div>
                    <div class="h-2/3 w-full rounded-t-md bg-white/30"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-gray-200 bg-gray-50 dark:border-white/10 dark:bg-[#0a0a0a]">
        <div class="mx-auto max-w-7xl px-6 py-12">
            <div class="flex flex-wrap justify-between gap-8 opacity-60 grayscale transition-all hover:grayscale-0">
                <div class="flex items-center gap-2 font-bold italic">DELL PREFERRED</div>
                <div class="flex items-center gap-2 font-bold italic">APPLE BUSINESS</div>
                <div class="flex items-center gap-2 font-bold italic">LOGITECH ENTERPRISE</div>
                <div class="flex items-center gap-2 font-bold italic">HP MANAGED</div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-32" id="tracking">
        <div class="mb-12">
            <h2 class="text-3xl font-bold tracking-tighter">Inventory Overview</h2>
            <p class="text-gray-500">Live data snapshot from your asset repository.</p>
        </div>
        <div
            class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-2xl dark:border-white/10 dark:bg-[#050505]">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-100 bg-gray-50 text-gray-500 dark:border-white/5 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Asset Tag</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Model/Name</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider">Current Custodian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    <tr>
                        <td class="px-6 py-5 font-mono text-blue-600">AST-90210</td>
                        <td class="px-6 py-5 font-medium">MacBook Pro M3 Max 16"</td>
                        <td class="px-6 py-5 text-gray-500">IT Hardware</td>
                        <td class="px-6 py-5"><span
                                class="rounded-full border border-green-500/20 bg-green-500/10 px-3 py-1 text-xs font-bold text-green-500">ACTIVE</span>
                        </td>
                        <td class="px-6 py-5 text-gray-500">Sarah Jenkins</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-5 font-mono text-blue-600">AST-44821</td>
                        <td class="px-6 py-5 font-medium">Dell UltraSharp 32" 4K</td>
                        <td class="px-6 py-5 text-gray-500">Peripheral</td>
                        <td class="px-6 py-5"><span
                                class="rounded-full border border-yellow-500/20 bg-yellow-500/10 px-3 py-1 text-xs font-bold text-yellow-500">MAINTENANCE</span>
                        </td>
                        <td class="px-6 py-5 text-gray-500">Warehouse A</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <footer class="border-t border-gray-200 py-24 dark:border-white/20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex flex-col items-start justify-between gap-12 md:flex-row">
                <div class="max-w-sm">
                    <div class="mb-6 flex items-center gap-2 text-xl font-bold tracking-tighter">
                        <div class="flex h-6 w-6 items-center justify-center rounded bg-blue-600 text-xs text-white">
                            AF</div>
                        ASSETFLOW
                    </div>
                    <p class="text-sm leading-relaxed text-gray-500">
                        Redefining inventory management for the digital-first enterprise. Built for scale, designed for
                        speed.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-12 sm:grid-cols-3">
                    <div>
                        <h4 class="mb-6 text-xs font-bold uppercase tracking-widest text-blue-600">Product</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li><a class="transition hover:text-black dark:hover:text-white"
                                    href="#">Changelog</a></li>
                            <li><a class="transition hover:text-black dark:hover:text-white"
                                    href="#">Documentation</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-6 text-xs font-bold uppercase tracking-widest text-blue-600">Support</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li><a class="transition hover:text-black dark:hover:text-white" href="#">Help
                                    Center</a></li>
                            <li><a class="transition hover:text-black dark:hover:text-white" href="#">API
                                    Access</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-20 border-t border-gray-100 pt-8 text-center text-xs text-gray-400 dark:border-white/5">
                © 2026 RJSC Inventory Systems. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>

<x-app-layout>
    <div >
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Palakkad</h2>
                <p class="text-green-500">Diocese</p>
            </div>
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Mannarkkad</h2>
                <p class="text-green-500">Forane</p>
            </div>
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Holy Spirit Forane Church Perimbadari</h2>
                <p class="text-red-500">Church</p>
            </div>
        </div>

        <div>
            @livewire('ward-list') <!-- Display the list of wards -->
        </div>

<!--
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Soft UI Dashboard</h2>
                <p>Built by developers. From colors, cards, typography to complex elements.</p>
            </div>
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Work with the rockets</h2>
                <p>Wealth creation is an evolutionarily recent positive-sum game.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Active Users</h2>
                <canvas id="activeUsersChart"></canvas>
            </div>
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-bold">Sales Overview</h2>
                <canvas id="salesOverviewChart"></canvas>
            </div>
        </div> -->
    </div>

</x-app-layout>

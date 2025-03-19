<x-app-layout>

    <body class="bg-gray-100 text-white-800">
        <div class="container mx-auto py-8">
            <h1 class="text-bordeaux text-2xl font-bold text-center mb-6">Overzicht klanten</h1>


            <!-- Bericht weergeven als een sessie een 'success'-bericht bevat -->
            @if (session()->has('success'))
                <div class="bg-green-100 text-green-800 border border-green-200 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto mx-auto max-w-6xl">



                <!-- Search Form and Home Button -->
                <div class="overflow-x-auto mx-auto max-w-6xl">



                    <!-- Search Form and Home Button -->
                    <div class="flex justify-between mb-4">
                        <input type="text" id="search" placeholder="Zoek op achternaam"
                            class="px-6 py-2 rounded font-semibold shadow-md transition">
                        <a href="/"
                            class="bg-[#5F1A37] text-white px-6 py-2 rounded font-semibold shadow-md transition">Home
                            pagina</a>
                        <!-- Link om een nieuwe klant te creëren -->


                        
                        <a href="{{ route('customers.create') }}" style="background-color: #001f3d;"
                            class="text-white px-6 py-2 rounded font-semibold shadow-md transition">
                            Nieuwe klant toevoegen
                        </a>
                    </div>


                    <!-- Tabel met alle klanten -->
                    <table class="w-4/5 bg-white dark:bg-gray-800 m-auto mt-5 mb-5">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                                    Naam</th>
                                <th
                                    class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                                    Geboorte datum</th>
                                <th
                                    class="px-4 py-2 border-b-2 border-r border-gray-300 dark:border-gray-700 text-left leading-4 tracking-wider">
                                    RelatieNummer</th>

                            </tr>
                        </thead>
                        <tbody id="customer-table-body">
                            @if ($customers->isEmpty())
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 text-center bg-blue-100 align-middle h-16"
                                        colspan="8">Geen data gevonden, probeer het later opnieuwe</td>
                                </tr>
                            @else
                                @foreach ($customers as $customer)
                                    <tr class="text-center hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">
                                            {{ $customer->Fullname }}</td>
                                        <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">
                                            {{ $customer->Birthdate }}</td>
                                        <td class="px-4 py-2 border-b border-r border-gray-300 dark:border-gray-700">
                                            {{ $customer->RelationNumber }}
                                        </td>
                                        </form>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- Paginatie Links -->
                    <div class="mt-6">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>



            <!-- JavaScript for live search -->
            <script>
                document.getElementById('search').addEventListener('input', function() {
                    let query = this.value;

                    if (query === '') {
                        // If the input is empty, fetch all customers again or clear the table
                        fetch(`/customers`)
                            .then(response => response.text())
                            .then(html => {
                                document.getElementById('customer-table-body').innerHTML = new DOMParser()
                                    .parseFromString(html, 'text/html').querySelector('#customer-table-body').innerHTML;
                            });
                    } else {
                        fetch(`/customers/search?Lastname=${query}`)
                            .then(response => response.json())
                            .then(data => {
                                let tbody = document.getElementById('customer-table-body');
                                tbody.innerHTML = '';

                                if (data.length === 0) {
                                    tbody.innerHTML =
                                        '<tr><td class="px-4 py-2 border border-gray-300 text-center bg-blue-100 align-middle h-16" colspan="8">Geen data gevonden, probeer het later opnieuw</td></tr>';
                                } else {
                                    data.forEach(customer => {
                                        let row = `<tr class="text-center hover:bg-gray-50">
                                    <td class="px-4 py-2 border border-gray-300">${customer.Fullname}</td>
                                    <td class="px-4 py-2 border border-gray-300">${customer.Birthdate}</td>
                                    <td class="px-4 py-2 border border-gray-300">${customer.RelationNumber}</td>
                                </tr>`;
                                        tbody.innerHTML += row;
                                    });
                                }
                            });
                    }
                });
            </script>
    </body>
</x-app-layout>

@extends('market_place.layouts.base')

@section('content')

    @include('market_place.partials.search-header')

    @include('market_place.partials.search-bar')

    @include('market_place.partials.premium-list')

    <script>

        document.getElementById("searchBtn").addEventListener("click", function () {
            let domain = document.getElementById("domainInput").value.trim();

            if (!domain) {
                alert("Please enter a domain.");
                return;
            }

            document.getElementById("resultsContainer").innerHTML =
                `<p class="text-center">Checking availability...</p>`;

            fetch("{{ route('check.domain') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ domain: domain })
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data);

                    if (!data.domains || data.domains.length === 0) {
                        document.getElementById("resultsContainer").innerHTML =
                            `<p class='text-red-600 text-center'>No domain availability data found.</p>`;
                        return;
                    }

                    let html = "";

                    data.domains.forEach(item => {
                        html += `
                <div class="border rounded-2xl p-8 shadow-sm bg-white hover:shadow-md transition">

                    <span class="text-xs font-bold ${item.available ? 'bg-green-500' : 'bg-red-500'} text-white px-2 py-1 rounded">
                        ${item.available ? 'AVAILABLE' : 'TAKEN'}
                    </span>

                    <h2 class="text-xl font-semibold mt-3">${item.domain}</h2>

                    <p class="mt-4 text-gray-700 text-sm font-medium">
                        Status: ${item.status}
                    </p>

                    <div class="mt-2">
                        <span class="text-2xl font-bold">${item.price ?? '--'}</span>
                        <span class="text-gray-500">/1st yr</span>
                    </div>

                    ${item.available
                            ? `
                            <form action="{{ route('domain.register') }}" method="POST">
                                @csrf
                                <input type="hidden" name="domain" value="${item.domain}">
                                <input type="hidden" name="price" value="${item.price}">
                                <button type="submit" class="mt-6 w-full bg-blue-600 text-white font-medium py-3 rounded-xl hover:bg-blue-700">Buy Now</button>
                            </form>
                            `
                            : `<button disabled class="mt-6 w-full bg-gray-400 text-white font-medium py-3 rounded-xl">Unavailable</button>`
                        }
                </div>`;
                    });

                    document.getElementById("resultsContainer").innerHTML = html;
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById("resultsContainer").innerHTML =
                        `<p class="text-red-600 text-center">Error loading results.</p>`;
                });
        });


    </script>

@endsection

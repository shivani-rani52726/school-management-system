<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
                    <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" 
                        onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 15px rgba(0, 0, 0, 0.2)';" 
                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <a href="http://" class="text-decoration-none text-dark">Notes</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <a href="http://" class="text-decoration-none text-dark">Pdf</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <a href="http://" class="text-decoration-none text-dark">Questions</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <a href="http://" class="text-decoration-none text-dark">Quiz's</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

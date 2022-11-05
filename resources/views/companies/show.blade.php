<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Company")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                            data-tabs-toggle="#tabs" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard" aria-selected="false">{{__("Dashboard")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="invoices-tab" data-tabs-target="#invoices" type="button" role="tab"
                                    aria-controls="invoices" aria-selected="false">{{__("Invoices")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="products-tab" data-tabs-target="#products" type="button" role="tab"
                                    aria-controls="products" aria-selected="false">{{__("Products")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="customers-tab" data-tabs-target="#customers" type="button" role="tab"
                                    aria-controls="customers" aria-selected="false">{{__("Customers")}}
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="details-tab" data-tabs-target="#details" type="button" role="tab"
                                    aria-controls="details" aria-selected="false">{{__("Company Details")}}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div id="tabs">
                        <div class="hidden p-4" id="dashboard" role="tabpanel"
                             aria-labelledby="dashboard-tab">
                            @livewire("company-graphs",["company"=>$company])
                        </div>
                        <div class="hidden p-4" id="details" role="tabpanel"
                             aria-labelledby="details-tab">
                            @include("companies.details",["company"=>$company])
                        </div>
                        <div class="hidden p-4" id="invoices" role="tabpanel"
                             aria-labelledby="invoices-tab">
                            @livewire("company-invoices",["company"=>$company])
                        </div>
                        <div class="hidden p-4" id="products" role="tabpanel"
                             aria-labelledby="products-tab">
                            @livewire("company-products",["company"=>$company])
                        </div>
                        <div class="hidden p-4" id="customers" role="tabpanel"
                             aria-labelledby="customers-tab">
                            @livewire("company-customers",["company"=>$company])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

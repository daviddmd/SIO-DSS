<div>
    <div class="mb-6">
        <label for="year"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Year")}}</label>
        <select wire:model="year" id="year"
                class="form-select w-full appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            @foreach($years as $year)
                <option
                    value="{{ $year }}">
                    {{ $year  }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Invoiced Amount")}}</h2>
    <div class="text-center">
        <b>{{$invoicedAmount}}€</b>
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Taxed Amount")}}</h2>
    <div class="text-center">
        <b>{{$taxAmount}}€</b>
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <div class="flex justify-center">
        <div class="h-96">
            <livewire:livewire-pie-chart
                key="{{$amountSoldFamilyPieChart->reactiveKey()}}"
                :pie-chart-model="$amountSoldFamilyPieChart"
            />
        </div>
        <div class="h-96">
            <livewire:livewire-pie-chart
                key="{{$numberSalesFamilyPieChart->reactiveKey()}}"
                :pie-chart-model="$numberSalesFamilyPieChart"
            />
        </div>
        <div class="h-96">
            <livewire:livewire-pie-chart
                key="{{$topCustomersByNumberSales->reactiveKey()}}"
                :pie-chart-model="$topCustomersByNumberSales"
            />
        </div>
        <div class="h-96">
            <livewire:livewire-pie-chart
                key="{{$citiesPieChart->reactiveKey()}}"
                :pie-chart-model="$citiesPieChart"
            />
        </div>
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <div class="h-[40rem]">
        <livewire:livewire-column-chart
            key="{{$citiesBarChart->reactiveKey()}}"
            :column-chart-model="$citiesBarChart"
        />
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <h3 class="text-center text-2xl font-normal leading-normal mt-0">{{__("Top Customers By Volume of Sales")}}</h3>
    <div class="h-[40rem]">
        <livewire:livewire-column-chart
            key="{{$topCustomersByVolumeSales->reactiveKey()}}"
            :column-chart-model="$topCustomersByVolumeSales"
        />
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <h3 class="text-center text-2xl font-normal leading-normal mt-0">{{__("Top Products By Number of Units Sold")}}</h3>
    <div class="h-[40rem]">
        <livewire:livewire-column-chart
            key="{{$topProductsByNumberSold->reactiveKey()}}"
            :column-chart-model="$topProductsByNumberSold"
        />
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <h3 class="text-center text-2xl font-normal leading-normal mt-0">{{__("Top Products By Amount Billed")}}</h3>
    <div class="h-[40rem]">
        <livewire:livewire-column-chart
            key="{{$topProductsByAmountBilled->reactiveKey()}}"
            :column-chart-model="$topProductsByAmountBilled"
        />
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <div class="h-[40rem]">
        <livewire:livewire-line-chart
            key="{{$salesAmountLineChart->reactiveKey()}}"
            :line-chart-model="$salesAmountLineChart"
        />
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
    <div class="h-[40rem]">
        <livewire:livewire-line-chart
            key="{{$salesNumberLineChart->reactiveKey()}}"
            :line-chart-model="$salesNumberLineChart"
        />
    </div>
    <div class="flex-grow border-t border-gray-400"></div>
</div>

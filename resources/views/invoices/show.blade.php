<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Invoice")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <label for="invoice_number"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Invoice Number")}}</label>
                        <input type="text" id="invoice_number" name="invoice_number"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->invoice_number}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="invoice_date"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Invoice Date")}}</label>
                        <input type="date" id="invoice_date" name="invoice_date"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->invoice_date}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="customer"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Customer")}}</label>
                        <input type="text" id="customer" name="customer"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->customer->name}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="shipping_city"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Shipping City")}}</label>
                        <input type="text" id="shipping_city" name="shipping_city"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->shipping_city}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="shipping_country"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Shipping Country")}}</label>
                        <input type="text" id="shipping_country" name="shipping_country"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->shipping_country}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="invoice_type"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Invoice Type")}}</label>
                        <input type="text" id="invoice_type" name="invoice_type"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{__("enums.".$invoice->invoice_type->name)}}"
                               disabled>
                    </div>


                    <div class="mb-6">
                        <label for="taxPayable"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Tax Payable Amount")}}</label>
                        <input type="number" id="taxPayable" name="taxPayable"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->taxPayable}}"
                               disabled>
                    </div>

                    <div class="mb-6">
                        <label for="grossTotal"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Gross Total Amount")}}</label>
                        <input type="number" id="grossTotal" name="grossTotal"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->grossTotal}}"
                               disabled>
                    </div>

                    <div class="mb-6">
                        <label for="netTotal"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Net Total Amount")}}</label>
                        <input type="number" id="netTotal" name="netTotal"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$invoice->netTotal}}"
                               disabled>
                    </div>

                    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Invoice Lines")}}</h2>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__("Product")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Quantity")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Unit Price")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Tax Percentage")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Total Amount")}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->lines as $line)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                                <td class="px-6 py-4">{{$line->product->description}}</td>
                                <td class="px-6 py-4">{{$line->quantity}}</td>
                                <td class="px-6 py-4">{{$line->unitPrice}}</td>
                                <td class="px-6 py-4">{{$line->taxPercentage}}</td>
                                <td class="px-6 py-4">{{$line->amount}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

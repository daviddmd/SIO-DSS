<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{__("Customer")}}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
                        <input type="text" id="name" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->name}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="tax_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Tax ID")}}</label>
                        <input type="text" id="tax_id" name="tax_id"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->tax_id}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="account_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Account ID")}}</label>
                        <input type="text" id="account_id" name="account_id"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->account_id}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="primavera_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Primavera ID")}}</label>
                        <input type="text" id="primavera_id" name="primavera_id"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->primavera_id}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="phone"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Phone")}}</label>
                        <input type="text" id="phone" name="phone"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->phone}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="email"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Email")}}</label>
                        <input type="text" id="email" name="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->email}}"
                               disabled>
                    </div>
                    <div class="mb-6">
                        <label for="invoicesNetSum"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Sum of Invoicing")}}</label>
                        <input type="text" id="invoicesNetSum" name="invoicesNetSum"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{$customer->invoicesNetSum()}}€"
                               disabled>
                    </div>
                    <h2 class="text-center text-2xl font-normal leading-normal mt-0 mb-2">{{__("Invoices")}}</h2>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__("ID")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Reference")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Date")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Customer")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Type")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Total")}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{__("Action")}}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer->invoices as $invoice)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                                <td class="px-6 py-4">{{$invoice->id}}</td>
                                <td class="px-6 py-4">{{$invoice->invoice_number}}</td>
                                <td class="px-6 py-4">{{$invoice->invoice_date}}</td>
                                <td class="px-6 py-4"><a
                                        href="{{route("customers.show",$invoice->customer->id)}}">{{$invoice->customer->name}}</a></td>
                                <td class="px-6 py-4">{{__("enums.".$invoice->invoice_type->name)}}</td>
                                <td class="px-6 py-4">{{$invoice->netTotal}}€</td>
                                <td class="px-6 py-4">
                                    <a href="{{route("invoices.show",$invoice->id)}}"
                                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        {{__("View")}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

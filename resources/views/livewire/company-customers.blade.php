<div>
    <input
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        type="text" wire:model="search" placeholder="{{__("Customer Name, Tax ID, Phone or E-Mail")}}">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                {{__("Name")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Tax ID")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Phone")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("E-Mail")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("# Invoices")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Sum of Invoicing")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Action")}}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                <td class="px-6 py-4">{{$customer->name}}</td>
                <td class="px-6 py-4">{{$customer->tax_id}}</td>
                <td class="px-6 py-4">{{$customer->phone}}</td>
                <td class="px-6 py-4">{{$customer->email}}</td>
                <td class="px-6 py-4">{{$customer->invoices->count()}}</td>
                <td class="px-6 py-4">{{$customer->invoicesNetSum()}}€</td>
                <td class="px-6 py-4">
                    <a href="{{route("customers.show",$customer->id)}}"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{__("View")}}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$customers->links()}}

</div>

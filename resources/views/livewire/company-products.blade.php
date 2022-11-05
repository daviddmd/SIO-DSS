<div>

    <input
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        type="text" wire:model="search" placeholder="{{__("Product Description or Code")}}">
    <div class="mb-6">
        <label for="family"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Family")}}</label>
        <select wire:model="family" id="family"
                class="form-select w-full appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option value="" selected>{{__("Any")}}</option>
            @foreach($families as $family)
                <option
                    value="{{ $family->family }}" {{$family == $family->family ? "selected" : ""}}>
                    {{ $family->family  }}
                </option>
            @endforeach
        </select>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate">
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                {{__("Description")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Code")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Family")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Type")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("# Sales")}}
            </th>
            <th scope="col" class="px-6 py-3">
                {{__("Sum of Sales")}}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900">
                <td class="px-6 py-4">{{$product->description}}</td>
                <td class="px-6 py-4">{{$product->code}}</td>
                <td class="px-6 py-4">{{$product->family}}</td>
                <td class="px-6 py-4">{{__("enums.".$product->type->name)}}</td>
                <td class="px-6 py-4">{{$product->numberSales()}}</td>
                <td class="px-6 py-4">{{$product->sumSales()}}€</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}


</div>

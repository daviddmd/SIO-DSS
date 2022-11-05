<div class="mb-6">
    <label for="id"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("ID")}}</label>
    <input type="text" id="id"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->id}}"
           disabled>
</div>
<div class="mb-6">
    <label for="name"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Name")}}</label>
    <input type="text" id="name" name="name"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->name}}"
           disabled>
</div>
<div class="mb-6">
    <label for="tax_registration_number"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Tax Registration Number")}}</label>
    <input type="text" id="tax_registration_number" name="tax_registration_number"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->tax_registration_number}}"
           disabled>
</div>
@if(!empty($company->phone))
    <div class="mb-6">
        <label for="phone"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Phone")}}</label>
        <input type="text" id="phone" name="phone"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               value="{{$company->phone}}"
               disabled>
    </div>
@endif
@if(!empty($company->fax))
    <div class="mb-6">
        <label for="phone"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Fax")}}</label>
        <input type="text" id="fax" name="fax"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               value="{{$company->fax}}"
               disabled>
    </div>
@endif
@if(!empty($company->email))
    <div class="mb-6">
        <label for="email"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("E-Mail")}}</label>
        <input type="text" id="email" name="email"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               value="{{$company->email}}"
               disabled>
    </div>
@endif
@if(!empty($company->website))
    <div class="mb-6">
        <label for="website"
               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Website")}}</label>
        <input type="text" id="website" name="website"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               value="{{$company->website}}"
               disabled>
    </div>
@endif
<div class="mb-6">
    <label for="address"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Address")}}</label>
    <input type="text" id="address" name="address"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->address_detail}}"
           disabled>
</div>
<div class="mb-6">
    <label for="city"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("City")}}</label>
    <input type="text" id="city" name="city"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->address_city}}"
           disabled>
</div>
<div class="mb-6">
    <label for="postal_code"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Postal Code")}}</label>
    <input type="text" id="postal_code" name="postal_code"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->address_postal_code}}"
           disabled>
</div>
<div class="mb-6">
    <label for="country"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{__("Country")}}</label>
    <input type="text" id="country" name="country"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           value="{{$company->address_country}}"
           disabled>
</div>

<form method="POST" action="{{route("companies.destroy",$company->id)}}">
    @csrf
    @method("DELETE")
    <div class="flex justify-center">
        <button type="submit"
                onclick="return confirm('Are you sure you want to delete this company?')"
                class="focus:outline-none w-full sm:w-auto px-5 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{{__("Delete")}}</button>
    </div>

</form>

<div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Search</label>
        <div class="mt-1">
            <input wire:model="searchQuery" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Search for product...">
        </div>
    </div>

    <div>
        <label for="location" class="block text-sm font-medium text-gray-700">Category</label>
        <select wire:model="searchCategory" name="category" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            <option>-- choose Category--</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div wire:loading.block class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    Table Loading...</p>
            </div>
        </div>
    </div>
<table wire:loading.class="bg-gray"class="min-w-full divide-y divide-gray-300 mb-2">
    <thead class="bg-gray-50">
    <tr>
        <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">Name</th>
        <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">Description</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
    @forelse ($products as $products)
        <tr>
            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                {{ $products->name }}
            </td>
            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                {{ $products->description }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Edit</a>
                <a onclick="confirm('Are you sure you want delete this?') || event.stopImmediatePropagation()" wire:click="deleteProduct('{{$products->id}}')"
                   class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Delete</a>

            </td>
        </tr>
    @empty
        <tr>
            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                No Products found!
            </td>
        </tr>
    @endforelse
    <!-- More people... -->
    </tbody>
    </table>
    <div class="mx-6 mb-6">
    {{ $products->paginate() }}
        </div>
</div>

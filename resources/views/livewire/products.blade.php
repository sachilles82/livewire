<div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Search</label>
        <div class="mt-1">
            <input wire:model="searchQuery" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Search for product...">
        </div>
    </div>

    <div>
        <label for="location" class="block text-sm font-medium text-gray-700">Category</label>
        <select name="category" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            <option>-- choose Category--</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>



<table class="min-w-full divide-y divide-gray-300 mb-2">
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
                <a href="" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                <a href="" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>

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

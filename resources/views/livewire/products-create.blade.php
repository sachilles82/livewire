                    <form method="POST" wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">
                        <div class="pt-0">
                                <div>
                                    <h3 class="text-base font-semibold leading-6 text-gray-900">Create Product Seite</h3>
                                    <p class="mt-1 text-sm text-gray-500">Das ist ein livewire component um ein Product zu erstellen</p>
                                </div>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-12">
                                    <div class="sm:col-span-6">
                                        <label for="first-name" class="block text-sm font-medium text-gray-700">Product Name</label>
                                        <div class="mt-1">
                                            <input wire:model="product.name" type="text" autocomplete="given-name" class=" @error('product.name')is invalid @enderror block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @error('product.name')<p class="text-sm text-yellow-700">{{$message}}</p>@enderror
                                         </div>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Product Category</label>
                                        <div class="mt-1">
                                            <select wire:model="product.category_id" autocomplete="country-name" class="@error('product.category_id')is invalid @enderror block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                <option>--choose--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product.category_id')<p class="text-sm text-yellow-700">{{$message}}</p>@enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-12">
                                        <label for="about" class="block text-sm font-medium text-gray-700">Description</label>
                                        <div class="mt-1">
                                            <textarea wire:model="product.description" rows="3" class="@error('product.description')is invalid @enderror block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                            @error('product.description')<p class="text-sm text-yellow-700">{{$message}}</p>@enderror
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">Write a few sentences about the product.</p>
                                    </div>
                                </div>
                            </div>
                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{ __('Save Product') }}</button>
                            </div>
                        </div>
                    </form>

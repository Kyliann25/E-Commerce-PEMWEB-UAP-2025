<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 md:p-8 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="name" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Product Name</label>
                        <input type="text" name="name" id="name" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="e.g. OVERSIZED TEE">
                    </div>

                    <div class="mb-6">
                        <label for="product_category_id" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Category</label>
                        <select name="product_category_id" id="product_category_id" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required>
                            <option value="">SELECT CATEGORY</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="price" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Price (Rp)</label>
                            <input type="number" name="price" id="price" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="0">
                        </div>
                        <div>
                            <label for="stock" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Stock</label>
                            <input type="number" name="stock" id="stock" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="0">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="Product details..."></textarea>
                    </div>

                    <div class="mb-8">
                        <label for="image" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Product Image</label>
                        <input type="file" name="image" id="image" class="w-full border-2 border-gray-300 p-2 rounded-none focus:border-hubbub-black focus:ring-0 font-sans file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-0 file:text-xs file:font-semibold file:bg-hubbub-black file:text-white hover:file:bg-hubbub-pink transition-all" accept="image/*" required>
                    </div>

                    <div class="flex justify-between items-center gap-4">
                        <a href="{{ route('seller.products') }}" class="text-hubbub-black font-header font-bold uppercase text-xs hover:text-hubbub-pink transition-colors">Cancel</a>
                        <button type="submit" class="bg-hubbub-black text-white font-header font-bold uppercase px-8 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors shadow-md">
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h3 class="font-header text-xl font-bold uppercase text-hubbub-black">My Products</h3>
                    <a href="{{ route('seller.products.create') }}" class="w-full sm:w-auto text-center bg-hubbub-black text-white font-header font-bold uppercase px-6 py-2 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors shadow-sm">Add New Product</a>
                </div>

                @if($products->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Image</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Name</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Price</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Stock</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Status</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="hover:bg-pink-50 transition-colors">
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex-shrink-0 w-12 h-12 border border-gray-200 bg-gray-50">
                                                @if($product->productImages->first())
                                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $product->productImages->first()->image) }}" alt="" />
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 font-header uppercase">No IMG</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <p class="font-bold text-hubbub-black uppercase">{{ $product->name }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <p class="font-header font-bold text-hubbub-pink">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm font-mono">
                                            {{ $product->stock }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <span class="relative inline-block px-3 py-1 text-xs font-header font-bold uppercase leading-tight {{ $product->is_active ? 'text-green-900' : 'text-red-900' }}">
                                                <span aria-hidden="true" class="absolute inset-0 {{ $product->is_active ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-sm"></span>
                                                <span class="relative">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-hubbub-pink hover:text-red-600 font-header font-bold uppercase text-xs transition-colors">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-gray-200 bg-gray-50">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <p class="font-header text-xl font-bold uppercase text-gray-400 mb-4">No products found</p>
                        <a href="{{ route('seller.products.create') }}" class="inline-block bg-hubbub-black text-white font-header font-bold uppercase px-8 py-3 hover:bg-hubbub-pink transition-colors">Start Selling</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

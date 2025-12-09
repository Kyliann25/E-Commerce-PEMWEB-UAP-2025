<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Image Section --}}
                <div class="space-y-4">
                    @if($product->productImages->first())
                        <div class="aspect-[4/5] bg-gray-100 w-full overflow-hidden relative group">
                                <img src="{{ asset('storage/' . $product->productImages->first()->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                        {{-- Thumbnails if more than 1 --}}
                        @if($product->productImages->count() > 1)
                            <div class="flex space-x-2 overflow-x-auto pb-2">
                                @foreach($product->productImages as $img)
                                    <div class="w-24 h-24 flex-shrink-0 cursor-pointer border border-transparent hover:border-hubbub-black transition-colors">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="aspect-[4/5] bg-gray-100 w-full flex items-center justify-center">
                            <span class="font-header text-gray-400 uppercase text-xl">No Image</span>
                        </div>
                    @endif
                </div>

                {{-- Details Section --}}
                <div class="flex flex-col h-full">
                    <div class="mb-4">
                        <p class="text-xs md:text-sm text-gray-500 uppercase tracking-widest mb-2">{{ $product->store->name }}</p>
                        <h1 class="font-header text-3xl md:text-5xl font-bold uppercase tracking-tighter leading-none mb-4">{{ $product->name }}</h1>
                        <p class="font-header text-2xl md:text-3xl font-bold text-hubbub-pink">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="prose prose-sm font-sans text-gray-700 mb-8 max-w-none">
                        <h3 class="font-header text-lg font-bold uppercase mb-2">Description</h3>
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8 border-y border-gray-100 py-4 font-sans text-sm">
                        <div>
                            <span class="font-bold uppercase text-xs text-gray-500 block mb-1">Condition</span>
                            {{ ucfirst($product->condition) }}
                        </div>
                        <div>
                            <span class="font-bold uppercase text-xs text-gray-500 block mb-1">Weight</span>
                            {{ $product->weight }} gr
                        </div>
                        <div>
                            <span class="font-bold uppercase text-xs text-gray-500 block mb-1">Location</span>
                            {{ $product->store->city }}
                        </div>
                        <div>
                            <span class="font-bold uppercase text-xs text-gray-500 block mb-1">Stock</span>
                            {{ $product->stock }} items
                        </div>
                    </div>

                    {{-- Add to Cart --}}
                    @auth
                        <form action="{{ route('cart.store') }}" method="POST" class="mt-auto">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="flex items-end gap-6">
                                <div class="w-24">
                                     <label for="quantity" class="font-header font-bold uppercase text-xs mb-2 block">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full border-2 border-gray-200 p-3 text-center font-bold focus:border-hubbub-black focus:ring-0">
                                </div>

                                <button type="submit" class="flex-1 bg-hubbub-black text-white font-header font-bold uppercase text-lg py-4 hover:bg-hubbub-pink transition-colors">
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="bg-gray-100 p-4 text-center mt-auto">
                            <p class="font-header uppercase font-bold mb-2">Want to cop this?</p>
                            <a href="{{ route('login') }}" class="inline-block border-b-2 border-black font-bold hover:text-hubbub-pink hover:border-hubbub-pink transition-colors">Login to purchase</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

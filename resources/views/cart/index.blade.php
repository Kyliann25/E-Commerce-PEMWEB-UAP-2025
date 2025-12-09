<x-app-layout>
    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-header text-4xl font-bold uppercase text-hubbub-black tracking-tighter mb-8">Your Cart</h1>
            
            @if($carts->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    {{-- Cart Items Column (Span 2) --}}
                    <div class="lg:col-span-2 space-y-8">
                        @foreach($carts->groupBy('product.store.name') as $storeName => $storeItems)
                            @php
                                $storeId = $storeItems->first()->product->store_id;
                                $storeTotal = $storeItems->sum(fn($item) => $item->product->price * $item->quantity);
                            @endphp
                            {{-- Store Card --}}
                            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                                {{-- Card Header --}}
                                <div class="flex items-center gap-3 p-4 border-b-2 border-gray-100 bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-hubbub-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h3 class="font-header text-lg font-bold uppercase text-hubbub-black tracking-wide">{{ $storeName }}</h3>
                                </div>

                                {{-- Items List --}}
                                <div class="p-6 space-y-6">
                                    @foreach($storeItems as $item)
                                        <div class="flex gap-4 sm:gap-6">
                                            {{-- Product Image --}}
                                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0 border border-gray-200">
                                                @if($item->product->productImages->first())
                                                    <img src="{{ asset('storage/' . $item->product->productImages->first()->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-xs text-gray-400 font-header uppercase">No IMG</div>
                                                @endif
                                            </div>

                                            {{-- Product Details --}}
                                            <div class="flex-1 flex flex-col sm:flex-row sm:justify-between gap-4">
                                                <div class="flex-1">
                                                    <h4 class="font-header text-lg font-bold uppercase text-hubbub-black leading-tight mb-1">
                                                        <a href="{{ route('product.details', $item->product->slug) }}" class="hover:text-hubbub-pink transition-colors">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h4>
                                                    <p class="font-sans text-xs text-gray-500 mb-2 uppercase tracking-wide">{{ $item->product->productCategory->name ?? 'Uncategorized' }}</p>
                                                    <p class="font-header text-base font-bold text-hubbub-pink">
                                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                                    </p>
                                                </div>

                                                {{-- Actions --}}
                                                <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-between gap-2">
                                                    {{-- Delete --}}
                                                     <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1" title="Remove Item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                    {{-- Quantity --}}
                                                    <div class="flex items-center border-2 border-hubbub-black">
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                                            <button type="submit" class="w-8 h-8 flex items-center justify-center text-hubbub-black hover:bg-hubbub-black hover:text-white font-bold transition-colors {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                                        </form>
                                                        
                                                        <div class="w-10 h-8 flex items-center justify-center font-header font-bold text-sm text-hubbub-black select-none border-x-2 border-hubbub-black">
                                                            {{ $item->quantity }}
                                                        </div>

                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                            <button type="submit" class="w-8 h-8 flex items-center justify-center text-hubbub-black hover:bg-hubbub-black hover:text-white font-bold transition-colors">+</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Card Footer --}}
                                <div class="bg-hubbub-black p-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                                    <div class="text-white text-center sm:text-left">
                                        <p class="text-[10px] uppercase font-bold tracking-widest opacity-70">Subtotal</p>
                                        <p class="font-header text-xl font-bold">Rp {{ number_format($storeTotal, 0, ',', '.') }}</p>
                                    </div>
                                    <a href="{{ route('checkout.index', ['store_id' => $storeId]) }}" class="bg-hubbub-pink text-white font-header font-bold uppercase px-6 py-2 border-2 border-transparent hover:bg-white hover:text-hubbub-pink hover:border-hubbub-pink transition-colors text-sm tracking-wider shadow-sm w-full sm:w-auto text-center">
                                        Checkout
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Summary Column (Span 1) --}}
                    <div>
                        <div class="bg-white p-6 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] sticky top-24">
                            <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-6 border-b-2 border-gray-100 pb-4">Cart Summary</h3>
                            
                            <div class="flex justify-between items-center mb-4">
                                <span class="font-header font-bold uppercase text-sm text-gray-500">Total Items</span>
                                <span class="font-header font-bold text-lg">{{ $carts->sum('quantity') }}</span>
                            </div>

                            <div class="flex justify-between items-end mb-8 pt-4 border-t-2 border-gray-100">
                                <span class="font-header text-lg font-bold uppercase text-hubbub-black">Grand Total</span>
                                <span class="font-header text-2xl font-bold text-hubbub-pink">
                                    @php
                                        $total = $carts->sum(function($item) {
                                            return $item->product->price * $item->quantity;
                                        });
                                    @endphp
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>

                            <p class="text-xs text-center text-gray-400 mb-6 font-sans">
                                Complete your purchase by checking out each store individually.
                            </p>
                            
                            <a href="{{ route('home') }}" class="block w-full text-center bg-gray-100 text-hubbub-black font-header font-bold uppercase py-3 border-2 border-transparent hover:bg-hubbub-black hover:text-white transition-colors">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white p-12 text-center border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] max-w-2xl mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h2 class="font-header text-2xl font-bold uppercase text-hubbub-black mb-2">Your cart is empty</h2>
                    <p class="text-gray-500 mb-8 font-sans">Looks like you haven't added anything yet.</p>
                    <a href="{{ route('home') }}" class="inline-block bg-hubbub-black text-white font-header font-bold uppercase px-8 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors shadow-md">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

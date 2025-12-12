<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-hubbub-black text-white py-12 md:py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 space-y-6">
                <p class="text-hubbub-pink font-header font-bold text-lg md:text-xl uppercase tracking-widest">Big News!</p>
                <h1 class="font-header text-5xl sm:text-6xl md:text-8xl font-bold uppercase leading-none tracking-tighter">
                    All Cats Are <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">Blind Drop!</span>
                </h1>
                <p class="text-gray-400 text-base md:text-xl font-sans max-w-md">
                    Grab yours before it's gone. Limited stock available for this exclusive release.
                </p>
                <div class="pt-4">
                     <a href="#new-drops" class="inline-block bg-hubbub-pink text-white font-header font-bold text-base md:text-lg px-6 md:px-8 py-3 md:py-4 uppercase tracking-wider hover:bg-pink-600 transition-colors transform hover:-translate-y-1">
                        Shop Now
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 mt-12 md:mt-0 relative">
                <!-- Abstract Graphic / Placeholder for Hero Image -->
                <div class="relative z-10 bg-gray-800 rounded-sm p-4 rotate-3 transform transition-transform hover:rotate-0 duration-500">
                     <div class="bg-hubbub-black border-4 border-white p-2">
                        <div class="aspect-square bg-gray-700 flex items-center justify-center relative overflow-hidden group">
                             <img src="{{ asset('storage/hero-metro.jpg') }}" alt="Hero" class="object-cover w-full h-full opacity-80 group-hover:scale-110 transition-transform duration-700">
                             <div class="absolute inset-0 flex items-center justify-center">
                                <h2 class="font-header text-4xl md:text-6xl text-white opacity-20 rotate-45 select-none">HUBBUB</h2>
                             </div>
                        </div>
                     </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-16 h-16 md:w-24 md:h-24 bg-hubbub-pink rounded-full blur-3xl opacity-50"></div>
                <div class="absolute -bottom-10 -left-10 w-24 h-24 md:w-32 md:h-32 bg-purple-600 rounded-full blur-3xl opacity-50"></div>
            </div>
        </div>
    </div>

    {{-- Category Filter Bar --}}
    <div class="border-b border-gray-200 bg-white sticky top-20 z-40">
        <style>
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
        <div class="max-w-7xl mx-auto">
             <div class="overflow-x-auto hide-scrollbar py-3 md:py-4">
                <div class="flex items-center px-4 sm:px-6 lg:px-8 gap-4 md:gap-8">
                    <a href="{{ route('home') }}" class="flex-shrink-0 text-xs md:text-sm font-header font-bold uppercase tracking-wide hover:text-hubbub-pink transition-colors {{ !request('category') ? 'text-hubbub-pink underline decoration-2 underline-offset-4' : 'text-gray-500' }}">All</a>
                    @foreach($categories as $category)
                        <a href="{{ route('home', ['category' => $category->slug]) }}" class="flex-shrink-0 text-xs md:text-sm font-header font-bold uppercase tracking-wide hover:text-hubbub-pink transition-colors {{ request('category') == $category->slug ? 'text-hubbub-pink underline decoration-2 underline-offset-4' : 'text-gray-500' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- New Drops Section --}}
    <div id="new-drops" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="text-center mb-8 md:mb-12">
            <h2 class="font-header text-3xl md:text-4xl font-bold uppercase tracking-tighter mb-2">New Drops</h2>
            <div class="w-12 md:w-16 h-1 bg-hubbub-pink mx-auto"></div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8">
            @forelse($products as $product)
                <div class="group flex flex-col">
                    <div class="relative overflow-hidden bg-gray-100 aspect-[4/5] mb-4">
                        <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-full">
                            @if($product->productImages->first())
                                <img src="{{ asset('storage/' . $product->productImages->first()->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 font-header uppercase">No Image</div>
                            @endif
                        </a>
                        <!-- Quick Add overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                             @auth
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-full bg-hubbub-black text-white font-header font-bold uppercase text-xs py-3 hover:bg-hubbub-pink transition-colors">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block text-center w-full bg-hubbub-black text-white font-header font-bold uppercase text-xs py-3 hover:bg-hubbub-pink transition-colors">
                                    Login to Buy
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <h3 class="font-header text-base md:text-lg font-bold uppercase tracking-tight leading-tight mb-1">
                            <a href="{{ route('product.details', $product->slug) }}" class="hover:text-hubbub-pink transition-colors">{{ $product->name }}</a>
                        </h3>
                        <p class="font-header text-hubbub-pink font-bold text-sm md:text-md">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50">
                    <p class="font-header text-gray-400 text-xl uppercase">No products found in this category.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-8 md:mt-12 flex justify-center">
            <a href="#" class="border-2 border-hubbub-black text-hubbub-black font-header font-bold uppercase px-8 py-3 text-sm hover:bg-hubbub-black hover:text-white transition-colors">
                View All New Arrivals
            </a>
        </div>
    </div>
    
    {{-- Pagination --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        {{ $products->links() }}
    </div>

    {{-- Vibe Section --}}
    <div class="bg-gray-50 py-12 md:py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="font-header text-2xl md:text-3xl font-bold uppercase tracking-tighter mb-2">Our Vibe. Our Collection.</h2>
                <div class="w-12 md:w-16 h-1 bg-hubbub-pink mx-auto"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="aspect-square bg-gray-200 overflow-hidden relative group">
                     <img src="{{ asset('storage/products/model coklat 2.jpg') }}" class="object-cover w-full h-full opacity-90 group-hover:scale-110 transition-transform duration-700" alt="Vibe 1">
                     <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                </div>
                <div class="aspect-square bg-gray-200 overflow-hidden relative group">
                     <img src="{{ asset('storage/products/model putih.jpg') }}" class="object-cover w-full h-full opacity-90 group-hover:scale-110 transition-transform duration-700" alt="Vibe 2">
                </div>
                 <div class="aspect-square bg-gray-200 overflow-hidden relative group">
                     <img src="{{ asset('storage/products/model-black.jpg') }}" class="object-cover w-full h-full opacity-90 group-hover:scale-110 transition-transform duration-700" alt="Vibe 3">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="bg-hubbub-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-header text-5xl font-bold uppercase tracking-tighter mb-4">Our Collection</h1>
            <p class="text-gray-400 font-sans max-w-2xl mx-auto">Explore the latest drops from Hubbub. Authentic streetwear for the bold.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Category Filter --}}
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="{{ route('collection') }}" class="px-6 py-2 border-2 {{ !request('category') ? 'border-hubbub-black bg-hubbub-black text-white' : 'border-gray-200 text-gray-600 hover:border-hubbub-black hover:text-hubbub-black' }} font-header font-bold uppercase transition-colors">All</a>
            @foreach($categories as $category)
                <a href="{{ route('collection', ['category' => $category->slug]) }}" class="px-6 py-2 border-2 {{ request('category') == $category->slug ? 'border-hubbub-black bg-hubbub-black text-white' : 'border-gray-200 text-gray-600 hover:border-hubbub-black hover:text-hubbub-black' }} font-header font-bold uppercase transition-colors">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- Products Grid --}}
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
                        <h3 class="font-header text-lg font-bold uppercase tracking-tight leading-tight mb-1">
                            <a href="{{ route('product.details', $product->slug) }}" class="hover:text-hubbub-pink transition-colors">{{ $product->name }}</a>
                        </h3>
                        <p class="font-header text-hubbub-pink font-bold text-md">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50">
                    <p class="font-header text-gray-400 text-xl uppercase">No products found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>

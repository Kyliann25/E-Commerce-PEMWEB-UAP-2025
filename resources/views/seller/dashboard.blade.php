<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
                {{ __('Seller Dashboard') }} <span class="text-gray-400 mx-2">//</span> <span class="text-hubbub-pink">{{ $store->name }}</span>
            </h2>
            <div>
                 @if(!$store->is_verified)
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-header font-bold uppercase px-3 py-1 border border-yellow-200 shadow-sm">Pending Verification</span>
                 @else
                    <span class="bg-green-100 text-green-800 text-xs font-header font-bold uppercase px-3 py-1 border border-green-200 shadow-sm">Verified Store</span>
                 @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Stats Cards --}}
                <div class="bg-white p-6 border-2 border-hubbub-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="text-gray-500 text-xs font-bold font-header uppercase mb-2 tracking-widest">Total Sales</div>
                    <div class="text-3xl font-header font-bold text-hubbub-pink">Rp {{ number_format($sales, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white p-6 border-2 border-hubbub-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="text-gray-500 text-xs font-bold font-header uppercase mb-2 tracking-widest">Total Orders</div>
                    <div class="text-3xl font-header font-bold text-hubbub-black">{{ $orderCount }}</div>
                </div>
                <div class="bg-white p-6 border-2 border-hubbub-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
                    <div class="text-gray-500 text-xs font-bold font-header uppercase mb-2 tracking-widest">Quick Actions</div>
                    <div class="flex space-x-2">
                        <a href="{{ route('seller.products.create') }}" class="flex-1 bg-hubbub-black text-white text-center px-2 py-2 text-xs font-bold font-header uppercase hover:bg-hubbub-pink transition-colors">Add Product</a>
                        <a href="{{ route('seller.balance') }}" class="flex-1 border-2 border-hubbub-black text-hubbub-black text-center px-2 py-1.5 text-xs font-bold font-header uppercase hover:bg-hubbub-black hover:text-white transition-colors">Check Balance</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Sidebar Navigation (Simple) --}}
                <div class="bg-white p-0 border-2 border-gray-200">
                    <nav class="flex flex-col">
                        <a href="{{ route('seller.dashboard') }}" class="block px-6 py-4 font-header font-bold uppercase text-sm border-l-4 {{ request()->routeIs('seller.dashboard') ? 'border-hubbub-pink bg-pink-50 text-hubbub-pink' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-hubbub-black' }} transition-colors">Dashboard</a>
                        <a href="{{ route('seller.products') }}" class="block px-6 py-4 font-header font-bold uppercase text-sm border-l-4 {{ request()->routeIs('seller.products*') ? 'border-hubbub-pink bg-pink-50 text-hubbub-pink' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-hubbub-black' }} transition-colors">Products</a>
                        <a href="{{ route('seller.orders') }}" class="block px-6 py-4 font-header font-bold uppercase text-sm border-l-4 {{ request()->routeIs('seller.orders*') ? 'border-hubbub-pink bg-pink-50 text-hubbub-pink' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-hubbub-black' }} transition-colors">Orders</a>
                        <a href="{{ route('seller.balance') }}" class="block px-6 py-4 font-header font-bold uppercase text-sm border-l-4 {{ request()->routeIs('seller.balance*') ? 'border-hubbub-pink bg-pink-50 text-hubbub-pink' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-hubbub-black' }} transition-colors">Balance & History</a>
                        <a href="{{ route('seller.withdrawals') }}" class="block px-6 py-4 font-header font-bold uppercase text-sm border-l-4 {{ request()->routeIs('seller.withdrawals*') ? 'border-hubbub-pink bg-pink-50 text-hubbub-pink' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-hubbub-black' }} transition-colors">Withdrawals</a>
                        <a href="{{ route('seller.profile') }}" class="block px-6 py-4 font-header font-bold uppercase text-sm border-l-4 {{ request()->routeIs('seller.profile*') ? 'border-hubbub-pink bg-pink-50 text-hubbub-pink' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-hubbub-black' }} transition-colors">Store Settings</a>
                    </nav>
                </div>

                {{-- Main Content Area Placeholder --}}
                <div class="md:col-span-3 bg-white p-8 border-2 border-gray-100 shadow-sm">
                    <h3 class="text-2xl font-header font-bold uppercase text-hubbub-black mb-4">Welcome back, Seller!</h3>
                    <p class="text-gray-500 font-sans mb-8">Ready to make some noise? Select a menu item from the sidebar to manage your store inventory, orders, and earnings.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

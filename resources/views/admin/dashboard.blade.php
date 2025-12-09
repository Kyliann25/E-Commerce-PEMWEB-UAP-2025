<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200">
                     <div class="text-gray-500 text-xs font-bold font-header uppercase mb-2 tracking-widest">Total Users</div>
                     <div class="text-4xl font-header font-bold text-hubbub-pink">{{ $usersCount }}</div>
                </div>
                <div class="bg-white p-6 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200">
                     <div class="text-gray-500 text-xs font-bold font-header uppercase mb-2 tracking-widest">Total Stores</div>
                     <div class="text-4xl font-header font-bold text-hubbub-black">{{ $storesCount }}</div>
                </div>
                <div class="bg-white p-6 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200">
                     <div class="text-gray-500 text-xs font-bold font-header uppercase mb-2 tracking-widest">Total Transactions</div>
                     <div class="text-4xl font-header font-bold text-hubbub-black">{{ $transactionsCount }}</div>
                </div>
            </div>

            <div class="bg-white p-8 border-2 border-gray-100">
                <h3 class="text-xl font-header font-bold uppercase mb-6 tracking-wide">Quick Actions</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.verification') }}" class="inline-block bg-hubbub-pink text-white font-header font-bold uppercase px-6 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-pink hover:border-hubbub-pink transition-colors tracking-wider shadow-md">
                        Verify Stores
                    </a>
                    <a href="{{ route('admin.withdrawals') }}" class="inline-block bg-hubbub-black text-white font-header font-bold uppercase px-6 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors tracking-wider shadow-md">
                         Manage Withdrawals
                    </a>
                    <a href="{{ route('admin.stores') }}" class="inline-block bg-hubbub-black text-white font-header font-bold uppercase px-6 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors tracking-wider shadow-md">
                         Manage Stores
                    </a>
                    <a href="{{ route('admin.users') }}" class="inline-block bg-hubbub-black text-white font-header font-bold uppercase px-6 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors tracking-wider shadow-md">
                        Manage Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

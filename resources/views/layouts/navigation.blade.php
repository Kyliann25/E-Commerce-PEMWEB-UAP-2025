<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <h1 class="font-header text-3xl sm:text-4xl font-bold tracking-tighter text-hubbub-black hover:text-hubbub-pink transition-colors">HUBBUB</h1>
                </a>
            </div>

            <!-- Center Navigation (Desktop) -->
            <div class="hidden sm:flex space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="font-header text-lg font-bold uppercase text-hubbub-black tracking-wide hover:text-hubbub-pink">
                    {{ __('New Arrival') }}
                </x-nav-link>
                <x-nav-link :href="route('collection')" :active="request()->routeIs('collection')" class="font-header text-lg font-bold uppercase text-hubbub-black tracking-wide hover:text-hubbub-pink">
                    {{ __('Collection') }}
                </x-nav-link>
                <x-nav-link :href="route('lookbook')" :active="request()->routeIs('lookbook')" class="font-header text-lg font-bold uppercase text-hubbub-black tracking-wide hover:text-hubbub-pink">
                    {{ __('Lookbook') }}
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="font-header text-lg font-bold uppercase text-hubbub-black tracking-wide hover:text-hubbub-pink">
                    {{ __('About') }}
                </x-nav-link>
            </div>

            <!-- Right Actions -->
            <div class="hidden sm:flex items-center space-x-6">
                
                <a href="{{ route('cart.index') }}" class="group flex items-center text-hubbub-black hover:text-hubbub-pink transition-colors relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    @if(Auth::check() && \App\Models\Cart::where('user_id', Auth::id())->count() > 0)
                        <span class="absolute -top-1 -right-2 bg-hubbub-pink text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">
                            {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                        </span>
                    @endif
                </a>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="font-header font-bold uppercase text-hubbub-black hover:text-hubbub-pink transition-colors flex items-center">
                                <div class="w-8 h-8 rounded-full bg-hubbub-black text-white flex items-center justify-center text-xs tracking-wider border-2 border-transparent hover:border-hubbub-pink transition-colors">
                                    {{ Str::upper(Str::substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 text-xs text-gray-500 font-bold font-header uppercase border-b border-gray-100">
                                Wallet: <span class="text-hubbub-pink">Rp {{ number_format(Auth::user()->balance->balance ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-100"></div>

                            @if(Auth::user()->role === 'admin')
                                <div class="px-4 py-2 text-xs font-bold text-gray-400 font-header uppercase tracking-wider bg-gray-50">Admin Zone</div>
                                <x-dropdown-link :href="route('admin.dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.users')">{{ __('Manage Users') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.stores')">{{ __('Manage Stores') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.verification')">{{ __('Verify Stores') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.withdrawals')">{{ __('Withdrawals') }}</x-dropdown-link>
                                <div class="border-t border-gray-100 my-1"></div>
                            @endif

                            @if(Auth::user()->store)
                                <div class="px-4 py-2 text-xs font-bold text-gray-400 font-header uppercase tracking-wider bg-gray-50">Seller Zone</div>
                                <x-dropdown-link :href="route('seller.dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('seller.products')">{{ __('My Products') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('seller.orders')">{{ __('Incoming Orders') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('seller.balance')">{{ __('My Finances') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('seller.profile')">{{ __('Store Settings') }}</x-dropdown-link>
                                <div class="border-t border-gray-100 my-1"></div>
                            @elseif(Auth::user()->role !== 'admin')
                                <x-dropdown-link :href="route('store.register')">{{ __('Open Store') }}</x-dropdown-link>
                                <div class="border-t border-gray-100 my-1"></div>
                            @endif
                            
                            <div class="px-4 py-2 text-xs font-bold text-gray-400 font-header uppercase tracking-wider bg-gray-50">My Account</div>
                            <x-dropdown-link :href="route('history')">{{ __('My Orders') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('wallet.topup')">{{ __('Topup Wallet') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile Settings') }}</x-dropdown-link>
                            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500 hover:text-red-600 font-bold border-t border-gray-100">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="group flex items-center text-hubbub-black hover:text-hubbub-pink transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden gap-1">
                 <a href="{{ route('cart.index') }}" class="relative inline-flex items-center justify-center p-2 rounded-md text-hubbub-black hover:text-hubbub-pink transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                     @if(Auth::check() && \App\Models\Cart::where('user_id', Auth::id())->count() > 0)
                        <span class="absolute top-1 right-0 bg-hubbub-pink text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[16px] text-center leading-none">
                            {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                        </span>
                    @endif
                </a>
                
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-hubbub-black hover:text-hubbub-pink focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="font-header uppercase font-bold">{{ __('New Arrival') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('collection')" :active="request()->routeIs('collection')" class="font-header uppercase font-bold">{{ __('Collection') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('lookbook')" :active="request()->routeIs('lookbook')" class="font-header uppercase font-bold">{{ __('Lookbook') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="font-header uppercase font-bold">{{ __('About') }}</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4 mb-4 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-hubbub-black text-white flex items-center justify-center font-header font-bold text-lg tracking-wider">
                         {{ Str::upper(Str::substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-bold text-base text-hubbub-black font-header uppercase tracking-tighter">{{ Auth::user()->name }}</div>
                         <div class="mt-1 text-xs text-hubbub-pink font-bold font-header uppercase">
                            Wallet: Rp {{ number_format(Auth::user()->balance->balance ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="space-y-1">
                    @if(Auth::user()->role === 'admin')
                        <div class="px-4 py-2 text-xs font-bold text-gray-400 font-header uppercase tracking-wider bg-gray-50">Admin Zone</div>
                        <x-responsive-nav-link :href="route('admin.dashboard')" class="font-header uppercase font-bold text-sm">{{ __('Dashboard') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.users')" class="font-header uppercase font-bold text-sm">{{ __('Manage Users') }}</x-responsive-nav-link>
                         <x-responsive-nav-link :href="route('admin.stores')" class="font-header uppercase font-bold text-sm">{{ __('Manage Stores') }}</x-responsive-nav-link>
                         <x-responsive-nav-link :href="route('admin.verification')" class="font-header uppercase font-bold text-sm">{{ __('Verify Stores') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.withdrawals')" class="font-header uppercase font-bold text-sm">{{ __('Withdrawals') }}</x-responsive-nav-link>
                    @endif

                    @if(Auth::user()->store)
                        <div class="px-4 py-2 text-xs font-bold text-gray-400 font-header uppercase tracking-wider bg-gray-50 mt-2">Seller Zone</div>
                        <x-responsive-nav-link :href="route('seller.dashboard')" class="font-header uppercase font-bold text-sm">{{ __('Dashboard') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('seller.products')" class="font-header uppercase font-bold text-sm">{{ __('My Products') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('seller.orders')" class="font-header uppercase font-bold text-sm">{{ __('Incoming Orders') }}</x-responsive-nav-link>
                         <x-responsive-nav-link :href="route('seller.balance')" class="font-header uppercase font-bold text-sm">{{ __('My Finances') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('seller.profile')" class="font-header uppercase font-bold text-sm">{{ __('Store Settings') }}</x-responsive-nav-link>
                    @elseif(Auth::user()->role !== 'admin')
                         <x-responsive-nav-link :href="route('store.register')" class="font-header uppercase font-bold text-sm mt-2">{{ __('Open Store') }}</x-responsive-nav-link>
                    @endif

                    <div class="px-4 py-2 text-xs font-bold text-gray-400 font-header uppercase tracking-wider bg-gray-50 mt-2">My Account</div>
                    <x-responsive-nav-link :href="route('history')" class="font-header uppercase font-bold text-sm">{{ __('My Orders') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('wallet.topup')" class="font-header uppercase font-bold text-sm">{{ __('Topup Wallet') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')" class="font-header uppercase font-bold text-sm">{{ __('Profile Settings') }}</x-responsive-nav-link>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="font-header uppercase font-bold text-sm !text-red-500 hover:!text-red-600 border-t border-gray-100 mt-2">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="font-header uppercase font-bold">{{ __('Log in') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="font-header uppercase font-bold">{{ __('Register') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>

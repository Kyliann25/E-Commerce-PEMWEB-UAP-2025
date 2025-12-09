<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Store Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 md:p-8 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="flex flex-col items-center justify-start">
                            <div class="mb-6 relative group">
                                <label class="block text-hubbub-black text-xs font-header font-bold uppercase mb-4 text-center tracking-widest">Current Logo</label>
                                @if($store->logo)
                                    <div class="p-2 border-2 border-hubbub-black rounded-full">
                                        <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo" class="w-48 h-48 object-cover rounded-full">
                                    </div>
                                @else
                                    <div class="w-48 h-48 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 font-header font-bold uppercase border-2 border-gray-300 border-dashed">
                                        No Logo
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4 w-full max-w-xs">
                                <label for="logo" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Change Logo</label>
                                <input type="file" name="logo" id="logo" class="w-full border-2 border-gray-300 p-2 rounded-none focus:border-hubbub-black focus:ring-0 font-sans file:mr-4 file:py-2 file:px-4 file:rounded-none file:border-0 file:text-xs file:font-semibold file:bg-hubbub-black file:text-white hover:file:bg-hubbub-pink transition-all">
                            </div>
                        </div>

                        <div>
                            <div class="mb-6">
                                <label for="name" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Store Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $store->name) }}" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required>
                            </div>

                            <div class="mb-6">
                                <label for="about" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">About Store</label>
                                <textarea name="about" id="about" rows="6" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required>{{ old('about', $store->about) }}</textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="city" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">City</label>
                                    <input type="text" name="city" id="city" value="{{ old('city', $store->city) }}" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required>
                                </div>
                                <div>
                                    <label for="address" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Address</label>
                                    <input type="text" name="address" id="address" value="{{ old('address', $store->address) }}" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required>
                                </div>
                            </div>
                            
                            <div class="mt-8 flex justify-end">
                                <button type="submit" class="bg-hubbub-black text-white font-header font-bold uppercase px-8 py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors shadow-md">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

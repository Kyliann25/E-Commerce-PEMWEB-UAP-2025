<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-header text-4xl font-bold uppercase text-hubbub-black tracking-tighter mb-8">Secure Checkout</h1>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                @if($storeId)
                    <input type="hidden" name="store_id" value="{{ $storeId }}">
                @endif
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    {{-- Left Column: Shipping & Details --}}
                    <div class="space-y-8">
                        {{-- Shipping Address --}}
                        <div class="bg-white p-6 shadow-sm border border-gray-100">
                            <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-6">Shipping Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="address" class="block font-header font-bold uppercase text-xs mb-2">Full Address</label>
                                    <textarea name="address" id="address" rows="3" class="w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0" placeholder="Street, Number, Unit..." required></textarea>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="city" class="block font-header font-bold uppercase text-xs mb-2">City</label>
                                        <input type="text" name="city" id="city" class="w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0" required>
                                    </div>
                                    <div>
                                        <label for="postal_code" class="block font-header font-bold uppercase text-xs mb-2">Postal Code</label>
                                        <input type="text" name="postal_code" id="postal_code" class="w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0" required>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="shipping_type" class="block font-header font-bold uppercase text-xs mb-2">Shipping Type</label>
                                    <select name="shipping_type" id="shipping_type" class="w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 cursor-pointer">
                                        <option value="REG">Regular (Rp 20.000) - 3-5 Days</option>
                                        <option value="YES">Next Day (Rp 35.000) - 1 Day</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="bg-white p-6 shadow-sm border border-gray-100">
                             <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-6">Payment Method</h3>
                             <div class="space-y-4">
                                 <label class="flex items-center p-4 border-2 border-gray-200 cursor-pointer hover:border-hubbub-black transition-colors has-[:checked]:border-hubbub-black has-[:checked]:bg-gray-50">
                                     <input type="radio" class="form-radio text-hubbub-black focus:ring-hubbub-black h-5 w-5" name="payment_method" value="wallet" checked>
                                     <div class="ml-4 flex-1">
                                         <span class="block font-header font-bold uppercase text-lg">My Wallet</span>
                                         <span class="block text-sm text-gray-500 font-sans">Current Balance: Rp {{ number_format(Auth::user()->balance->balance ?? 0, 0, ',', '.') }}</span>
                                     </div>
                                 </label>
                                 
                                 <label class="flex items-center p-4 border-2 border-gray-200 cursor-pointer hover:border-hubbub-black transition-colors has-[:checked]:border-hubbub-black has-[:checked]:bg-gray-50">
                                     <input type="radio" class="form-radio text-hubbub-black focus:ring-hubbub-black h-5 w-5" name="payment_method" value="va">
                                     <div class="ml-4 flex-1">
                                         <span class="block font-header font-bold uppercase text-lg">Bank Transfer</span>
                                         <span class="block text-sm text-gray-500 font-sans">Virtual Account (BCA, Mandiri, BNI)</span>
                                     </div>
                                 </label>
                             </div>
                        </div>
                    </div>

                    {{-- Right Column: Order Summary --}}
                    <div>
                        <div class="bg-white p-6 shadow-sm border border-gray-100 sticky top-24">
                            <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-6">Order Summary</h3>
                            
                            <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($carts as $item)
                                    <div class="flex gap-4 items-center">
                                         <div class="w-16 h-16 flex-shrink-0 bg-gray-100">
                                             @if($item->product->productImages->first())
                                                <img src="{{ asset('storage/' . $item->product->productImages->first()->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @endif
                                         </div>
                                        <div class="flex-1">
                                            <p class="font-header font-bold uppercase text-sm leading-tight mb-1">{{ $item->product->name }}</p>
                                            <p class="text-xs text-gray-500 uppercase">{{ $item->product->store->name }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-sm">x{{ $item->quantity }}</p>
                                            <p class="font-bold text-sm text-hubbub-pink">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-6 space-y-3">
                                <div class="flex justify-between font-sans text-gray-600">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-sans text-gray-600">
                                    <span>Tax (11%)</span>
                                    <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-sans text-gray-600">
                                    <span>Shipping (Est.)</span>
                                    <span>Rp {{ number_format($shipping_cost, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-header font-bold text-2xl pt-4 border-t border-gray-100 mt-4">
                                    <span class="uppercase">Total</span>
                                    <span class="text-hubbub-pink">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-hubbub-black text-white font-header font-bold uppercase text-lg py-4 mt-8 hover:bg-hubbub-pink transition-colors">
                                Place Order
                            </button>
                            
                            <p class="text-xs text-center text-gray-400 mt-4">
                                By placing this order, you agree to our Terms of Service.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

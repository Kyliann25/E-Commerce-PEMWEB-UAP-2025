<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-header text-4xl font-bold uppercase text-hubbub-black tracking-tighter mb-8">Purchase History</h1>

            @if(session('success'))
                <!-- Success Toast is handled by app layout, but if we need inline: -->
                <div class="mb-8 p-4 bg-hubbub-black text-white font-header font-bold uppercase border-l-4 border-hubbub-pink">
                    {{ session('success') }}
                </div>
            @endif

            @if($transactions->count() > 0)
                <div class="space-y-8">
                    @foreach($transactions as $trx)
                        <div class="bg-white p-6 shadow-sm border-2 border-transparent hover:border-gray-200 transition-colors">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-4 mb-4 gap-4">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <span class="font-header text-2xl font-bold text-hubbub-black uppercase">{{ $trx->code }}</span>
                                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider {{ $trx->payment_status == 'paid' ? 'bg-black text-white' : 'bg-hubbub-pink text-white' }}">
                                            {{ $trx->payment_status }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 font-sans mt-1 uppercase tracking-wide">{{ $trx->created_at->format('d M Y • H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 uppercase font-sans">Total Amount</p>
                                    <p class="font-header text-xl font-bold text-hubbub-pink">Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                @foreach($trx->details as $detail)
                                    <div class="flex gap-4 items-center">
                                        <div class="w-16 h-16 flex-shrink-0 bg-gray-100 overflow-hidden">
                                            @if($detail->product->productImages->first())
                                                <img class="w-full h-full object-cover" src="{{ asset('storage/' . $detail->product->productImages->first()->image) }}" alt="">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-400 font-header uppercase">No IMG</div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-header text-lg font-bold uppercase text-gray-800 leading-none mb-1">{{ $detail->product->name }}</h4>
                                            <p class="text-sm text-gray-500 font-sans">{{ $detail->qty }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="font-bold font-header text-gray-800">
                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex justify-between items-center border-t border-gray-100 pt-4 mt-6">
                                <div class="text-sm font-sans text-gray-500">
                                    <span class="block uppercase text-xs font-bold text-gray-400 mb-1">Shipping Details</span>
                                    <p><span class="font-bold text-gray-800">{{ $trx->shipping_type }}</span> (Rp {{ number_format($trx->shipping_cost, 0, ',', '.') }})</p>
                                    @if($trx->tracking_number)
                                        <p class="mt-1">Tracking ID: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $trx->tracking_number }}</span></p>
                                    @endif
                                </div>
                                
                                @if($trx->payment_status == 'unpaid')
                                     <a href="{{ route('payment.index') }}" class="inline-block bg-hubbub-pink text-white font-header font-bold uppercase px-6 py-2 hover:bg-pink-600 transition-colors">
                                        Pay Now
                                     </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-12 text-center border border-gray-100 shadow-sm">
                    <h2 class="font-header text-2xl font-bold uppercase text-gray-400 mb-2">No History Yet</h2>
                    <p class="text-gray-500 mb-8 font-sans">Start your collection today.</p>
                    <a href="{{ route('home') }}" class="inline-block bg-hubbub-black text-white font-header font-bold uppercase px-8 py-3 hover:bg-hubbub-pink transition-colors">
                        Shop Now
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

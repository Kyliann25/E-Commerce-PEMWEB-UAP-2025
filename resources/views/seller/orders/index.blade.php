<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-header text-xl font-bold uppercase text-hubbub-black">Order History</h3>
                </div>

                @if($transactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Date</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Transaction Code</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Buyer</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Total</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Status</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Tracking Number</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $trx)
                                    <tr class="hover:bg-pink-50 transition-colors">
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm italic text-gray-500">
                                            {{ $trx->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm font-mono text-hubbub-black font-bold">
                                            {{ $trx->code }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="font-bold text-gray-900">{{ $trx->buyer->name }}</div>
                                            <span class="text-xs text-gray-500 font-header uppercase">{{ $trx->city }}</span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <span class="text-hubbub-pink font-header font-bold">Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <span class="inline-block px-3 py-1 text-xs font-header font-bold uppercase leading-tight {{ $trx->payment_status == 'paid' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-sm">
                                                {{ ucfirst($trx->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            @if($trx->payment_status == 'paid')
                                                <form action="{{ route('seller.orders.update', $trx->id) }}" method="POST" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="text" name="tracking_number" value="{{ $trx->tracking_number }}" class="text-xs border-2 border-gray-300 p-2 w-32 focus:border-hubbub-black focus:ring-0 transition-colors font-sans" placeholder="INPUT RESI...">
                                            @else
                                                <span class="text-gray-400 font-header font-bold uppercase text-xs">Waiting Payment</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            @if($trx->payment_status == 'paid')
                                                    <button type="submit" class="text-hubbub-black hover:text-hubbub-pink font-header font-bold uppercase text-xs transition-colors">Update</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center">
                        <p class="font-header text-xl font-bold uppercase text-gray-400">No orders received yet.</p>
                        <p class="text-gray-500 mt-2">Promote your store to get more sales!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

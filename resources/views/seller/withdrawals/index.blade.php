<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Withdrawals') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Request Form --}}
                <div class="bg-white p-8 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] h-fit">
                    <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-6">Request Withdrawal</h3>
                    <form action="{{ route('seller.withdrawals.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="amount" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Amount (Rp)</label>
                            <input type="number" name="amount" id="amount" min="10000" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="0">
                            <p class="text-xs text-gray-400 mt-2 font-bold uppercase">Min. Rp 10.000</p>
                        </div>

                        <div class="mb-6">
                            <label for="bank_name" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="e.g. BCA">
                        </div>

                        <div class="mb-8">
                            <label for="account_number" class="block text-hubbub-black text-xs font-header font-bold uppercase mb-2">Account Number</label>
                            <input type="text" name="account_number" id="account_number" class="w-full border-2 border-gray-300 p-3 rounded-none focus:border-hubbub-black focus:ring-0 transition-colors font-sans" required placeholder="e.g. 1234567890">
                        </div>

                        <button type="submit" class="w-full bg-hubbub-black text-white font-header font-bold uppercase py-3 border-2 border-transparent hover:bg-white hover:text-hubbub-black hover:border-hubbub-black transition-colors shadow-md">
                            Submit Request
                        </button>
                    </form>
                </div>

                {{-- History --}}
                <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div class="p-6 border-b-2 border-gray-100">
                         <h3 class="font-header text-xl font-bold uppercase text-hubbub-black">Withdrawal History</h3>
                    </div>
                   
                    @if($withdrawals->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Date</th>
                                        <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Amount</th>
                                        <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $w)
                                        <tr class="hover:bg-pink-50 transition-colors">
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm italic text-gray-500">
                                                {{ $w->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="font-bold text-hubbub-black">Rp {{ number_format($w->amount, 0, ',', '.') }}</div>
                                                <span class="text-xs text-gray-500 font-header uppercase">{{ $w->bank_name }}</span>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <span class="inline-block px-3 py-1 text-xs font-header font-bold uppercase leading-tight {{ $w->status == 'approved' ? 'text-green-800 bg-green-100' : ($w->status == 'rejected' ? 'text-red-800 bg-red-100' : 'text-yellow-800 bg-yellow-100') }} rounded-sm">
                                                    {{ ucfirst($w->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-12 text-center text-gray-400 font-header font-bold uppercase">No withdrawal requests.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

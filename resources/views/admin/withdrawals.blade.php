<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Manage Withdrawals') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                @if($withdrawals->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Date</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Store</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Amount</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Bank Details</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Status</th>
                                    <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($withdrawals as $withdrawal)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $withdrawal->created_at->format('d M Y') }}</p>
                                            <p class="text-gray-500 text-xs">{{ $withdrawal->created_at->format('H:i') }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="font-bold text-hubbub-black font-header uppercase">{{ $withdrawal->store->name }}</div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <span class="font-bold text-hubbub-pink">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <p class="font-bold text-gray-900">{{ $withdrawal->bank_name }}</p>
                                            <p class="text-gray-600 font-mono text-xs">{{ $withdrawal->bank_account_number }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            @if($withdrawal->status === 'approved')
                                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-xs font-header font-bold uppercase">Paid</span>
                                                </span>
                                            @elseif($withdrawal->status === 'rejected')
                                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-xs font-header font-bold uppercase">Rejected</span>
                                                </span>
                                            @else
                                                <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                    <span aria-hidden class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                    <span class="relative text-xs font-header font-bold uppercase">Pending</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            @if($withdrawal->status === 'pending')
                                                <div class="flex space-x-2">
                                                    <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 border-2 border-transparent hover:bg-white hover:text-green-600 hover:border-green-500 transition-colors text-xs font-header font-bold uppercase">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST" onsubmit="return confirm('Reject and Refund?');">
                                                        @csrf
                                                        <button type="submit" class="bg-hubbub-pink text-white px-3 py-1 border-2 border-transparent hover:bg-white hover:text-hubbub-pink hover:border-hubbub-pink transition-colors text-xs font-header font-bold uppercase">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-xs font-bold uppercase font-header">Processed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                @else
                    <div class="p-12 text-center text-gray-500">
                        <p class="font-header text-xl font-bold uppercase text-gray-400">No Withdrawal Requests</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

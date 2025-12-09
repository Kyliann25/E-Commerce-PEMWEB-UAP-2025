<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('Store Balance') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Balance Card --}}
                <div class="bg-white p-8 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] h-fit">
                    <h3 class="text-gray-500 font-header font-bold uppercase text-xs mb-2 tracking-widest">Current Balance</h3>
                    <div class="text-4xl font-header font-bold text-hubbub-black mb-8">
                        Rp {{ number_format($balance->balance, 0, ',', '.') }}
                    </div>
                    <a href="{{ route('seller.withdrawals') }}" class="block text-center bg-hubbub-pink text-white font-header font-bold uppercase py-4 border-2 border-transparent hover:bg-white hover:text-hubbub-pink hover:border-hubbub-pink transition-colors shadow-md">
                        Request Withdrawal
                    </a>
                </div>

                {{-- History --}}
                <div class="md:col-span-2 bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div class="p-6 border-b-2 border-gray-100">
                        <h3 class="font-header text-xl font-bold uppercase text-hubbub-black">Balance History</h3>
                    </div>
                    
                    @if($history->count() > 0)
                        <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-100">
                                @foreach($history as $record)
                                    <li class="p-6 hover:bg-pink-50 transition-colors">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="font-bold font-header uppercase text-sm text-hubbub-black truncate">
                                                    {{ $record->description }}
                                                </p>
                                                <p class="text-xs text-gray-500 font-mono mt-1">
                                                    {{ $record->created_at->format('d M Y H:i') }}
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center font-header font-bold text-lg {{ $record->type == 'credit' ? 'text-green-600' : 'text-hubbub-pink' }}">
                                                {{ $record->type == 'credit' ? '+' : '-' }} Rp {{ number_format($record->amount, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="p-12 text-center text-gray-400 font-header font-bold uppercase">No balance history yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg border-2 border-transparent hover:border-hubbub-pink transition-colors">
                <div class="text-center mb-8">
                    <h2 class="font-header text-3xl font-bold uppercase text-hubbub-black tracking-tighter mb-2">Top Up Wallet</h2>
                    <div class="w-12 h-1 bg-hubbub-pink mx-auto"></div>
                    <p class="text-gray-500 mt-4 font-sans">Add funds to your secure wallet for instant checkout.</p>
                </div>

                <form action="{{ route('wallet.topup.process') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="amount" class="block font-header font-bold uppercase text-sm mb-2 text-gray-800">Topup Amount (IDR)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500 font-bold">Rp</span>
                            <input type="number" name="amount" id="amount" min="10000" step="1000" class="w-full pl-10 border-2 border-gray-200 p-3 font-sans font-bold text-lg focus:border-hubbub-black focus:ring-0" placeholder="0" required>
                        </div>
                        <p class="text-xs text-gray-400 mt-2 font-sans">Minimum top up amount is Rp 10.000</p>
                    </div>
                    
                    <button type="submit" class="w-full bg-hubbub-black text-white font-header font-bold uppercase py-4 hover:bg-hubbub-pink transition-colors shadow-lg">
                        Generate Payment Code
                    </button>

                    <div class="text-center mt-4">
                        <a href="{{ route('history') }}" class="text-sm text-gray-400 hover:text-hubbub-black underline font-bold uppercase">View Transaction History</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

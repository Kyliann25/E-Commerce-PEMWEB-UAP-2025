<x-app-layout>
    <x-slot name="header">
        <h2 class="font-header font-bold text-3xl uppercase text-hubbub-black leading-tight tracking-tighter">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white md:bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-0 border-2 border-hubbub-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">ID</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Name</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Email</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Role</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Joined</th>
                                <th class="px-5 py-4 border-b-2 border-hubbub-black bg-hubbub-black text-left text-xs font-header font-bold text-white uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="hover:bg-pink-50 transition-colors">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm font-mono text-gray-500">
                                        #{{ $user->id }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="font-bold text-hubbub-black">{{ $user->name }}</div>
                                        @if($user->store)
                                            <span class="block text-xs font-header uppercase text-hubbub-pink mt-1">Store: {{ $user->store->name }}</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm font-mono text-gray-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <span class="px-2 py-1 text-xs font-header font-bold uppercase leading-5 rounded-sm {{ $user->role == 'admin' ? 'bg-black text-white' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm font-sans text-gray-500">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold font-header uppercase text-xs">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200 bg-gray-50">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

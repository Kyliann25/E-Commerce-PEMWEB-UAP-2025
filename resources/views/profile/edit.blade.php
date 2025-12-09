<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <h1 class="font-header text-4xl font-bold uppercase text-hubbub-black tracking-tighter">Account Settings</h1>

            <div class="p-8 bg-white shadow-sm border border-gray-100">
                <div class="max-w-xl">
                    <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-4">Profile Information</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-sm border border-gray-100">
                <div class="max-w-xl">
                    <h3 class="font-header text-xl font-bold uppercase text-hubbub-black mb-4">Update Password</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-sm border border-gray-100">
                <div class="max-w-xl">
                    <h3 class="font-header text-xl font-bold uppercase text-red-600 mb-4">Danger Zone</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

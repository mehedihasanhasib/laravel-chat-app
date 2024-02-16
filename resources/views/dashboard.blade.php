<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite('resources/js/app.js')
<script>
    setTimeout(() => {
        window.Echo.join('presence-channel')
            .joining((user) => {
                console.log(user.name + " is online");
            })
            .leaving((user) => {
                console.log(user.name + " is offline");
            })
            .listen('.App\\Events\\TestPresenceChannel', (e) => {
                console.log(e);
            })
    }, 200);
</script>

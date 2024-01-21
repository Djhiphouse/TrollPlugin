<div>
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('vendor/livewire/dist/livewire.js') }}?v={{ config('livewire.version') }}" defer></script>
        @livewireStyles
        @livewireScripts

    </head>

    <style>

        body, html {
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;

            background: url('background.jpg') no-repeat;
            background-position: center;
            background-size: cover;
        }


    </style>


    @if (session('message'))
        <div id="toast-success" class="fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 bg-[#27262b]  rounded-lg shadow transition-opacity duration-300 ease-in-out" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal text-white">{{ session('message') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 text-white" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <script>
            // Add a script to fade out the toast after 3 seconds
            setTimeout(function() {
                document.getElementById('toast-success').style.opacity = '0';
            }, 2000);
        </script>
    @endif



    <div id="back" class="back flex w-full h-full flex-row bg-black justify-center items-center bg-cover bg-no-repeat bg-center" style="background-image: url('/background.jpg');">
        <x-nav-system.server-nav> </x-nav-system.server-nav>
        @livewireStyles

        <div wire:poll.500ms id='system' class="w-full  h-[600] overflow-x-scroll rounded shadow bg-[#27262b] text-white text-center">
            <table id="example" class="stripe hover mx-auto my-4 text-white" style="width: 100%;">


                <thead>
                <tr>
                    <th class="table-header text-white">ID</th>
                    <th class="table-header">Username</th>
                    <th class="table-header">Status</th>
                    <th class="table-header">Permissions</th>
                    <th class="table-header">Last Join</th>
                    <th class="table-header">Last Leave</th>
                    <th class="table-header">Action</th>
                </tr>
                </thead>
                <tbody class="">
                @php
                    // Get the server ID from the URL
                    $serverId = request()->segment(2); // Assuming the server ID is in the second segment

                    // Fetch entries based on the server ID
                    $entries = \App\Models\MinecraftUser::getAllUsers($serverId);
                @endphp

                @foreach($entries as $user)
                    <tr>
                        <td class="text-center"><h1 class="mt-2">{{ $user->id }}</h1></td>
                        <td class="text-center">{{ $user->username }}</td>
                        <td class="text-center">@if($user->state == 1)
                                <span class="bg-green-700 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">Online</span>
                            @else
                                <span class="bg-red-500 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">Offline</span>
                            @endif
                        </td>
                        <td class="text-center">@if($user->op == 1)
                                <span class="bg-green-700 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">OP</span>
                            @else
                                <span class="bg-red-500 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">Not Permissions</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->last_join)->addMinutes(-60)->setTimezone("Europe/Berlin")->format("H:i")}}
                        </td>


                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->last_leave)->addMinutes(-60)->setTimezone("Europe/Berlin")->format("H:i")}}
                        </td>
                        <td class="text-center flex flex-row space-x-2 items-center justify-center">
                            <a href="{{route('kill', $user->username)}}"><img src="/knife.png" width="20"></a>
                            <a href="{{route('explode', $user->username)}}"><img src="/nuclear-explosion.png" width="20"></a>
                            <a href="{{route('teleport', $user->username)}}"><img src="/portal.png" width="20"></a>
                            <a href="{{route('setop', $user->username)}}"><img src="/privacy.png" width="20"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        @livewireScripts
    </div>


</div>

<div>
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('vendor/livewire/dist/livewire.js') }}?v={{ config('livewire.version') }}" defer></script>
        @livewireStyles
        @livewireScripts

    </head>

    <style>
        body, html {
            min-height: 100vh;
            width: 100%;
            background: url('background.jpg') no-repeat;
            background-position: center;
            background-size: cover;
        }

        #console {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>






    <div id="back" class="back flex w-full h-full flex-row items-center bg-cover bg-no-repeat bg-center" style="background-image: url('/background.jpg');">
        <x-nav-system.server-nav></x-nav-system.server-nav>
        @livewireStyles

        <div class="flex flex-col w-full">
            <div id="console" class="w-full overflow-y-auto bg-black text-green-500"></div>

            <div class="flex items-center mt-2">
                <input type="text" id="commandInput" class="p-2 w-full" placeholder="Enter command..." onkeydown="handleKeyPress(event)">
                <label for="autoScroll" class="ml-2 text-white">Auto Scroll</label>
                <input type="checkbox" id="autoScroll" class="ml-1" checked>
            </div>

            <script>
                function updateConsole() {
                    // Extract the server ID from the current URL
                    const serverId = window.location.pathname.split('/').pop();

                    fetch(`/api/logs/${serverId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Update the console content with the new logs
                            document.querySelector('#console').innerHTML = generateConsoleHTML(data);

                            // Scroll to the bottom if auto-scroll is enabled
                            if (document.getElementById('autoScroll').checked) {
                                const consoleDiv = document.querySelector('#console');
                                consoleDiv.scrollTop = consoleDiv.scrollHeight;
                            }
                        })
                        .catch(error => console.error('Error fetching logs:', error));
                }

                function generateConsoleHTML(logs) {
                    let consoleHTML = '';

                    logs.forEach(log => {
                        consoleHTML += '<p style="color: white;">' + '> ' + log.log + '</p>';
                    });

                    return consoleHTML;
                }

                // Call the updateConsole function every second
                setInterval(updateConsole, 1000);

                // Initial update on page load
                updateConsole();

                function handleKeyPress(event) {
                    if (event.key === 'Enter') {
                        // Get the command from the input field
                        const command = document.getElementById('commandInput').value;

                        // Extract the server ID from the current URL
                        const serverId = window.location.pathname.split('/').pop();

                        // Send a POST request to the server with the command
                        fetch(`http://127.0.0.1:8080/command`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'cmd': command
                            },
                            body: JSON.stringify({ command, serverId }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                // Handle the response if needed
                                console.log('Server response:', data);
                            })
                            .catch(error => console.error('Error sending command:', error));

                        // Clear the input field after sending the command
                        document.getElementById('commandInput').value = '';
                    }
                }
            </script>

            @livewireScripts
        </div>
    </div>






    @livewireScripts
    </div>


</div>

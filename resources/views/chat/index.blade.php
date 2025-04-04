<!DOCTYPE html>
<html>
<head>
    <title>LMS Chat</title>
    @vite(['resources/js/app.js', 'resources/js/bootstrap.js'])
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .chat-box {
            height: 400px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            margin-bottom: 20px;
        }
        .chat-box p {
            margin: 5px 0;
        }
        .chat-box .sent {
            text-align: right;
            color: #007bff;
        }
        .chat-box .received {
            text-align: left;
            color: #333;
        }
        .user-list {
            border-right: 1px solid #ccc;
            padding-right: 20px;
        }
        .user-list ul {
            list-style: none;
            padding: 0;
        }
        .user-list ul li {
            margin: 10px 0;
        }
        .user-list ul li a {
            text-decoration: none;
            color: #007bff;
        }
        .user-list ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chat System</h1>
        <div class="row">
            <div class="col-md-4 user-list">
                @if(auth()->user()->role == '2')
                    <h3>Students</h3>
                    <ul>
                        @foreach($students as $student)
                            <li><a href="#" onclick="loadChat({{ $student->id }})">{{ $student->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-8">
                <div id="chat-box" class="chat-box"></div>
                <form id="message-form">
                    @csrf
                    <input type="hidden" id="receiver_id">
                    <textarea id="message" class="form-control" placeholder="Type your message..." required></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const appUrl = '{{ env('APP_URL') }}';
        let receiverId = null;

        // Agar student hai aur selectedReceiverId set hai, toh automatically load karo
        @if(auth()->user()->role == '3' && $selectedReceiverId)
            receiverId = {{ $selectedReceiverId }};
            document.getElementById('receiver_id').value = receiverId;
            fetchMessages();
        @endif

        function loadChat(id) {
            receiverId = id;
            document.getElementById('receiver_id').value = id;
            fetchMessages();
        }

        function fetchMessages() {
            if (!receiverId) return;
            fetch(`${appUrl}/messages/${receiverId}`)
                .then(response => response.json())
                .then(messages => {
                    let chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML = '';
                    messages.forEach(msg => {
                        const isSent = msg.sender_id === {{ auth()->id() }};
                        chatBox.innerHTML += `<p class="${isSent ? 'sent' : 'received'}"><strong>${isSent ? 'You' : 'Them'}:</strong> ${msg.message}</p>`;
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let message = document.getElementById('message').value;

            const url = `${appUrl}/message/send?receiver_id=${receiverId}&message=${encodeURIComponent(message)}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                document.getElementById('message').value = '';
                fetchMessages();
            });
        });

        Echo.channel(`chat.{{ auth()->id() }}`)
            .listen('MessageSent', (e) => {
                if (e.message.sender_id === receiverId || e.message.receiver_id === receiverId) {
                    fetchMessages();
                }
            });
    </script>
</body>
</html>
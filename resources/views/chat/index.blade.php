<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Chat</title>
    @vite(['resources/js/app.js', 'resources/js/bootstrap.js'])
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .chat-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.2rem;
            font-weight: 500;
        }
        .chat-box {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background-color: #f1f3f5;
        }
        .chat-message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        .chat-message.sent {
            justify-content: flex-end;
        }
        .chat-message.received {
            justify-content: flex-start;
        }
        .chat-message .message-bubble {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 15px;
            position: relative;
        }
        .chat-message.sent .message-bubble {
            background-color: #007bff;
            color: #fff;
            border-bottom-right-radius: 5px;
        }
        .chat-message.received .message-bubble {
            background-color: #e9ecef;
            color: #333;
            border-bottom-left-radius: 5px;
        }
        .chat-message .message-sender {
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .chat-form {
            padding: 15px;
            border-top: 1px solid #dee2e6;
            background-color: #fff;
        }
        .chat-form textarea {
            resize: none;
            border-radius: 20px;
            padding: 10px 15px;
        }
        .chat-form button {
            border-radius: 20px;
            padding: 10px 20px;
        }
        .user-list {
            padding-right: 20px;
        }
        .user-list .list-group-item {
            border: none;
            border-radius: 8px;
            margin-bottom: 5px;
            background-color: #fff;
            transition: background-color 0.2s;
        }
        .user-list .list-group-item:hover {
            background-color: #f1f3f5;
        }
        .user-list .list-group-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Chat System</h1>
        <div class="row">
            <div class="col-md-4 user-list">
                @if(auth()->user()->role == '2') <!-- Teacher -->
                    <h3>Students</h3>
                    <div class="list-group">
                        @foreach($students as $student)
                            <div class="list-group-item">
                                <a href="#" onclick="loadChat({{ $student->id }})">{{ $student->name }}</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="chat-container">
                    <!-- Chat Header with Teacher/Student Name -->
                    <div class="chat-header">
                        @if(auth()->user()->role == '3' && $selectedReceiverId && $teachers->isNotEmpty())
                            Chatting with: {{ $teachers->first()->name }}
                        @elseif(auth()->user()->role == '2' && $students->isNotEmpty())
                            <span id="chat-receiver-name">Select a student to start chatting</span>
                        @else
                            No one to chat with
                        @endif
                    </div>
                    <div id="chat-box" class="chat-box"></div>
                    <form id="message-form" class="chat-form">
                        @csrf
                        <input type="hidden" id="receiver_id">
                        <div class="d-flex align-items-center">
                            <textarea id="message" class="form-control me-2" placeholder="Type your message..." required></textarea>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let receiverId = null;
        let receiverName = '';

        // Agar student hai aur selectedReceiverId set hai, toh automatically load karo
        @if(auth()->user()->role == '3' && $selectedReceiverId)
            receiverId = {{ $selectedReceiverId }};
            document.getElementById('receiver_id').value = receiverId;
            fetchMessages();
        @endif

        function loadChat(id) {
            receiverId = id;
            document.getElementById('receiver_id').value = id;

            // Update chat header with selected student's name (for teacher)
            @if(auth()->user()->role == '2')
                const student = @json($students->keyBy('id'));
                receiverName = student[id] ? student[id].name : 'Unknown';
                document.getElementById('chat-receiver-name').innerText = `Chatting with: ${receiverName}`;
            @endif

            fetchMessages();
        }

        function fetchMessages() {
            if (!receiverId) return;
            fetch(`/messages/${receiverId}`)
                .then(response => response.json())
                .then(messages => {
                    let chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML = '';
                    messages.forEach(msg => {
                        const isSent = msg.sender_id === {{ auth()->id() }};
                        chatBox.innerHTML += `
                            <div class="chat-message ${isSent ? 'sent' : 'received'}">
                                <div class="message-bubble">
                                    <div class="message-sender">${isSent ? 'You' : 'Them'}</div>
                                    ${msg.message}
                                </div>
                            </div>
                        `;
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                });
        }

        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let message = document.getElementById('message').value;

            fetch('/message/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    receiver_id: receiverId,
                    message: message
                })
            }).then(() => {
                document.getElementById('message').value = '';
                fetchMessages();
            }).catch(error => {
                console.error('Error sending message:', error);
            });
        });

        Echo.channel(`chat.{{ auth()->id() }}`)
            .listen('MessageSent', (e) => {
                if (e.message.sender_id === receiverId || e.message.receiver_id === receiverId) {
                    fetchMessages();
                }
            });
    </script>

    <!-- Bootstrap 5 JS (for responsiveness) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@extends('admin.layouts.app') <!-- Adjust to student.layouts.app if needed -->

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Enrollment Report</h1>

        <!-- Debug: Display enrollments count -->
        <p class="text-gray-600 mb-4">Total Enrollments: {{ count($enrollments) }}</p>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @if ($enrollments->isEmpty())
            <p class="text-gray-500 text-lg">No enrollments available for batches that have started.</p>
        @else
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-purple-600 mb-4 border-b-2 border-purple-200 pb-2">
                    Enrolled Users With course Completed
                </h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-50 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">Phone</th>
                                <th class="py-3 px-6 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($enrollments as $enrollment)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 transition-shadow duration-300">
                                    <td class="py-3 px-6 text-left">{{ $enrollment->name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $enrollment->email }}</td>
                                    <td class="py-3 px-6 text-left">{{ $enrollment->phone }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <button 
                                            type="button"
                                            class="send-offer-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            data-user-id="{{ $enrollment->user_id }}"
                                            data-email="{{ $enrollment->email }}"
                                            data-name="{{ $enrollment->name }}"
                                            @if($enrollment->internship) disabled @endif
                                        >
                                            {{ $enrollment->internship ? 'Offer Sent' : 'Send Offer Letter' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <!-- Full Page Modal (Retained from previous version, not used for this feature) -->
    <div id="videoModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
        <div class="relative w-full h-full max-w-[95vw] max-h-[95vh] bg-white rounded-lg p-4 flex flex-col">
            <button 
                type="button"
                onclick="closeModal()" 
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-2xl font-bold z-20"
            >
                ×
            </button>
            <div class="flex-grow w-full h-full" id="videoContainer">
                <!-- Video or iframe will be injected here -->
            </div>
            <!-- Custom Seek Bar -->
            <div id="seekBarContainer" class="w-full p-2 bg-gray-200 flex items-center">
                <input type="range" id="seekBar" min="0" max="100" value="0" class="w-full h-2 bg-gray-300 rounded-lg appearance-none cursor-pointer" onchange="seekVideo()">
                <span id="currentTime" class="ml-2 text-sm text-gray-700">0:00</span> / <span id="duration" class="text-sm text-gray-700">0:00</span>
            </div>
            <!-- Overlay to block YouTube UI -->
            <div id="uiOverlay" class="absolute top-0 left-0 w-full h-full bg-transparent z-10 pointer-events-auto" style="top: 40px; height: calc(100% - 40px - 40px);"></div>
        </div>
    </div>

    <!-- Modal JavaScript (Retained from previous version) -->
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        console.log('Modal script loaded at:', new Date().toISOString());

        let player;
        let video;
        let currentVideoUrl = '';

        function onYouTubeIframeAPIReady() {
            console.log('YouTube IFrame API ready');
        }

        function isYouTubeUrl(url) {
            return url.includes('youtube.com') || url.includes('youtu.be');
        }

        function getYouTubeEmbedUrl(url) {
            let videoId = '';
            if (url.includes('youtube.com/watch?v=')) {
                videoId = url.split('v=')[1].split('&')[0];
            } else if (url.includes('youtu.be/')) {
                videoId = url.split('youtu.be/')[1].split('?')[0];
            }
            return videoId ? `https://www.youtube.com/embed/${videoId}?controls=0&modestbranding=1&iv_load_policy=3&rel=0&fs=0&showinfo=0&enablejsapi=1&origin=${encodeURIComponent(window.location.origin)}` : '';
        }

        function formatTime(seconds) {
            if (isNaN(seconds)) return "0:00";
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        function updateSeekBar() {
            const seekBar = document.getElementById('seekBar');
            const currentTime = document.getElementById('currentTime');
            const duration = document.getElementById('duration');

            if (isYouTubeUrl(currentVideoUrl) && player && typeof player.getCurrentTime === 'function' && typeof player.getDuration === 'function') {
                try {
                    const current = player.getCurrentTime();
                    const total = player.getDuration();
                    seekBar.value = (current / total) * 100 || 0;
                    currentTime.textContent = formatTime(current);
                    duration.textContent = formatTime(total);
                } catch (e) {
                    console.warn('YouTube time access failed:', e);
                }
            } else if (video) {
                seekBar.value = (video.currentTime / video.duration) * 100 || 0;
                currentTime.textContent = formatTime(video.currentTime);
                duration.textContent = formatTime(video.duration);
            }
        }

        function seekVideo() {
            const seekBar = document.getElementById('seekBar');
            if (isYouTubeUrl(currentVideoUrl) && player && typeof player.seekTo === 'function') {
                try {
                    const time = (seekBar.value / 100) * player.getDuration();
                    player.seekTo(time, true);
                    console.log('Seeking to:', time);
                } catch (e) {
                    console.error('YouTube seek failed:', e);
                }
            } else if (video) {
                const time = (seekBar.value / 100) * video.duration;
                video.currentTime = time;
            }
        }

        function openModal(videoUrl) {
            console.log('openModal called with URL:', videoUrl);
            currentVideoUrl = videoUrl;

            const modal = document.getElementById('videoModal');
            const videoContainer = document.getElementById('videoContainer');
            const seekBar = document.getElementById('seekBar');
            const currentTime = document.getElementById('currentTime');
            const duration = document.getElementById('duration');
            const uiOverlay = document.getElementById('uiOverlay');

            if (!modal || !videoContainer || !seekBar || !currentTime || !duration || !uiOverlay) {
                console.error('Modal elements not found:', { modal, videoContainer, seekBar, currentTime, duration, uiOverlay });
                alert('Error: Modal elements not found');
                return;
            }

            if (!videoUrl) {
                console.error('No video URL provided');
                alert('Error: No video URL');
                return;
            }

            videoContainer.innerHTML = '';
            seekBar.value = 0;
            currentTime.textContent = '0:00';
            duration.textContent = '0:00';

            if (isYouTubeUrl(videoUrl)) {
                const embedUrl = getYouTubeEmbedUrl(videoUrl);
                if (!embedUrl) {
                    console.error('Invalid YouTube URL:', videoUrl);
                    alert('Error: Invalid YouTube URL');
                    return;
                }
                console.log('YouTube embed URL:', embedUrl);
                videoContainer.innerHTML = `
                    <iframe 
                        id="youtubePlayer" 
                        class="w-full h-full" 
                        src="${embedUrl}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                    ></iframe>
                `;
                uiOverlay.style.display = 'block';
                if (window.YT && window.YT.Player) {
                    player = new YT.Player('youtubePlayer', {
                        events: {
                            'onReady': function(event) {
                                player = event.target;
                                console.log('YouTube player ready');
                                updateSeekBar();
                                setInterval(updateSeekBar, 1000);
                            },
                            'onStateChange': function(event) {
                                if (event.data === YT.PlayerState.PLAYING) {
                                    updateSeekBar();
                                }
                            }
                        }
                    });
                } else {
                    console.error('YouTube API not loaded');
                    alert('YouTube API failed to load, check internet or script');
                }
            } else {
                videoContainer.innerHTML = `
                    <video id="modalVideo" class="w-full h-full object-contain">
                        <source id="videoSource" src="${videoUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
                uiOverlay.style.display = 'none';
                video = document.getElementById('modalVideo');
                video.load();
                video.play().catch(error => {
                    console.error('Video playback error:', error);
                    alert('Video error: ' + error.message);
                });
                video.addEventListener('timeupdate', updateSeekBar);
                video.addEventListener('loadedmetadata', () => {
                    duration.textContent = formatTime(video.duration);
                });
            }

            console.log('Modal display before:', modal.style.display);
            modal.style.display = 'block';
            console.log('Modal display after:', modal.style.display);
        }

        function closeModal() {
            console.log('closeModal called');

            const modal = document.getElementById('videoModal');
            const videoContainer = document.getElementById('videoContainer');
            const uiOverlay = document.getElementById('uiOverlay');

            if (modal && videoContainer) {
                modal.style.display = 'none';
                videoContainer.innerHTML = '';
                if (uiOverlay) uiOverlay.style.display = 'none';
                if (video) {
                    video.pause();
                    video.removeEventListener('timeupdate', updateSeekBar);
                    video = null;
                }
                if (player) {
                    player.destroy();
                    player = null;
                }
                console.log('Modal hidden');
            } else {
                console.error('Modal or container not found');
                alert('Error: Modal elements not found');
            }
        }

        // AJAX for sending offer letter
        document.querySelectorAll('.send-offer-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const email = this.getAttribute('data-email');
                const name = this.getAttribute('data-name');

                if (!userId || !email || !name) {
                    alert('Error: Missing user data');
                    return;
                }

                fetch('/enrollment-report/send-offer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ user_id: userId, email: email, name: name })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Offer letter sent successfully!');
                        button.textContent = 'Offer Sent';
                        button.disabled = true;
                        button.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                        button.classList.add('bg-gray-400');
                    } else {
                        alert('Error: ' + (data.message || 'Failed to send offer letter'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error: Failed to send offer letter');
                });
            });
        });
    </script>
@endsection

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        text-align: left;
        padding: 12px;
    }
    tr {
        transition: background-color 0.3s;
    }
    #videoContainer iframe, #videoContainer video {
        max-width: 100%;
        max-height: 100%;
    }
    #uiOverlay {
        cursor: default;
        z-index: 10;
    }
    #seekBarContainer {
        z-index: 15;
    }
    button {
        z-index: 20;
    }
</style>
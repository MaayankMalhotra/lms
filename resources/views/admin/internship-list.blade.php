@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <!-- Edit Internship Modal -->
    <div id="editInternshipModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold">Edit Internship</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="editInternshipForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Logo Upload -->
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-camera-retro mr-2 text-blue-400"></i>Program Logo
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:border-gray-300 hover:bg-gray-50 transition-all rounded-xl cursor-pointer">
                                    <div id="logoPreview" class="flex flex-col items-center justify-center pt-7">
                                        <!-- Preview will be inserted here -->
                                    </div>
                                    <input type="file" name="logo" class="opacity-0" id="edit_logo">
                                </label>
                            </div>
                            <p class="text-sm text-gray-500 mt-2" id="currentLogoText"></p>
                        </div>

                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-blue-400"></i>Internship Name
                                </label>
                                <input type="text" name="name" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       id="edit_name">
                            </div>

                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-certificate mr-2 text-blue-400"></i>Certification Badge
                                </label>
                                <input type="text" name="certified_button" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       id="edit_certified_button">
                            </div>
                        </div>

                        <!-- Program Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-clock mr-2 text-blue-400"></i>Duration
                                </label>
                                <input type="text" name="duration" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       id="edit_duration">
                            </div>

                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-project-diagram mr-2 text-blue-400"></i>Projects
                                </label>
                                <input type="number" name="project" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       id="edit_project">
                            </div>

                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-users mr-2 text-blue-400"></i>Applicants
                                </label>
                                <input type="text" name="applicant" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       id="edit_applicant">
                            </div>

                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-dollar-sign mr-2 text-blue-400"></i>Price
                                </label>
                                <input type="number" name="price" required step="0.01" min="0" 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       id="edit_price">
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" 
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-4 px-6 rounded-xl transition-all">
                                Update Internship
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function openEditModal(editUrl) {
        fetch(editUrl, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Populate form fields
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_certified_button').value = data.certified_button;
            document.getElementById('edit_duration').value = data.duration;
            document.getElementById('edit_project').value = data.project;
            document.getElementById('edit_applicant').value = data.applicant;
            document.getElementById('edit_price').value = data.price; // Populate price

            // Handle logo preview
            const logoPreview = document.getElementById('logoPreview');
            const currentLogoText = document.getElementById('currentLogoText');
            
            if(data.logo) {
                const imageUrl = "{{ asset('') }}" + data.logo;
                logoPreview.innerHTML = `<img src="${imageUrl}" class="h-28 object-contain p-2" alt="Logo preview">`;
                currentLogoText.textContent = 'Current logo - upload new to change';
            } else {
                logoPreview.innerHTML = `
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-500">Drag & drop or click to upload</p>
                `;
                currentLogoText.textContent = 'No logo uploaded';
            }

            // Set form action
            document.getElementById('editInternshipForm').action = 
                "{{ route('admin.internship.update', '') }}/" + data.id;

            // Show modal
            document.getElementById('editInternshipModal').classList.remove('hidden');
        });
    }
    function closeModal() {
        document.getElementById('editInternshipModal').classList.add('hidden');
    }

    // Handle logo preview
    document.getElementById('edit_logo').addEventListener('change', function(e) {
        const preview = document.getElementById('logoPreview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="h-28 object-contain p-2" alt="Logo preview">`;
            }
            reader.readAsDataURL(file);
        }
    });
    </script>

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-briefcase mr-2 text-blue-500"></i>Internship Programs
                </h1>
                <p class="text-gray-500 mt-2">Manage all internship programs in the system</p>
            </div>
            <a href="{{ route('admin.internship.add') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-all">
                <i class="fas fa-plus-circle mr-2"></i>Add New Internship
            </a>
        </div>

        <!-- Internships Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Logo</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Internship Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Certification Badge</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Duration</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Projects</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Applicants</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($internships as $internship)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            @if($internship->logo)
                            <img src="{{ asset($internship->logo) }}" 
                                 class="w-12 h-12 rounded-lg object-cover shadow-sm"
                                 alt="{{ $internship->name }} logo">
                            @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-briefcase text-gray-400"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $internship->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs text-blue-500 mt-1">{{ $internship->certified_button }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $internship->duration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $internship->project }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-blue-600">
                            {{ $internship->applicant }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">₹{{ number_format($internship->price, 2) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-4">
                                <button onclick="openEditModal(`{{ route('admin.internship.edit', $internship->id) }}`)"
                                        class="text-blue-500 hover:text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.internship.destroy', $internship->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600"
                                            onclick="return confirm('Are you sure you want to delete this internship?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($internships->isEmpty())
            <div class="p-12 text-center text-gray-500">
                <i class="fas fa-inbox text-4xl mb-4"></i>
                <p class="text-lg">No internships found. Start by adding a new internship program!</p>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($internships->hasPages())
        <div class="mt-8">
            {{ $internships->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('title', 'Add Quizzes to Set')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <!-- Heading -->
        <h1 class="text-4xl font-bold text-gray-800 tracking-tight mb-8">
            Add Quizzes to "{{ $quizSet->title }}"
        </h1>

        <!-- Form -->
        <form action="{{ route('admin.quiz_sets.store_quizzes', $quizSet->id) }}" method="POST">
            @csrf
            @for($i = 0; $i < $quizSet->total_quizzes; $i++)
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold text-indigo-600 mb-4">
                        Quiz {{ $i + 1 }}
                    </h2>

                    <!-- Question -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Question
                        </label>
                        <textarea name="questions[]" 
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" 
                                  placeholder="Enter your question here" rows="3" required></textarea>
                        @error("questions.$i")
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Options -->
                    @for($j = 0; $j < 4; $j++)
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">
                                Option {{ $j + 1 }}
                            </label>
                            <input type="text" name="options[{{$i}}][]" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" 
                                   placeholder="Option {{ $j + 1 }}" required>
                            @error("options.$i.$j")
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endfor

                    <!-- Correct Option -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Correct Option (1-4)
                        </label>
                        <input type="number" name="correct_options[]" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" 
                               min="1" max="4" placeholder="e.g., 2" required>
                        @error("correct_options.$i")
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endfor

            <!-- Submit Button -->
            <button type="submit" 
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300 w-full max-w-lg mx-auto block">
                Save Quizzes
            </button>
        </form>

        <!-- Back Link -->
        <a href="{{ route('admin.quiz_sets') }}" 
           class="block text-indigo-600 hover:text-indigo-800 mt-6 text-center">
            Back to Quiz Sets
        </a>
    </div>
@endsection
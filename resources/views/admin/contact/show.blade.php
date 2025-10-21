<x-app-layout>
    @section('title')
        {{ $title }}
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 main-contact-container">
                    <div class="back-button-container">
                        <a href="{{ route('dashboard') }}" class="btn back-button"><span></span>back</a>
                    </div>
                    <div>
                        <label for="">Name:</label>
                        <div class="container">{{ $contact->full_name }}</div>
                    </div>
                    <div>
                        <label for="">Subject:</label>
                        <div class="container">{{ $contact->subject }}</div>
                    </div>
                    <div>
                        <label for="">Email:</label>
                        <div class="container">{{ $contact->email }}</div>
                    </div>
                    <div>
                        <label for="">Message:</label>
                        <div class="container">{{ $contact->message }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
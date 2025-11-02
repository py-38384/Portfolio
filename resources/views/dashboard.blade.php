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
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="pt-6 px-6 text-xl font-bold text-gray-900 dark:text-gray-100" id="product-count">
                            Contact Messages
                        </div>
                        <div class="pt-6 px-6 text-gray-900 dark:text-gray-100" id="product-count">
                            Total Contacts = {{ $contacts_count }}
                        </div>
                        <div class="table-card">
                            <table class="project-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sent At</th>
                                        <th>Subject</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contacts as $contact)
                                    <tr>
                                        <td>#{{ $contact->id }}</td>
                                        <td>{{ $contact->created_at->diffForHumans() }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->full_name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td style="max-width: 300px;">{{ strlen($contact->message) > 100? substr($contact->message, 0, 100).'. . .' :$contact->message }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('show.contact', $contact->id) }}"
                                                    class="btn edit">View</a>
                                                <form action="{{ route('delete.contact', $contact->id) }}"
                                                    method="post" onsubmit="deleteRequest(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center">No Record Found!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
            <script>
                function deleteRequest (e){
                    e.preventDefault();

                    Swal.fire({
                        title: "Are you sure you want to delete this Contact Message?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#F05555",
                        cancelButtonColor: "#183153",
                        confirmButtonText: "Yes, delete it!",
                        showClass: {
                            popup: 'animate__animated animate__zoomIn animate__faster'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__zoomOut animate__faster'
                        },
                        toast: false,
                        position: 'center'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.submit();
                        }
                    });
                };
            </script>
        @endsection
</x-app-layout>
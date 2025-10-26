@section('style')
    @section('title')
        {{ $title }}
    @endsection
    <style>
        :root {
            --table-color: #384b59;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid var(--table-color);
            text-align: center;
            padding: 8px;

        }

        tr:nth-child(even) {
            background-color: var(--table-color);
        }

        .action-container {
            display: inline-flex;
            gap: 30px;
            font-size: 20px;
        }

        .action-container a:hover {
            color: #000000;
        }
        
    </style>
@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Social Icons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100"
                    style="display: flex; justify-content: end; gap: 10px;">
                    <a href="{{ route('social_icon.create') }}" class="btn">Add Social Icon</a>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-6 px-6 text-gray-900 dark:text-gray-100" id="product-count">
                        Total Social Icons = {{ $social_icons->count() }}
                    </div>
                    <div class="table-card">
                        <table class="project-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Icon</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($social_icons as $social_icon)
                                    <tr>
                                        <td>#{{ $social_icon->id }}</td>
                                        <td class="social-icon">{!! $social_icon->icon !!}</td>
                                        <td style="max-width: 350px; word-wrap: break-word;">{{ $social_icon->link }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('social_icon.edit', $social_icon->id) }}"
                                                    class="btn edit">Edit</a>
                                                <form action="{{ route('social_icon.delete', $social_icon->id) }}" method="post"
                                                    id="deleteRequestForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn delete">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center">No Record Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $social_icons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .social-icon svg{
                max-width: 60px;
            }
        </style>
        @section('scripts')
            <script>
                document.querySelector('#deleteRequestForm').addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "Are you sure you want to delete this Social Icon?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#F05555",
                        cancelButtonColor: "#183153",
                        confirmButtonText: "Yes, delete it!",
                        // 👇 Popup animation (uses Animate.css)
                        showClass: {
                            popup: 'animate__animated animate__zoomIn animate__faster'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__zoomOut animate__faster'
                        },
                        toast: false, // ensure it's a modal, not a toast
                        position: 'center'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.submit();
                        }
                    });
                });
            </script>
        @endsection
</x-app-layout>
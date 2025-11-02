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
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100"
                    style="display: flex; justify-content: end; gap: 10px;">
                    <a href="{{ route('file.create') }}" class="btn">Upload File</a>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-6 px-6 text-gray-900 dark:text-gray-100" id="product-count">
                        Total Uploaded Files = {{ $file_count }}
                    </div>
                    <div class="table-card">
                        <table class="project-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Type</th>
                                    <th>Path</th>
                                    <th>Visibility</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($files as $file)
                                    <tr>
                                        <td>#{{ $file->id }}</td>
                                        <td>
                                            @if($file->file_type == 'video')
                                                <img src="{{ asset('assets/icons/mp4.png') }}" alt="Video">
                                            @elseif ($file->file_type == 'audio')
                                                <img src="{{ asset('assets/icons/mp3.png') }}" alt="Audio">
                                            @elseif ($file->file_type == 'image')
                                                <img src="{{ asset('assets/icons/background.png') }}" alt="Audio">
                                            @elseif ($file->file_type == 'pdf')
                                                <img src="{{ asset('assets/icons/pdf.png') }}" alt="PDF">
                                            @elseif ($file->file_type == 'document')
                                                <img src="{{ asset('assets/icons/google-docs.png') }}" alt="PDF">
                                            @elseif ($file->file_type == 'text')
                                                <img src="{{ asset('assets/icons/file.png') }}" alt="PDF">
                                            @else
                                                <img src="{{ asset('assets/icons/digital-archive.png') }}" alt="PDF">
                                            @endif
                                        </td>
                                        <td>{{ $file->filename }}</td>
                                        <td style="min-width: 130px;">{{ $file->size }} MB</td>
                                        <td>{{ $file->file_type }}</td>
                                        <td>{{ $file->path }}</td>
                                        <td>{{ $file->public ? 'Public' : 'Private' }}</td>
                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('file.show', $file->file_id) }}"
                                                    style="background: steelblue;" class="btn edit" target="_blank">view</a>
                                                <button
                                                    onclick="copy_public_file_path(event,'{{ $file->path }}','{{ $file->file_id }}')"
                                                    style="background: darkgreen;" class="btn edit"
                                                    target="_blank">copy</button>
                                                <a href="{{ route('file.edit', $file->id) }}" class="btn edit">Edit</a>
                                                <form action="{{ route('file.delete', $file->id) }}" method="post"
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
                                        <td colspan="8" style="text-align: center">No Record Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $files->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .social-icon svg {
                max-width: 60px;
            }
        </style>
        @section('scripts')
            <script>
                function copy_public_file_path(e, path, id) {
                    const file_public_url = `{{ asset('') }}f${path}/${id}`
                    window.navigator.clipboard.writeText(file_public_url)
                        .then(() => {
                            e.target.innerHTML = 'copied';
                            setTimeout(() => {
                                e.target.innerHTML = 'copy';
                            }, 2000)
                        })
                        .catch(err => {
                            console.error('Failed to copy:', err);
                        });
                }
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
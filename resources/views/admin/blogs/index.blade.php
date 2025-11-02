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
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100"
                    style="display: flex; justify-content: end; gap: 10px;">
                    <a href="{{ route('blogs.create') }}" class="btn">Add Blog</a>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-6 px-6 text-gray-900 dark:text-gray-100" id="product-count">
                        Total Blogs = {{ $blog_count }}
                    </div>
                    <div class="table-card">
                        <table class="project-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title & Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                <tr>
                                    <td>#{{ $blog->id }}</td>
                                    <td><img src="{{ asset('uploads/images/blogs/' . $blog->hero_image) }}"
                                            alt="Project Image" class="project-img"></td>
                                    <td>
                                        <div class="project-title">{{ $blog->blog_title }}</div>
                                        <div class="project-desc">{{ $blog->short_description }}</div>
                                    </td>
                                    @if($blog->status == 'published')
                                        <td><span class="status active">Active</span></td>
                                    @else
                                        <td><span class="status inactive">Deactive</span></td>
                                    @endif
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('blogs.edit', $blog->id) }}"
                                                class="btn edit">Edit</a>
                                            <form action="{{ route('blogs.delete', $blog->id) }}" method="post"
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
                                    <td colspan="5" style="text-align: center">No Record Found!</td>
                                </tr>
                                @endforelse 
                            </tbody>
                        </table>
                        <div>
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('scripts')
            <script>
                document.querySelector('#deleteRequestForm').addEventListener('submit', (e) => {
                    e.preventDefault();

                    Swal.fire({
                        title: "Are you sure you want to delete this Blog?",
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
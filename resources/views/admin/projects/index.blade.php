@section('style')
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
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100"
                    style="display: flex; justify-content: end; gap: 10px;">
                    <a href="{{ route('projects.create') }}" class="btn">Add Projects</a>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="pt-6 px-6 text-gray-900 dark:text-gray-100" id="product-count">
                        Total Projects = 5
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
                                <tr>
                                    <td>#101</td>
                                    <td><img src="/assets/images/deshivendor.png" alt="Project Image"
                                            class="project-img"></td>
                                    <td>
                                        <div class="project-title">E-Commerce Website</div>
                                        <div class="project-desc">A modern Laravel & React based shop platform.</div>
                                    </td>
                                    <td><span class="status active">Active</span></td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn edit">Edit</button>
                                            <button class="btn delete">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#102</td>
                                    <td><img src="/assets/images/Smart-Learning.png" alt="Project Image"
                                            class="project-img"></td>
                                    <td>
                                        <div class="project-title">Chat Application</div>
                                        <div class="project-desc">Real-time Laravel Reverb chat system.</div>
                                    </td>
                                    <td><span class="status pending">Pending</span></td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn edit">Edit</button>
                                            <button class="btn delete">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#103</td>
                                    <td><img src="/assets/images/ultimateorganiclife.png" alt="Project Image"
                                            class="project-img"></td>
                                    <td>
                                        <div class="project-title">Portfolio Website</div>
                                        <div class="project-desc">Personal portfolio built with Tailwind & Laravel.
                                        </div>
                                    </td>
                                    <td><span class="status inactive">Inactive</span></td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn edit">Edit</button>
                                            <button class="btn delete">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
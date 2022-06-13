@section('title', 'Publishers')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">All Categories</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('categories.create') }}" class="btn btn-info float-right">Add Category</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table order-column stripe" id="data-table">
                        <thead>
                            <th>S.No</th>
                            <th>Category Name</th>
                            <th style="width: 20%">Action</th>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="edit">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-success m-1">Edit</a>
                                        <a href="{{ route('categories.delete', $category->id) }}"
                                            class="btn btn-danger m-1" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Category Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $publishers->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('title', 'Authors')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">All Auhtors</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('authors.create') }}" class="btn btn-info float-right">Add Author</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table order-column stripe" id="data-table">
                        <thead>
                            <th>S.No</th>
                            <th>Author Name</th>
                            <th style="width: 20%">Action</th>
                        </thead>
                        <tbody>
                            @forelse ($authors as $author)
                                <tr>
                                    <td>{{ $author->id }}</td>
                                    <td>{{ $author->name }}</td>
                                    <td class="edit">
                                        <a href="{{ route('authors.edit',$author->id) }}" class="btn btn-success m-1">Edit</a>
                                        <a href="{{ route('authors.delete',$author->id) }}" class="btn btn-danger m-1" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Authors Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $authors->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@section('title', 'Books')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">All Books</h1>
                </div>
                @if (Auth::user()->role == 'admin')
                <div class="col-6">
                    <a href="{{ route('books.create') }}" class="btn btn-info float-right">Add Book</a>
                </div> 
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table order-column stripe" id="data-table">
                        <thead>
                            <th>S.No</th>
                            <th>Category</th>
                            <th>Book Name</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->author_id ? $book->author->name : 'No Author' }}</td>
                                    <td>{{ $book->publisher_id ? $book->publisher->name : 'No Publisher' }}</td>
                                    <td><span class="{{ $book->stock < 1 ? 'badge badge-danger' : '' }}">{{ $book->stock < 1 ? 'stock out' : $book->stock }}</span></td>
                                    <td class="edit">
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="btn btn-success m-1">Edit</a>
                                        <a href="{{ route('books.delete', $book->id) }}"
                                            class="btn btn-danger m-1" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Book Found</td>
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

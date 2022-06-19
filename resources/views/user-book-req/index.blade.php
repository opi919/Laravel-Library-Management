@section('title', 'Your Books')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">Your Books</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('user-book-requests.create') }}" class="btn btn-info float-right">Request a
                        Book</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table order-column stripe" id="data-table">
                        <thead>
                            <th>S.No</th>
                            <th>Book Name</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                            <th>status</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @forelse ($requests as $request)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $request->books->name }}</td>
                                    <td>{{ $request->issue_date }}</td>
                                    <td>{{ $request->return_date }}</td>
                                    <td>
                                        @if ($request->status == 'pending')
                                            <span class="badge badge-warning">{{ $request->status }}</span>
                                        @elseif ($request->status == 'notreturned')
                                            <span class="badge badge-danger">{{ $request->status }}</span>
                                        @else
                                            <span class="badge badge-success">{{ $request->status }}</span>
                                        @endif
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

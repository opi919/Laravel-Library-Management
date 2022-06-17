@section('title', 'Publishers')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">All Pending Requests</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table order-column stripe" id="data-table">
                        <thead>
                            <th>S.No</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Book Name</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th style="width: 20%">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @forelse ($requests as $request)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $request->students->name }}</td>
                                    <td>{{ $request->students->email }}</td>
                                    <td>{{ $request->books->name }}</td>
                                    <td>{{ $request->issue_date }}</td>
                                    <td>{{ $request->return_date }}</td>
                                    <td>
                                        @if ($request->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($request->status == 'approved')
                                            @if ($request->returned_date == null)
                                                <span class="badge badge-warning">Not Returned</span>
                                            @else
                                                <span class="badge badge-success">Returned at
                                                    {{ $request->returned_date }}</span>
                                            @endif
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="edit">
                                        @if ($request->status == 'pending')
                                            <a href="{{ route('book-issue.approve', $request->id) }}"
                                                class="btn btn-warning m-1">Approve</a>
                                            <a href="{{ route('book-issue.reject', $request->id) }}"
                                                class="btn btn-danger m-1" id="delete">Reject</a>
                                        @else
                                            <a href="" class="btn btn-success m-1">Edit</a>
                                            <a href="" class="btn btn-danger m-1">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No publishers Found</td>
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

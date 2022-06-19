@section('title', 'Publishers')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">All Requests</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table order-column stripe" id="data-table">
                        <thead>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            @if (Auth::user()->role == 'admin')
                                <th style="width: 20%">Action</th>
                            @endif
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @forelse ($requests as $request)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->email }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td class="edit">
                                            @if ($request->status == 0)
                                                <a href="{{ route('user-requests.approve', $request->id) }}"
                                                    class="btn btn-warning m-1">Approve</a>
                                                <a href="{{ route('user-requests.reject', $request->id) }}"
                                                    class="btn btn-danger m-1" id="delete">Reject</a>
                                            @elseif($request->status == 1)
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Request Found</td>
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

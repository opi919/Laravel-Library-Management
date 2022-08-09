@section('title', 'Book Issue | Create')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">Edit Book Issue</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('book-issue.approved') }}" class="btn btn-info float-right">Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 flex align-middle justify-center">
                    <div class="card rounded" style="width: 30rem">
                        <div class="card-body">
                            <form action="{{ route('book-issue.return',$issue->id) }}" method="POST" id="return_book">
                                @csrf
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%">Name: </td>
                                            <td><b>{{ $issue->students->name }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Book Name: </td>
                                            <td><b>{{ $issue->books->name }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td><b>{{ $issue->students->email }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Issue Date: </td>
                                            <td><b>{{ $issue->issue_date }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Return Date: </td>
                                            <td><b>{{ $issue->return_date }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Fine(TK): </td>
                                            <td><b>{{ $issue->fine }}</b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" id="return" class="btn btn-success"
                                                style="background-color: #28a745">Return</button>
                                            </td>
                                        </tr>
                                    </tbody>return
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

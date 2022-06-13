@section('title', 'Authors | Create')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">Create Author</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('authors.index') }}" class="btn btn-info float-right">All Authors</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 flex align-middle justify-center">
                    <div class="card rounded" style="width: 30rem">
                        <div class="card-body">
                            <form action="{{ route('authors.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="font-bold">Author Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Author Name">
                                </div>
                                <button type="submit" class="btn btn-success"
                                    style="background-color: #28a745">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

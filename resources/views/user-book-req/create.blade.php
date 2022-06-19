@section('title', 'Books | Create')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">Request a Book</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('user-book-requests.index') }}" class="btn btn-info float-right">Your Books</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 flex align-middle justify-center">
                    <div class="card rounded" style="width: 30rem">
                        <div class="card-body">
                            <form action="{{ route('user-book-requests.store',Auth::user()->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category" class="font-bold">Book Name<span
                                            class="text-danger">*</span></label>
                                    <select name="book" id="" class="form-control">
                                        <option value="">Select a Book</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}"
                                                {{ old('category') == $book->id ? 'selected' : '' }}>
                                                {{ $book->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('book')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success"
                                    style="background-color: #28a745">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

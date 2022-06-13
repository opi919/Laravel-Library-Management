@section('title', 'Books | Create')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">Add Book</h1>
                </div>
                <div class="col-6">
                    <a href="{{ route('books.index') }}" class="btn btn-info float-right">All Books</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 flex align-middle justify-center">
                    <div class="card rounded" style="width: 30rem">
                        <div class="card-body">
                            <form action="{{ route('books.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="font-bold">Book Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter Book Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category" class="font-bold">Category<span
                                            class="text-danger">*</span></label>
                                    <select name="category" id="" class="form-control">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="author" class="font-bold">Author</label>
                                    <select name="author" id="" class="form-control">
                                        <option value="">Select an author</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}"
                                                {{ old('author') == $author->id ? 'selected' : '' }}>
                                                {{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="publisher" class="font-bold">Publisher</label>
                                    <select name="publisher" id="" class="form-control">
                                        <option value="">Select a publisher</option>
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->id }}"
                                                {{ old('publisher') == $publisher->id ? 'selected' : '' }}>
                                                {{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stock" class="font-bold">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        placeholder="Enter stock amount" value="{{ old('stock') }}">
                                </div>
                                <button type="submit" class="btn btn-success"
                                    style="background-color: #28a745">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

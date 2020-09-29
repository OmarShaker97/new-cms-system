<x-admin-master>

    @section('content')
    
    <h1>Edit a Category</h1>

    <form method="post" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control" 
                id="name" 
                aria-describedby="" 
                placeholder="Enter Name"
                value="{{$category->name}}">
        
        </div>

        <button type='submit' class="btn btn-primary">Submit</button>
    </form>
    

    @endsection

</x-admin-master>
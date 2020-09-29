<x-admin-master>

    @section('content')

    <div class="row">
        <div class="col-sm-6">
            <h3>Edit Permission: {{$permission->name}}</h3>
    
            <form action="{{route('permissions.update', $permission->id)}}" method="post">
                @csrf
                @method('PUT')
        
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}">
                    
                </div>
        
                <button class="btn btn-primary">Update</button>
        
            </form>
        </div>
    </div>

    @endsection

</x-admin-master>
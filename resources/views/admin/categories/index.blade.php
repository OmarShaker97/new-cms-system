<x-admin-master>

    @section('content')

   
        <h1>Categories</h1>
        <div class="row">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->id}}
                            </td>
        
                            <td>
                                <a href="{{route('categories.edit', $category->id)}}">
                                    {{$category->name}}
                                    </a>
                            </td>
        
                            <td>
                                {{$category->created_at->diffForHumans()}}
                            </td>
                            
                            <td>
                                {{$category->updated_at->diffForHumans()}}
                            </td>
                            <td>
        
                      
                            <form action="{{route('categories.destroy', $category->id)}}" method="post" enctype="multipart/form-data">
                                    @method('DELETE')      
                                    @csrf
                                    <button type="submit" class='btn btn-danger'>Delete</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
    </div>

    @endsection

</x-admin-master>
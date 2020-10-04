<x-admin-master>

    @section('content')

    <h1>All Posts</h1>

    @if(session('post-create-message'))

    <div class="alert alert-success">{{Session::get('post-create-message')}}</div>

    @elseif(session('post-update-message'))

    <div class="alert alert-success">{{Session::get('post-update-message')}}</div>

    @elseif(Session::has('post-delete-message'))

    <div class="alert alert-danger">{{Session::get('post-delete-message')}}</div>

    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>View Post</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                   <th>ID</th>
                   <th>User</th>
                   <th>Title</th>
                   <th>Category</th>
                   <th>Image</th>
                   <th>View Post</th>
                   <th>Created At</th>
                   <th>Updated At</th>
                   <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        {{$post->id}}
                    </td>

                    <td>
                        {{$post->user->name}}
                    </td>
                    
                    <td>
                      @if(auth()->user()->can('view',$post))
                        <a href="{{route('post.edit', $post->id)}}">
                          {{$post->title}}
                        </a>
                      @else
                        {{$post->title}}
                      @endif
                    </td>

                    <td>
                      {{$post->category ? $post->category->name : 'Uncategorized'}}
                    </td>
                    
                    <td>
                        <img src="{{$post->post_image}}" height="40px" alt="">
                    </td>
                    <td>
                      <a href="{{route('post',$post->id)}}">View Post</a>
                    </td>
                    <td>
                        {{$post->created_at->diffForHumans()}}
                    </td>
                    
                    <td>
                        {{$post->updated_at->diffForHumans()}}
                    </td>
                    
                    <td>

                      @can('view',$post)

                    <form action="{{route('post.delete', $post->id)}}" method="post" enctype="multipart/form-data">
                            @method('DELETE')      
                            @csrf
                            <button type="submit" class='btn btn-danger'>Delete</button>
                    </form>
                      @endcan
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    
    <div class="d-flex">
      <div class="mx-auto">
        {{$posts->links()}}
      </div>
    </div>
    @endsection


    @section('scripts')

            <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
       {{--   <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}} 

    @endsection

</x-admin-master>
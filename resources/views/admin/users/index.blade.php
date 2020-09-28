<x-admin-master>

    @section('content')

    <h1>All Users</h1>

    @if(Session::has('user-delete-message'))

    <div class="alert alert-danger">{{Session::get('user-delete-message')}}</div>

    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Avatar</th>
                  <th>Email</th>
                  <th>Registered Date</th>
                  <th>Updated Profile Date</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Registered Date</th>
                    <th>Updated Profile Date</th>
                    <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{$user->id}}
                    </td>

                    <td>
                        {{$user->username}}
                    </td>

                    <td>
                        {{$user->name}}
                    </td>
                    
                    <td>
                        <img src="{{$user->avatar}}" height="40px" alt="">
                    </td>
                    
                    <td>
                        {{$user->email}}
                    </td>
                    
                    <td>
                        {{$user->created_at}}
                    </td>
                    
                    <td>
                        {{$user->updated_at}}
                    </td>
                    <td>

                    @can('view',$user)

                    <form action="{{route('user.delete', $user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
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
      
    <div class="d-flex">
        <div class="mx-auto">
          {{$users->links()}}
        </div>
      </div>
      @endsection

    @section('scripts')

            <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> -->

    @endsection

</x-admin-master>
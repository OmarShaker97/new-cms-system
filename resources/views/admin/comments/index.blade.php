<x-admin-master>

    @section('content')

        @if(count($comments) > 0)
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
                        <th>Author</th>
                        <th>Email</th>
                        <th>Body</th>
                        <th>View Post</th>
                        <th>Approve / Unapprove</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Body</th>
                            <th>View Post</th>
                            <th>Approve / Unapprove</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>
                                {{$comment->id}}
                            </td>
        
                            <td>
                                {{$comment->author}}
                            </td>
        
                            <td>
                                {{$comment->email}}
                            </td>
                            
                            <td>
                                {{$comment->body}}
                            </td>

                            <td>
                                <a href="{{route('post', $comment->post->id)}}">View Post</a>
                            </td>

                            @if($comment->is_active == 0)
                            <td>
                                <form action="{{route('comments.approve', $comment->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')      
                                    @csrf
                                    <button type="submit" class='btn btn-success'>Approve</button>
                                </form>
                            </td>

                            @else

                            <td>
                            <form action="{{route('comments.unapprove', $comment->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')      
                                    @csrf
                                    <button type="submit" class='btn btn-danger'>Unapprove</button>
                            </form>
                            </td>

                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
    </div>

    @else

    <h1 class="text-center">No Comments</h1>

    @endif
    
    @endsection

</x-admin-master>
<x-home-master>

    @section('content')
         <!-- Title -->
         <h1 class="mt-4">{{$post->title}}</h1>

         <!-- Author -->
         <p class="lead">
           by
           <a href="#">{{$post->user()->first()->name}}</a>
         </p>
 
         <hr>
 
         <!-- Date/Time -->
         <p>Posted on {{$post->created_at->diffForHumans()}}</p>
 
         <hr>
 
         <!-- Preview Image -->
         <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">
 
         <hr>
 
         <!-- Post Content -->
         <p>
             {{$post->body}}
         </p>

         <hr>

         @if(Session::has('comment-message'))

         <div class="alert alert-success">
         {{session('comment-message')}}
         </div>

         @endif
 
         @if(Auth::check())
         <!-- Comments Form -->
         <div class="card my-4">
           <h5 class="card-header">Leave a Comment:</h5>
           <div class="card-body">
            <form action="{{route('comments.store')}}" enctype="multipart/form-data" method="post">
              @method('POST')
              @csrf

              <input type="hidden" name="post_id" value="{{$post->id}}">

               <div class="form-group">
                 <textarea class="form-control" rows="3" name='body' id='body'></textarea>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
             </form>
           </div>
         </div>
         @endif

         @if(count($comments)>0)

          @foreach ($comments as $comment)
              
            @if($comment->is_active==1)
         
         <!-- Single Comment -->
         <div class="media mb-4">
         <img class="d-flex mr-3 rounded-circle" src="{{$comment->photo}}" alt="" height="50px" width="50px">
           <div class="media-body">
             <h5 class="mt-0">{{$comment->author}}</h5>
             {{$comment->body}}
             
            
            </form>

            @if (count($comment->replies) > 0)
                
              @foreach ($comment->replies as $reply)

                <!-- Nested Comment -->
              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="{{$reply->photo}}" alt="" height="50px" width="50px">
                <div class="media-body">
                  <h5 class="mt-0">{{$reply->author}}</h5>
                  {{$reply->body}}
                </div>
              </div>
              <!-- End Nested Comment -->

              @endforeach

              @endif

              <div class="media mt-4">
                <form action="{{route("replies.createReply")}}" method="post" >
                 @method('POST')
                 @csrf
                 
                 <input type="hidden" name="comment_id" value="{{$comment->id}}">
       
                 <div class="form-group">
                   <textarea class="form-control" rows="1" cols="250" name='body' id='body'></textarea>
                 </div>
                 <div class="form-group">
                 <button type="submit" class="btn btn-primary">Reply</button>
               </div>
             </div>
           </div>
         </div>

         

          @endif
 
         @endforeach
      

         @else

         <h1>No Comments </h1>

         @endif
    @endsection

</x-home-master>
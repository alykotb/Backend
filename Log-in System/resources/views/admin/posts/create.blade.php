<x-admin-master>
  @section('content')
  <h1>Create</h1>

  <form method="post" action="{{route('post.store')}}"  enctype="multipart/form-data">
   @csrf
            <div class="form-group">
                <label for="exampleInputEmail"></label>
                <input type="text" 
                        name="title" 
                        class="form-control" 
                        id="title" 
                        aria-describedby="" 
                        placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" 
                        name="post_image" 
                        class="form-control" 
                        id="post_image" >
            </div>
            <div class="form-group">
            <textarea name="body" class=""form-control  id="body"  cols="10" rows="5"></textarea>   
            </div>

            <div class="form-group">
                <label for=""></label>
                <input type="text" name="" class="form-control" id="" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button> 
        </form>
  @endsection

</x-admin-master>    
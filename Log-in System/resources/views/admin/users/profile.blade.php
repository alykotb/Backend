<x-admin-master>
    @section('content')
       <h1>User Profile for {{$user->name}}</h1>
       <div class="col-sm-6">

         <form method="post" action="{{route('user.profile.update',$user->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <img type="img-profile rounded-circle" src="{{$user->avatar}}">
            </div>
            <div class="form-group">
                <input type="file" name="avatar">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text"
                       name="username" 
 class="form-control  @error('username') is-invalid @enderror" 
                       id="username" 
                       value="{{$user->username}}">
                       @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                       @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                       name="name" 
                       class="form-control" 
                       id="name" 
                       value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" 
                       name="email" 
                       class="form-control" 
                       id="email" 
                       value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       name="password" 
                       class="form-control" 
                       id="password">
            </div>
            <div class="form-group">
                <label for="password-confirmation">Confirm Password</label>
                <input type="password" 
                       name="password-confirmation" 
                       class="form-control" 
                       id="password-confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>          
        </form>
       </div>
     
       
     <div class="row">  
       <div class="col-sm-6">
            <div class="col-sm-12">
            <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>options</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>options</th>  
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($roles as $role)
                      <tr>
                          <td>
                              <input type="checkbox"
                                     @foreach($user->roles as $user_role)
                                         @if($user_role->slug==$role->slug)
                                            checked
                                         @endif
                                      @endforeach     
                          </td>
                          <td>{{$role->id}}</td>
                          <td>{{$role->name}}</td>
                          <td>{{$role->slug}}</td>
                          <td>
                           <form method="post" action="{{route('user.role.attach',$user)}}">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="role" value="{{$role->id}}">
                              <button class="btn btn-primary" 
                                       type="submit"
                                       @if($user->roles->contains($role))
                                          disabled
                                       @endif>
                                       Attach</button> 
                           </form> 
                         </td>
                         <td>
                         <form method="post" action="{{route('user.role.detach',$user)}}">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="role" value="{{$role->id}}">
                               <button class="btn btn-danger"
                                       type="submit"
                               @if(!$user->roles->contains($role))
                                          disabled
                                       @endif>
                               Detach</button> 
                         </form>
                         </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
       </div>
     </div>  
    @endsection
</x-admin-master>
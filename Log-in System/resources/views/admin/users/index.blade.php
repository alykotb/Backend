<x-admin-master>
    @section('content')
       <h1>Users</h1>
           @if(session('user-deleted'))
              <div class="alert alert-danger">{{session('user-deleted')}}</div>
           @endif
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registered date</th>
                      <th>Updated profile data</th>
                      <td>Delete</td>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registered date</th>
                      <th>Updated profile data</th>
                      <td>Delete</td>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($users as $user)
                      <tr>
                          <td>{{$user->id}}</td>
                          <td>{{$user->username}}</td>
                          <td>
                             <img height=50px src="{{$user->avatar}}" alt="">
                          </td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->created_at->diffForHumans()}}</td>
                          <td>{{$user->updated_at->diffForHumans()}}</td>
                          <td>
                              <form method="post" action="{{route('user.destory',$user)}}">
                              @csrf
                              @method('DELETE')
                                <button class="btn btn-danger">Delete</button> 
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

    @section('scripts')
      <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>    
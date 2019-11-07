 @extends('template')
 @section('content')


  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1 class="mt-4">Category Index Create Form</h1>

       <table border="1" cellspacing="1" cellpadding="10" class="table table-striped">
         <tr>
           <th>ID</th>
           <th>Name</th>
           <th>Created At</th>
           <th colspan="2">Action</th>
         </tr>
         @foreach($category as $row)
         <tr>
           <td>{{$row->id}}</td>
           <td>{{$row->name}}</td>
           <td>{{$row->created_at}}</td>
           <td><a href="{{route('category.edit',$row->id)}}" class="btn btn-warning"> Edit</a></td>
           <td><form method="post" action="{{route('category.destroy',$row->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Delete">
             

           </form></td>
         </tr>
         @endforeach
       </table>

   </div>
       <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>
    </div>
  </div>
</div>


  @endsection
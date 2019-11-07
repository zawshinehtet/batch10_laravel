 @extends('template')
 @section('content')


  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1 class="mt-4">Post Edit Form</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                 @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                 @endforeach
               </ul>
            </div>
        @endif

       <form method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')              <!--  //route list mhr  -->
         <div class="form-group">
           <label>Name:</label>
           <input type="text" name="name" class="form-control" value="{{$category->name}}">
         </div>
         

            

         
         <div class="form-group">
           <input type="submit" name="btnsubmit" class="btn btn-warning" value="Update"> 
         </div>

       </form>
        <!-- Pager -->
        
      
    </div>
  </div>
</div>


  @endsection
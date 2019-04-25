@extends('layouts.app')
@section('title')
    Student Record
    @stop
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                 <div class="table">
                     <table class="table-hover">
                         <tr>
                             <td>Id</td>
                             <td>barcode</td>
                             <td>Name</td>
                             <td>Email</td>
                             <td>Address</td>
                             <td>Phone</td>
                             <td>Image</td>
                             <td>Delete</td>
                             <td>Update</td>
                         </tr>
                         @foreach($st as $sts)
                         <tr>
                             <td>{{$sts->id}}</td>
                             <td>  <?php  echo DNS1D::getBarcodeHTML("$sts->id", "C39");  ?></td>
                             <td>{{$sts->name}}</td>
                             <td>{{$sts->email}}</td>
                             <td>{{$sts->address}}</td>
                             <td>{{$sts->phone}}</td>
                             <td>
                                 @if($sts ->image)
                                     <img src="{{route('image_post',['img_name'=>$sts->image])}} "class="img-fluid rounded " style="width: 100px">
                                     @endif
                             </td>
                             <td>
                                 <a href="{{route('getDelete',['id'=>$sts->id])}}">Delete</a>
                             </td>
                             <td>
                                 <a href="{{route('getUpdate',['id'=>$sts->id])}}">Update</a>
                             </td>
                         </tr>
                             @endforeach
                     </table>
                 </div>
            </div>
           <div class="col-md-4">
               <div class="card shadow">
                   <div class="card-header text-center">
                       Students record
                   </div>
                   <div class="card-body">
                       <form method="post" action="{{route('studentData')}}" enctype="multipart/form-data">
                           <div class="form-group">
                               <label for="name" >Name</label>
                               <input type="text" class="form-control" id="name" name="name">
                           </div>
                           <div class="form-group">
                               <label for="email">Email</label>
                               <input type="email" class="form-control" id="email" name="email">
                           </div>
                           <div class="form-group">
                               <label for="address">Address</label>
                               <textarea class="form-control" id="address" name="address"></textarea>
                           </div>
                           <div class="form-group">
                               <label for="phone" >Phone Number</label>
                               <input type="number" id="phone" name="phone" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="image" >Image</label>
                               <input type="file" id="image" name="image" class="form-control">
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary btn-block">Save</button>
                           </div>
                           {{csrf_field()}}
                       </form>
                   </div>
               </div>
           </div>
        </div>
    </div>
@endsection


@extends('layouts.app')
@section('title')
    Student Record
@stop
@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header text-center">
                        Students record
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('updateData')}}" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$st->id}}">
                            <div class="form-group">
                                <label for="name" >Name</label>
                                <input value="{{$st->name}}" type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input value="{{$st->email}}"  type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address">{{$st->address}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone" >Phone Number</label>
                                <input value="{{$st->phone}}" type="number" id="phone" name="phone" class="form-control">
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


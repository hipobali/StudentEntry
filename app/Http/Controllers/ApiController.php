<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function getSearch($q){
        $st=Student::where('id','LIKE',"%$q%")->orwhere('name','LIKE',"%$q%")->orwhere('email','LIKE',"%$q%")->orwhere('address','LIKE',"%$q%")->orwhere('phone','LIKE',"%$q%")->orwhere('image','LIKE',"%$q%")->get(); 
        if(count($st) > 0) {
            return response()->json(['message '=> $st]);
        }else{
            return response()->json(['message' => "the post is not found"]);
        }
    }
    public function getStudent()
    {
        $st = Student::all();
        return response()->json($st);
    }

    public function postStudent(Request $request)
    {
        $img_name = $request['name'] . '.' . $request->file('image')->getClientOriginalExtension();
        $img_file = $request->file('image');
        $st = new Student();
        $st->name = $request['name'];
        $st->email = $request['email'];
        $st->address = $request['address'];
        $st->phone = $request['phone'];
        $st->image = $img_name;
        $st->save();
        Storage::disk('StudentFile')->put($img_name, file::get($img_file));
        return response()->json(['message' => 'this is postStudent']);

    }

    public function getDelete(Request $request)
    {
        $id = $request['id'];
        $post = Student::whereId($id)->first();
        if ($post) {
            $post->delete();
            return response()->json(['message' => "the post have been deleted"]);
        } else {
            return response()->json(['message' => "the post have not found"]);

        }

    }

    public function updateData(Request $request)
    {
        $image = $request->file('image');
        $id = $request['id'];
        $st = Student::whereId($id)->first();
      if($st){
          if (!empty($image)) {
              Storage::disk('StudentFile')->delete($st->image);
              $image_name = $request['name'] . '.' . $request->file('image')->getClientOriginalExtension();
              $st->image = $image_name;
              Storage::disk('StudentFile')->put($image_name, File::get($image));
          }
          $st->name = $request['name'];
          $st->email = $request['email'];
          $st->address = $request['address'];
          $st->phone = $request['phone'];
          $st->update();
          return response()->json(["message"=>"the post have been updated"]);
      }else{
          return response()->json(["message"=>"the post cannot update"]);
      }

    }
}
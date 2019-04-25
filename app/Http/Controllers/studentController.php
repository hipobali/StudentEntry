<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class studentController extends Controller
{
    public function updateData(Request $request){
        $image=$request->file('image');
        $id=$request['id'];
        $st=Student::whereId($id)->firstOrFail();
        if(!empty($image)){
            Storage::disk('StudentFile')->delete($st->image);
            $image_name=$request['name'].'.'.$request->file('image')->getClientOriginalExtension();
            $st->image=$image_name;
            Storage::disk('StudentFile')->put($image_name,File::get($image));
        }
        $st->name=$request['name'];
        $st->email=$request['email'];
        $st->address=$request['address'];
        $st->phone=$request['phone'];
        $st->update();
        return redirect()->route('student_data');
    }
    public function getUpdate($id){
        $st=Student::whereId($id)->firstOrFail();
        return view('update')->with(['st'=>$st]);
    }
    public function getDelete(Request $request){
        $id=$request['id'];
        $st=Student::whereId($id)->firstOrFail();
        Storage::disk('StudentFile')->delete($st->image);
        $result=$st->delete();
        return redirect()->back();

    }

    public function imagePost($img_name){
        $file=Storage::disk('StudentFile')->get($img_name);
        return response($file,200);
    }

    public function getStudent()
    {
        $st=Student::OrderBy('id','desc')->get();
        return view('student')->with(['st'=>$st]);
    }

    public function postStudent(Request $request)
    {
        $img_name=$request['name'].'.'.$request->file('image')->getClientOriginalExtension();
        $img_file=$request->file('image');
        $st=new Student();
        $st->name=$request['name'];
        $st->email=$request['email'];
        $st->address=$request['address'];
        $st->phone=$request['phone'];
        $st->image=$img_name;
        $st->save();

 Storage::disk('StudentFile')->put($img_name,file::get($img_file));
        return redirect()->back();

    }
}
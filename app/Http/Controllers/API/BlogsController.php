<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blogs::all()->toArray();
        return array_reverse($blogs);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
        }

        Blogs::create($input);

        return response()->json(['success'=> 'Blog created successfully']);

    }

    public function edit($id)
    {
        $blog = Blogs::find($id);
        return response()->json($blog);
    }

    public function update($id, Request $request)
    {
        $blog = Blogs::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
            unlink('img/'.$blog->image);
        }

        $blogt->update($input);

        return response()->json(['success'=> 'Blog update successfully']);
    }

    public function delete($id)
    {
        $blog = Blogs::find($id);
        $blog->delete();
        unlink('img/'.$blog->image);
        return response()->json(['success'=> 'Blog deleted successfully']);

    }
}

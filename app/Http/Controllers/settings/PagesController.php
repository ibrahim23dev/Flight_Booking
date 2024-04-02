<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use Illuminate\Support\Str;


class PagesController extends Controller
{
    public function index(){
        $pages = Page::orderBy("created_at","desc")->get();
        return view('backend/contents/pages/index',compact('pages'));
    }

    public function create(){
        return view('backend/contents/pages/create');

    }

    public function store(Request $request){

        $request->validate([
           
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Validating image format and size

        ]);
        $imageName=null;
        if ($request->hasFile('image')) { 

        $image = $request->file('image');
        $imageName ='feature_'. time() . $image->getClientOriginalName();
        $imagePath = $image->storeAs('images/pages', $imageName, 'public');
      }
    // Generate a unique slug based on the page title

      $slug = Str::slug($request->input('title'));
      $count = Page::where('slug', $slug)->count();
      if ($count > 0) {
          $slug = $slug . '-' . ($count + 1);
      }
        $page = new Page([
           
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'content' => $request->input('content'),
            'image'=>$imageName,
            'slug' => $slug,
        ]);
         // Save the testimonial to the database
          $page->save();
    
         // Redirect back with a success message
         return redirect()->route('pages.index')->with('success', 'Page created successfully.');

    }

    public function edit($id){
        $page=Page::findOrfail($id);
        return view('backend/contents/pages/update',compact('page'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
           
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'content' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048', // Validating image format and size (optional)
    
        ]);
    
        // Find the page record in the database
        $page = Page::findOrFail($id);
    
        $page->title = $request->input('title');
        $page->status = $request->input('status');
        $page->content = $request->input('content');
    
        // Check if a new image is uploaded and update the image field accordingly
        if ($request->hasFile('image')) {
            // Delete the old image from storage if exists
            if ($page->image && Storage::disk('public')->exists('images/pages/' . $page->image)) {
                Storage::disk('public')->delete('images/pages/' . $page->image);
            }
            $image = $request->file('image');
            $imageName = 'feature_' . time() . '.' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images/pages', $imageName, 'public');
            $page->image = $imageName;
    
        }
    
        // Save the updated page to the database
        $page->save();
    
        // Redirect back with a success message
        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
      // Find the page by its ID
      $page = Page::findOrFail($id);
  
      // Delete the image if it exists
      if ($page->image) {
          Storage::disk('public')->delete('images/pages/' . $page->image);
      }
  
      // Delete the blog
      $page->delete();
  
      // Redirect back with a success message
      return redirect()->back()->with('success', 'Page deleted successfully.');
    }


    public function uploadImage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Get the uploaded file
        $uploadedFile = $request->file('upload');

        // Move the uploaded file to a public directory (or any other directory you prefer)
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->storeAs('public/images/pages', $fileName);

        // Get the URL for the uploaded file
        $fileUrl = asset('storage/images/pages/' . $fileName);

        // Return the file URL to CKEditor
        return response()->json([
            'uploaded' => true,
            'url' => $fileUrl,
        ]);
    }
}

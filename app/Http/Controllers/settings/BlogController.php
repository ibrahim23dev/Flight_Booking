<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SectionsContent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
class BlogController extends Controller
{
    public function index(Request $request){
        $query = Blog::orderBy('created_at', 'desc');
        
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        }
        
        $blogs = $query->get();
        
        return view('backend/contents/blogs/blog', compact('blogs'));
    }
    

    public function create(){
        return view('backend/contents/blogs/create');


    }
    public function store(Request $request){
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'description' => 'required|string',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Validating image format and size

        ]);

        $image = $request->file('image');
        $imageName ='feature_'. time() . $image->getClientOriginalName();
        $imagePath = $image->storeAs('images/blogs', $imageName, 'public');
            // Generate a unique slug based on the blog title
        $slug = Str::slug($request->input('title'));
        $count = Blog::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $blog = new Blog([
            'category' => $request->input('category'),
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'image'=>$imageName,
            'slug' => $slug,
        ]);
         // Save the testimonial to the database
          $blog->save();
    
         // Redirect back with a success message
         return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');

    }

    public function edit($id){
        $blog=Blog::findOrfail($id);
        return view('backend/contents/blogs/update',compact('blog'));
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'description' => 'required|string',
            'content' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048', // Validating image format and size (optional)
    
        ]);
    
        // Find the blog record in the database
        $blog = Blog::findOrFail($id);
    
        // Update the blog fields with new data
        $blog->category = $request->input('category');
        $blog->title = $request->input('title');
        $blog->status = $request->input('status');
        $blog->description = $request->input('description');
        $blog->content = $request->input('content');
    
        // Check if a new image is uploaded and update the image field accordingly
        if ($request->hasFile('image')) {
            // Delete the old image from storage if exists
            if ($blog->image && Storage::disk('public')->exists('images/blogs/' . $blog->image)) {
                Storage::disk('public')->delete('images/blogs/' . $blog->image);
            }
            $image = $request->file('image');
            $imageName = 'feature_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/blogs', $imageName, 'public');
            $blog->image = $imageName;
    

        }
    
        // Save the updated blog to the database
        $blog->save();
    
        // Redirect back with a success message
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }
    
    public function destroy(Request $request, $id)
  {
    // Find the blog by its ID
    $blog = Blog::findOrFail($id);

    // Delete the image if it exists
    if ($blog->image) {
        Storage::disk('public')->delete('images/blogs/' . $blog->image);
    }

    // Delete the blog
    $blog->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Blog deleted successfully.');
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
        $uploadedFile->storeAs('public/images/blogs', $fileName);

        // Get the URL for the uploaded file
        $fileUrl = asset('storage/images/blogs/' . $fileName);

        // Return the file URL to CKEditor
        return response()->json([
            'uploaded' => true,
            'url' => $fileUrl,
        ]);
    }
}
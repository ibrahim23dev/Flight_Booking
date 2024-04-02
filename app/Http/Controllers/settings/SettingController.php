<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SectionsContent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\identity;
use App\Models\Testimonial;
use App\Models\about;
use App\Models\ContactDetail;
use App\Models\TermsPrivacy;
use Illuminate\Support\Facades\Validator;
class SettingController extends Controller
{


    public function sectionsIndex(){
        $sections = SectionsContent::all();
        return view('backend/contents/sections/section',compact('sections'));
    }

    public function sectionsEdit(Request $request,$id){
        $section=SectionsContent::findOrfail($id);
        // dd(json_decode($section->section_content));
        return view('backend/contents/sections/update',compact('section'));

    }

    public function sectionUpdate(Request $request, $id)
    {
        $request->validate([
            'section_heading' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'image.*' => 'nullable|mimes:jpg,png,gif|max:2048',
            // Add more validation rules for the titles, descriptions, price, from, and to fields (if needed)
        ]);
    
        $section = SectionsContent::findOrFail($id);
    
        $section->section_heading = $request->section_heading;
        $section->short_title = $request->short_title;
    
        $section_content = [];
        foreach (json_decode($section->section_content, true) as $key => $item) {
            $imageKey = 'image' . $key;
            $titleKey = 'title' . $key;
            $descriptionKey = 'description' . $key;
    
            if ($request->hasFile($imageKey)) {
                $image = $request->file($imageKey);

                // Validate the uploaded image
                $validatedData = $request->validate([
                    $imageKey => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048', // Adjust the max file size as per your requirement
                ]);

                if ($section->section_content) {
                    $oldImage = $item['image'];
                    Storage::disk('public')->delete('images/sections/' . $oldImage);
                }
                $imageName = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images/sections', $imageName, 'public');
                $item['image'] = $imageName;
            }
    
            $item['title'] = $request->input($titleKey);
            if(isset($item['description'])){
                $item['description'] = $request->input($descriptionKey);
            }
    
            if (isset($item['price'])) {
                $priceKey = 'price' . $key;
                $fromKey = 'from' . $key;
                $toKey = 'to' . $key;
    
                $item['price'] = $request->input($priceKey);
                $item['from'] = $request->input($fromKey);
                $item['to'] = $request->input($toKey);
            }
    
            $section_content[] = $item;
        }
    
        $section->section_content = json_encode($section_content);
        $section->save();
    
        return redirect()->back()->with('success', 'Section content updated successfully.');
    }

    public function sectionAdd(Request $request,$id){
        $section=SectionsContent::findOrfail($id);
        return view('backend/contents/sections/section-create',compact('section'));
    }

    public function sectionCreate(Request $request, $id)
    {
        // Get the section by ID
        $section = SectionsContent::findOrFail($id);
    
        // Validate the incoming form data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'from' => 'nullable|string',
            'to' => 'nullable|string',
        ]);
    
        // Handle the new section content
        $newImage = $request->file('image');
        $newImageName = time() . '_' . Str::random(8) . '.' . $newImage->getClientOriginalExtension();
        $newImagePath = $newImage->storeAs('images/sections', $newImageName, 'public');
    
        $newSectionContent = [
            'image' => $newImageName,
            'title' => $request->input('title'),
        ];

        $newSectionContent['description'] = $request->input('description');
    
        if ($request->filled('price')) {
            $newSectionContent['price'] = $request->input('price');
        }
    
        if ($request->filled('from') && $request->filled('to')) {
            $newSectionContent['from'] = $request->input('from');
            $newSectionContent['to'] = $request->input('to');
        }
    
        // Decode existing section content
        $sectionContent = json_decode($section->section_content, true);
    
        // Add the new content to the section content array
        $sectionContent[] = $newSectionContent;
        // Update the section content as JSON
        $section->section_content = json_encode($sectionContent);
        $section->save();
    
        return redirect()->back()->with('success', 'New content added successfully.');
    }
    

    public function removeContent(Request $request, $sectionId, $contentIndex)
  {
    // Get the section by ID
    $section = SectionsContent::findOrFail($sectionId);

    // Decode existing section content
    $sectionContent = json_decode($section->section_content, true);

    // Ensure the content index is within the valid range
    if ($contentIndex >= 0 && $contentIndex < count($sectionContent)) {
        // Remove the content at the specified index
        $removedContent = array_splice($sectionContent, $contentIndex, 1);

        // Delete the associated image from storage (if it exists)
        $imagePath = 'public/images/sections/' . $removedContent[0]['image'];
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        // Update the section content as JSON
        $section->section_content = json_encode($sectionContent);
        $section->save();

        return redirect()->back()->with('success', 'Content removed successfully.');
    }

    return redirect()->back()->with('error', 'Invalid content index.');
  }

    public function siteIdentityIndex(){
        $site=identity::first();
        return view('backend/contents/identity/site-identity',compact('site'));

    }

    public function siteIdentityUpdate(Request $request, $id)
    {

        try {
            // Define validation rules
            $rules = [
                'site_title' => 'sometimes|string|max:255',
                'logo_image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:2048',
                'social_links' => 'sometimes|json',
            ];
    
            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            
            // Validate the request
            if ($validator->fails()) {
                return response()->json(['success'=>false, 'errors' => $validator->errors()], 422);
            }
    
            // Get the site identity data by the section
            $identity = Identity::findOrFail($id);
    
            // Update the site title if provided
            if ($request->has('site_title')) {
                $identity->site_title = $request->site_title;
            }
    
            // Handle the uploaded image (if provided)
            if ($request->hasFile('logo_image')) {
                $image = $request->file('logo_image');
    
                // Generate a unique name for the image by concatenating timestamp and original name
                $imageName = time() . '_logo_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('images/site_identity', $imageName, 'public');
    
                // Delete the old site logo image from storage if it exists
                if ($identity->logo_image && Storage::exists('public/images/site_identity/' . $identity->logo_image)) {
                    Storage::delete('public/images/site_identity/' . $identity->logo_image);
                }
    
                // Save the new image name to the database
                $identity->logo_image = $imageName;
            }
    
            // Handle the social links (if provided)
            if ($request->has('social_links')) {
                $socialLinks = json_decode($request->social_links);
                $identity->social_links = $socialLinks;
            }
    
            // Save the updated site identity
            $identity->save();
    
            return response()->json(['success'=>true, 'message' => 'Site identity updated successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error message: ' . $e->getMessage());
            // Handle any unexpected errors here
            return response()->json(['success'=>false, 'error' => 'Server error'], 500);
        }
    }
    
  ///////////////////////// site identity methods end ///////////////////

    public function index(){
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        
        return view('backend/contents/testimonials/testimonials',compact('testimonials'));

    }
    public function create(){
        return view('backend/contents/testimonials/create');

    }

    public function store(Request $request)
    {
        // Validate the incoming form data
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'text' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validating image format and size
        ]);
    
        // Handle the uploaded image
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('images/testimonials', $imageName, 'public');
    
        // Create a new Testimonial instance and fill it with the validated data
        $testimonial = new Testimonial([
            'name' => $request->input('name'),
            'designation' => $request->input('designation'),
            'status' => $request->input('status'),
            'text' => $request->input('text'),
            'image' => $imageName,
        ]);
    
        // Save the testimonial to the database
        $testimonial->save();
    
        // Redirect back with a success message
        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Request $request ,$id){
        $testimonial=Testimonial::findOrfail($id);
        return view('backend/contents/testimonials/update',compact('testimonial'));

    }
    public function update(Request $request, $id)
{
    // Validate the incoming form data
    $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'designation' => 'sometimes|required|string|max:255',
        'status' => 'sometimes|required|in:active,inactive',
        'text' => 'sometimes|required|string|max:255',
        'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg|max:2048', // Validating image format and size
    ]);

    // Get the testimonial by ID
    $testimonial = Testimonial::findOrFail($id);

    // Update the testimonial properties
    $testimonial->name = $request->input('name', $testimonial->name);
    $testimonial->designation = $request->input('designation', $testimonial->designation);
    $testimonial->status = $request->input('status', $testimonial->status);
    $testimonial->text = $request->input('text', $testimonial->text);

    // Handle the uploaded image (if provided)
    if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Generate a unique name for the image by concatenating timestamp and original name
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('images/testimonials', $imageName, 'public');

        // Delete the old image if it exists
        if ($testimonial->image && Storage::disk('public')->exists('images/testimonials/' . $testimonial->image)) {
            Storage::disk('public')->delete('images/testimonials/' . $testimonial->image);
        }

        $testimonial->image = $imageName; // Store the unique name in the testimonial
    }

    // Save the updated testimonial
    $testimonial->save();

    // Redirect back with a success message
    return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
}

    public function destroy($id)
    {
        // Get the testimonial by ID
        $testimonial = Testimonial::findOrFail($id);
        // Delete the testimonial's image from storage (if it exists)
        if ($testimonial->image && Storage::disk('public')->exists('images/testimonials/' . $testimonial->image)) {
            Storage::disk('public')->delete('images/testimonials/' . $testimonial->image);
        }

        // Delete the testimonial from the database
        $testimonial->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Testimonial deleted successfully.');
    }
  ///////////////////////// testimonials identity methods end ///////////////////
 


  public function contactPageIndex(){
    $contact=ContactDetail::first();
    
    return view('backend/contents/pages/contact-page',compact('contact'));
  }
  public function contactPageUpdate(Request $request, $id)
  {
    // Validate the incoming form data
    $request->validate([
        'phone' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:255',
        'maps_address' => 'nullable|string',
    ]);

    // Get the contact details by ID
    $contact = ContactDetail::findOrFail($id);

    // Update the fields
    $contact->phone = $request->input('phone');
    $contact->email = $request->input('email');
    $contact->address = $request->input('address');
    $contact->maps_address = $request->input('maps_address');

    // Save the updated contact details
    $contact->save();
    $request->session()->forget('success');
   
    // Redirect back with a success message
    return redirect()->back()->with('success', 'Contact details updated successfully.');

  }

  /////////////////////// contact page end //////////////////////////////////


   /////////////////////// terms page //////////////////////////////////////
   public function termsIndex(){
    $terms=TermsPrivacy::all();
    return view('backend/contents/terms/term',compact('terms'));

}
public function termsEdit($id){
    $term=TermsPrivacy::findOrfail($id);
    return view('backend/contents/terms/update',compact('term'));
   
}
public function termsUpdate(Request $request, $id)
{
$request->validate([
    'title' => 'sometimes|required|string|max:255',
    'points' => 'sometimes|required|array',
    'points.*.heading' => 'sometimes|required|string|max:255',
    'points.*.description' => 'sometimes|required|string',
]);

$term = TermsPrivacy::findOrFail($id);

$term->title = $request->input('title');
$term->points = json_encode($request->input('points'));
$term->save();

return redirect()->route('/settings/terms.index')->with('success', 'Term updated successfully.');
}

/////////////////////// terms page end//////////////////////////////////


}

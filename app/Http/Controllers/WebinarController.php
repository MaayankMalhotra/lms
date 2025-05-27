<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use App\Models\WebinarEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
    // public function show()
    // {
    //     $webinars = Webinar::latest()->get();
    //     // Collect tags from all webinars, explode them, and remove duplicates
    //     $allTags = Webinar::pluck('tags')->implode(','); // Concatenate all tags into a single string
    //     $tagsArray = explode(',', $allTags); // Split the string into individual tags
    //     $uniqueTags = array_unique(array_map('trim', $tagsArray)); // Remove duplicates and trim spaces
    //     return view('website.webinars', compact('webinars','uniqueTags'));
    // }

    public function show(Request $request)
{
    $selectedTag = $request->query('tag');

    // Filter webinars by selected tag if present
    $webinars = Webinar::when($selectedTag, function ($query) use ($selectedTag) {
        return $query->where('tags', 'LIKE', '%' . $selectedTag . '%');
    })->latest()->get();

    // Collect and clean all tags from all webinars
    $allTags = Webinar::pluck('tags')->implode(',');
    $tagsArray = array_filter(array_map('trim', explode(',', $allTags)));
    $uniqueTags = array_unique($tagsArray);

    return view('website.webinars', compact('webinars', 'uniqueTags', 'selectedTag'));
}

public function showWebinar($id){
    $webinar = Webinar::findOrFail($id);
    return view ('website.webinar.webinar_detail',compact('webinar'));
}

 public function enroll(Request $request, $id)
    {
        $webinar = Webinar::where('id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'comments' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        WebinarEnrollment::create([
            'webinar_id' => $webinar->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comments' => $request->comments,
        ]);

        return redirect()->back()->with('success', 'Successfully enrolled in the webinar!');
    }




    public function index(){
        $webinars = Webinar::latest()->paginate(10);
        return view('admin.webinar.index', compact('webinars'));
    }

    public function create(){
        return view('admin.webinar.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image_url' => 'nullable|url',
        'start_time' => 'required|date',
        'registration_deadline' => 'required|date|after_or_equal:today',
        'entry_type' => 'required|string|max:255',
        'participants_count' => 'nullable|integer|min:0',
        'tags' => 'nullable|string|max:255',
    ]);

    Webinar::create([
        'title' => $request->title,
        'description' => $request->description,
        'image_url' => $request->image_url,
        'start_time' => $request->start_time,
        'registration_deadline' => $request->registration_deadline,
        'entry_type' => $request->entry_type,
        'participants_count' => $request->participants_count ?? 0,
        'tags' => $request->tags,
    ]);

    return redirect()->route('admin.webinar.index')->with('success', 'Webinar created successfully.');
}
public function edit($id)
{
    $webinar = Webinar::findOrFail($id);
    return view('admin.webinar.edit', compact('webinar'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image_url' => 'nullable|url',
        'start_time' => 'required|date',
        'registration_deadline' => 'required|date|after_or_equal:today',
        'entry_type' => 'required|string|max:255',
        'participants_count' => 'nullable|integer|min:0',
        'tags' => 'nullable|string|max:255',
    ]);

    $webinar = Webinar::findOrFail($id);
    $webinar->update($request->all());

    return redirect()->route('admin.webinar.index')->with('success', 'Webinar updated successfully!');
}
public function destroy($id)
{
    $webinar = Webinar::findOrFail($id);
    $webinar->delete();

    return redirect()->route('admin.webinar.index')->with('success', 'Webinar deleted successfully!');
}

}

<?php

namespace App\Http\Controllers;

use App\Mail\WebinarConfirmation;
use App\Models\Webinar;
use App\Models\WebinarEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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




    public function index(Request $request){
        $query=Webinar::query();

        if($tag=$request->query('tag')){
            $query->where('tags','LIKE','%'.$tag.'%');
        }
        $webinars = $query->latest()->paginate(10);

        $allTags = Webinar::pluck('tags')->implode(',');
        $tagsArray = array_filter(array_map('trim', explode(',', $allTags)));
        $uniqueTags = array_unique($tagsArray);
        return view('admin.webinar.index', compact('webinars','uniqueTags'));
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
public function enrollments(Request $request)
{
    // $enrollments = WebinarEnrollment::latest()->paginate(10);
    $webinars = Webinar::all(); // Fetch all webinars for the dropdown
    $query = WebinarEnrollment::query();
    if ($webinarId = $request->query('webinar_id')) {
        $query->where('webinar_id', $webinarId);
    }
    $enrollments = $query->with('webinar')->latest()->paginate(10);
    return view('admin.webinar.webinar-enrollment', compact('enrollments','webinars'));
}
public function sendConfirmation(Request $request)
    {
        $validated = $request->validate([
            'attendance_code' => 'required|string',
            'meeting_id' => 'required|string',
            'meeting_link' => 'required|url',
            'meeting_password' => 'required|string',
            'webinar_id' => 'nullable|exists:webinars,id',
        ]);
        // Fetch enrollments based on webinar_id
        $query = WebinarEnrollment::query();
        if ($validated['webinar_id']) {
            $query->where('webinar_id', $validated['webinar_id']);
            
        }
        $enrollments = $query->get();

        if ($enrollments->isEmpty()) {
            return response()->json(['message' => 'No enrollments found for the selected webinar'], 400);
        }

        // Update enrollments with confirmation data
        foreach ($enrollments as $enrollment) {
            $enrollment->update([
                'attendance_code' => $validated['attendance_code'],
                'meeting_id' => $validated['meeting_id'],
                'meeting_link' => $validated['meeting_link'],
                'meeting_password' => $validated['meeting_password'],
            ]);

            // Send email to each enrollee
             Mail::to(['ashwani.rai@henryharvin.in','sandeep@henryharvin.in'])->send(new WebinarConfirmation($validated, $enrollment));
        }

        return response()->json(['message' => 'Confirmation emails sent and data saved successfully']);
    }

}

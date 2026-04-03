<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Form;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $forms = Form::all();

        $submissions = Submission::with('form')
            ->when($request->form_id, function($q) use ($request){
                $q->where('form_id', $request->form_id);
            })
            ->latest()
            ->paginate(10);

        return view('admin.submissions.index', compact('submissions','forms'));
    }

    public function destroy($id)
    {
        Submission::findOrFail($id)->delete();
        return back()->with('success','Deleted');
    }

    public function userSubmissions()
    {
        $submissions = Submission::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.submissions.index', compact('submissions'));
    }
}
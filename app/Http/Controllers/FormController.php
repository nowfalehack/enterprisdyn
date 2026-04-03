<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        $form = Form::create([
            'title' => $request->title,
            'status' => 1
        ]);

        if ($request->fields) {
            foreach ($request->fields as $field) {

                if (!isset($field['label']) || trim($field['label']) == '') continue;

                $form->fields()->create([
                    'label' => $field['label'],
                    'type' => $field['type'] ?? 'text',
                    'required' => isset($field['required']) ? 1 : 0,
                    'validation' => $field['validation'] ?? null,
                    'order' => $field['order'] ?? 0,
                    'options' => isset($field['options']) 
                        ? explode(',', $field['options']) 
                        : null,
                ]);
            }
        }

        return redirect('/admin/forms')->with('success','Form Created');
    }

    public function fillForm($id)
    {
        $form = Form::with('fields')->findOrFail($id);
        return view('user.forms.fill', compact('form'));
    }

    // 🔥 FULL DYNAMIC VALIDATION ENGINE
    public function submit(Request $request, $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $rules = [];

        foreach ($form->fields as $field) {

            $rule = [];

            if ($field->required) $rule[] = 'required';

            // FULL dynamic validation
            if (!empty($field->validation)) {
                $rule = array_merge($rule, explode('|', $field->validation));
            }

            // fallback safety
            if ($field->type == 'email') $rule[] = 'email';
            if ($field->type == 'number') $rule[] = 'numeric';

            $rules['field_'.$field->id] = $rule;
        }

        $validated = $request->validate($rules);

        $finalData = [];

        foreach ($form->fields as $field) {
            $finalData[$field->label] = $validated['field_'.$field->id] ?? null;
        }

        Submission::create([
            'form_id' => $form->id,
            'user_id' => auth()->id(),
            'data' => $finalData
        ]);

        return back()->with('success','Form Submitted!');
    }
}
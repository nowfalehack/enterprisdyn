<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->get();
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $form = Form::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        // ❗ Default fields (NOT stored)
        $defaultFields = ['name', 'email', 'phone'];

        if ($request->fields) {
            foreach ($request->fields as $field) {

                if (!isset($field['label']) || trim($field['label']) == '') continue;

                $label = strtolower(trim($field['label']));

                // ❌ Skip default fields
                if (in_array($label, $defaultFields)) continue;

                $form->fields()->create([
                    'label' => $field['label'],
                    'type' => $field['type'] ?? 'text',
                    'required' => isset($field['required']) ? 1 : 0,

                    // ✅ FIX
                    'validation' => isset($field['validation'])
                        ? implode('|', $field['validation'])
                        : null,

                    'order' => $field['order'] ?? 0,

                    // ✅ FIX
                    'options' => $field['options'] ?? null,
                ]);
            }
        }

        return redirect('/admin/forms')->with('success', 'Form Created');
    }

    public function show($id)
    {
        $form = Form::with('fields')->findOrFail($id);
        return view('admin.forms.show', compact('form'));
    }
    // EDIT FORM PAGE
public function edit($id)
{
    $form = Form::with('fields')->findOrFail($id);

    return view('admin.forms.edit', compact('form'));
}


// UPDATE FORM
public function update(Request $request, $id)
{
    $form = Form::findOrFail($id);

    $form->update([
        'title' => $request->title,
        'status' => $request->status
    ]);

    // delete old fields
    $form->fields()->delete();

    // re-insert fields
    if ($request->fields) {
        foreach ($request->fields as $field) {

            if (!isset($field['label']) || trim($field['label']) == '') continue;

            $form->fields()->create([
                'label' => $field['label'],
                'type' => $field['type'] ?? 'text',
                'required' => isset($field['required']) ? 1 : 0,
                'validation' => isset($field['validation']) 
                    ? implode('|', $field['validation']) 
                    : null,
                'order' => $field['order'] ?? 0,
                'options' => $field['options'] ?? null,
            ]);
        }
    }

    return redirect('/admin/forms')->with('success', 'Form Updated');
}


public function destroy($id)
{
    $form = Form::findOrFail($id);

    // delete related fields first
    $form->fields()->delete();

    // delete form
    $form->delete();

    return redirect('/admin/forms')->with('success', 'Form Deleted Successfully');
}

    public function userForms()
    {
        $forms = Form::where('status', 1)->get();
        return view('user.forms', compact('forms'));
    }

    public function fillForm($id)
    {
        $form = Form::with('fields')->findOrFail($id);
        return view('user.forms.fill', compact('form'));
    }

    public function submit(Request $request, $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $rules = [];

        // ✅ DEFAULT FIELDS VALIDATION
        $rules['name'] = 'required';
        $rules['email'] = 'required|email';
        $rules['phone'] = 'nullable|numeric';

        // ✅ DYNAMIC VALIDATION
        foreach ($form->fields as $field) {

            $rule = [];

            if ($field->required) $rule[] = 'required';

            if (!empty($field->validation)) {
                $rule = array_merge($rule, explode('|', $field->validation));
            }

            if ($field->type == 'email') $rule[] = 'email';
            if ($field->type == 'number') $rule[] = 'numeric';

            $rules['field_' . $field->id] = $rule;
        }

        $validated = $request->validate($rules);

        // ✅ FINAL DATA STORE
        $finalData = [
            'Name' => $request->name,
            'Email' => $request->email,
            'Phone' => $request->phone,
        ];

        foreach ($form->fields as $field) {
            $value = $validated['field_' . $field->id] ?? null;

            // ✅ handle checkbox array
            if (is_array($value)) {
                $value = implode(',', $value);
            }

            $finalData[$field->label] = $value;
        }

        Submission::create([
            'form_id' => $form->id,
            'user_id' => auth()->id(),
            'data' => $finalData
        ]);

        return back()->with('success', 'Form Submitted!');
    }
}
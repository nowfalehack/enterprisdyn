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

        // ❗ Default fields (NOT stored in DB)
        $defaultFields = ['name', 'email', 'phone'];

        if ($request->fields) {

            foreach ($request->fields as $field) {

                // skip empty
                if (!isset($field['label']) || trim($field['label']) == '') continue;

                $label = strtolower(trim($field['label']));

                // ❌ skip duplicate default fields
                if (in_array($label, $defaultFields)) continue;

                $form->fields()->create([
                    'label' => $field['label'],
                    'type' => $field['type'] ?? 'text',
                    'required' => isset($field['required']) ? 1 : 0,

                    // ✅ FIX (array → string)
                    'validation' => isset($field['validation'])
                        ? implode('|', $field['validation'])
                        : null,

                    'order' => $field['order'] ?? 0,

                    // ✅ store as string
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

        // ✅ DEFAULT VALIDATION
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

        $finalData = [
            'Name' => $request->name,
            'Email' => $request->email,
            'Phone' => $request->phone,
        ];

        foreach ($form->fields as $field) {
            $finalData[$field->label] = $validated['field_' . $field->id] ?? null;
        }

        Submission::create([
            'form_id' => $form->id,
            'user_id' => auth()->id(),
            'data' => $finalData
        ]);

        return back()->with('success', 'Form Submitted!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Submission;

class ImportController extends Controller
{
    // 📥 Upload Page
    public function index()
    {
        return view('admin.import.index');
    }

    // 🔍 Preview CSV
    public function preview(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('csv'), 'r');

        $valid = [];
        $invalid = [];

        // ✅ Get header row
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {

            // 🔥 Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            // 🔥 Map dynamically using header
            $data = [];
            foreach ($header as $index => $column) {
                $data[strtolower(trim($column))] = trim($row[$index] ?? '');
            }

            // 🔥 Validation rules
            $validator = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                $invalid[] = $data;
            } else {
                $valid[] = $data;
            }
        }

        fclose($file);

        return view('admin.import.preview', [
            'valid' => $valid,
            'invalid' => $invalid,
            'jsonValid' => json_encode($valid) // for submit
        ]);
    }

    // 💾 Store Valid Data
    public function store(Request $request)
    {
        $valid = json_decode($request->valid, true);

        if (!$valid || count($valid) === 0) {
            return back()->with('error', 'No valid data to import');
        }

        foreach ($valid as $row) {
            Submission::create([
                'form_id' => 1,
                'data' => $row
            ]);
        }

        return redirect('/admin/import')->with('success', 'Imported Successfully');
    }
}
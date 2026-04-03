<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Form;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        // 🔥 FILTER BY FORM
        $query = Submission::query();

        if ($request->form_id) {
            $query->where('form_id', $request->form_id);
        }

        $submissions = $query->latest()->get();

        if ($submissions->isEmpty()) {
            return back()->with('error', 'No data found');
        }

        // 🔥 GET FORM NAME (for filename)
        $formName = 'all_forms';

        if ($request->form_id) {
            $form = Form::find($request->form_id);
            $formName = $form ? str_replace(' ', '_', $form->title) : 'form';
        }

        // 🔥 GET ALL UNIQUE KEYS
        $headers = [];

        foreach ($submissions as $row) {
            $headers = array_unique(array_merge($headers, array_keys($row->data ?? [])));
        }

        return response()->stream(function () use ($submissions, $headers) {

            $file = fopen('php://output', 'w');

            // HEADER
            fputcsv($file, $headers);

            // DATA
            foreach ($submissions as $row) {

                $rowData = [];

                foreach ($headers as $header) {
                    $value = $row->data[$header] ?? '';

                    // handle checkbox arrays
                    if (is_array($value)) {
                        $value = implode(',', $value);
                    }

                    $rowData[] = $value;
                }

                fputcsv($file, $rowData);
            }

            fclose($file);

        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=submissions_{$formName}.csv"
        ]);
    }
}
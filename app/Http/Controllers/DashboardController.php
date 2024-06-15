<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadFile;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string',
            'file_name' => 'required|string',
        ]);

        $filePath = $request->input('file_path');
        $fileName = $request->input('file_name');

        // Store the file information in the database
        $uploadedFile = UploadFile::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        // Import data from the Excel file
        Excel::import(new ExcelImport(Auth::id()), $filePath);

        session()->forget('filePreview');

        return redirect('dashboard')->with('success', 'File uploaded and data imported successfully.');
    }

    public function previewFile(Request $request)
    {
        echo "hello";
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName);

        // Read the file to generate a preview
        $headings = (new HeadingRowImport)->toArray($filePath);
        $rows = Excel::toArray(new \stdClass(), $filePath)[0];
        $headers = array_shift($rows);

        // Store the file path and name in session for final submission
        session([
            'filePreview' => [
                'file_path' => $filePath,
                'file_name' => $fileName,
                'headers' => $headers,
                'rows' => array_slice($rows, 0, 10) // Preview first 10 rows
            ]
        ]);

        return redirect('dashboard');
    }

    public function downloadFile($id)
    {
        // Find the uploaded file by its ID
        $file = UploadFile::findOrFail($id);

        // Get the file path
        $filePath = $file->file_path;

        // Return the file as a response for download
        return response()->file(storage_path('app/' . $filePath), [
            'Content-Disposition' => 'inline; filename="' . $file->file_name . '"',
            'Content-Type' => Storage::mimeType($filePath),
        ]);
    }

    public function cancel() {
        session()->forget('filePreview');
        return redirect('dashboard');
    }

    public function showDashboard()
    {
        // Retrieve only files uploaded by the authenticated user
        $uploadedFiles = UploadFile::where('user_id', Auth::id())->get();
        return view('dashboard', compact('uploadedFiles'));
    }
}

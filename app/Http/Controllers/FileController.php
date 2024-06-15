<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $fileRecord = File::create([
            'user_id' => Auth::id(),
            'filename' => $filename,
        ]);

        return response()->json(['file_id' => $fileRecord->id, 'message' => 'File uploaded successfully']);
    }

    public function getData(File $file)
    {
        // Authorize the user to view the file data
        $this->authorize('view', $file);

        $filePath = public_path('uploads/' . $file->filename);

        // Read the Excel file
        $data = Excel::toArray([], $filePath);

        return response()->json($data);
    }
}


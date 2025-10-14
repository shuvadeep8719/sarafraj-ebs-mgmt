<?php

namespace App\Http\Controllers;

use App\Models\CustomerDocument;
use Illuminate\Support\Facades\Storage;

class CustomerDocumentController extends Controller
{
    /**
     * Remove the specified customer document.
     */
    public function destroy(CustomerDocument $document)
    {
        try {
            // ✅ Delete the physical file from storage if it exists
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // ✅ Delete the record from the database
            $document->delete();

            // ✅ If request came from a standard form
            if (!request()->expectsJson()) {
                return back()->with('success', 'Document deleted successfully.');
            }

            // ✅ If request is via Ajax
            return response()->json(['success' => true, 'message' => 'Document deleted successfully.']);
        } catch (\Exception $e) {
            // Handle errors safely
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete document: ' . $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Failed to delete document: ' . $e->getMessage());
        }
    }
}

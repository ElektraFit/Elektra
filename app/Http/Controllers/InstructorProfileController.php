<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class InstructorProfileController extends Controller
{
    /**
     * Show instructor profile settings
     */
    public function show()
    {
        $instructorId = Session::get('instructor_id');
        if (!$instructorId) {
            return redirect()->route('instructor.login');
        }

        $instructor = Instructor::findOrFail($instructorId);
        return view('instructor.profile', compact('instructor'));
    }

        /**
     * Upload profile photo to Supabase Storage
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $instructorId = Session::get('instructor_id');
        if (!$instructorId) {
            return redirect()->route('instructor.login');
        }

        $instructor = Instructor::findOrFail($instructorId);

        // Delete old photo from Supabase if exists
        if ($instructor->profile_photo) {
            $this->deleteFromSupabase($instructor->profile_photo);
        }

        // Upload to Supabase Storage
        $file = $request->file('profile_photo');
        $filename = 'instructor_' . $instructorId . '_' . time() . '.' . $file->getClientOriginalExtension();
        
        $supabaseUrl = env('SUPABASE_URL');
        $bucket = env('SUPABASE_STORAGE_BUCKET');
        $serviceKey = env('SUPABASE_SERVICE_ROLE_KEY', env('AWS_SECRET_ACCESS_KEY')); // Use service role key
        
        // Upload using Supabase Storage REST API
        $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer ' . $serviceKey,
            ])
            ->withBody(file_get_contents($file->getRealPath()), $file->getMimeType())
            ->post($supabaseUrl . '/storage/v1/object/' . $bucket . '/' . $filename);

        if ($response->successful() || $response->status() == 200) {
            // Update instructor record with filename only
            $instructor->profile_photo = $filename;
            $instructor->save();

            return redirect()->route('instructor.profile')->with('success', 'Profile photo updated successfully!');
        }

        \Log::error('Supabase upload failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return redirect()->route('instructor.profile')->with('error', 'Upload failed: ' . $response->body());
    }

    /**
     * Delete profile photo from Supabase Storage
     */
    public function deletePhoto()
    {
        $instructorId = Session::get('instructor_id');
        if (!$instructorId) {
            return response()->json(['success' => false], 401);
        }

        $instructor = Instructor::findOrFail($instructorId);

        // Delete from Supabase if exists
        if ($instructor->profile_photo) {
            $this->deleteFromSupabase($instructor->profile_photo);
        }

        // Update instructor record
        $instructor->profile_photo = null;
        $instructor->save();

        return response()->json(['success' => true]);
    }

    /**
     * Delete file from Supabase Storage
     */
    private function deleteFromSupabase($filename)
    {
        $supabaseUrl = env('SUPABASE_URL');
        $bucket = env('SUPABASE_STORAGE_BUCKET');
        $serviceKey = env('SUPABASE_SERVICE_ROLE_KEY', env('AWS_SECRET_ACCESS_KEY'));
        
        Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer ' . $serviceKey,
            ])
            ->delete($supabaseUrl . '/storage/v1/object/' . $bucket . '/' . $filename);
    }
}

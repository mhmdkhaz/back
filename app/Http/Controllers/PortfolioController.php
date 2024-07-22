<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\portfolio;

class PortfolioController extends Controller
{
    public function get_all_project(){
        $projects = Portfolio::all();
        return response()->json($projects);
    }
    
    public function add_project(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'explanation' => 'required|string',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
                'list' => 'nullable|json',
            ]);
    
            $images = [];
    
            // Process the images
            if ($request->hasFile('images')) {
                foreach($request->file('images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName(); // Unique name to avoid conflicts
                    $image->move(public_path('images'), $name);  
                    $images[] = $name;  
                }
            }
    
            // Create the new project with the uploaded file paths
            $newProject = Portfolio::create([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'explanation' => $request->explanation,
                'images' => json_encode($images), // Store images as JSON
                'list' => $request->list ? json_decode($request->list) : null,
            ]);
    
            return response()->json($newProject, 201);
    
        } catch (\Exception $e) {
            Log::error('Error creating project: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'There was an error creating the project',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    

    public function deleteProject($id)
    {
        // Find the project by ID
        $delProject = Portfolio::find($id);
    
        // If project not found, return error response
        if (!$delProject) {
            return response()->json([
                'message' => 'Project not found',
                'status' => 404
            ], 404);
        }
    
        // Delete the project
        $delProject->delete();
    
        // Prepare response
        $res = [
            'message' => 'Deleted successfully',
            'status' => 200,
            'data' => $delProject
        ];
    
        // Return response
        return response()->json($res);
    }
}
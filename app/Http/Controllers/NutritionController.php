<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class NutritionController extends Controller
{
    /**
     * Show nutrition tracker page
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get today's meals
        $todayMeals = Meal::where('user_id', $user->id)
            ->whereDate('meal_date', today())
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Calculate today's totals
        $todayTotals = [
            'calories' => $todayMeals->sum('calories'),
            'protein' => $todayMeals->sum('protein'),
            'carbs' => $todayMeals->sum('carbohydrates'),
            'fat' => $todayMeals->sum('fat'),
            'fiber' => $todayMeals->sum('fiber'),
        ];
        
        // Get recent meals (last 7 days)
        $recentMeals = Meal::where('user_id', $user->id)
            ->where('meal_date', '>=', now()->subDays(7))
            ->orderBy('meal_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('nutrition.index', compact('todayMeals', 'todayTotals', 'recentMeals'));
    }

    /**
     * Search food using CalorieNinjas API
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2',
        ]);

        $query = $request->input('query');
        $apiKey = env('CALORIENINJAS_API_KEY');

        // Check if API key is configured
        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'message' => 'CalorieNinjas API key is not configured. Please add CALORIENINJAS_API_KEY to your .env file.',
            ], 500);
        }

        // Log for debugging
        \Log::info('CalorieNinjas API Request', [
            'query' => $query,
            'api_key_present' => !empty($apiKey),
        ]);

        try {
            $response = Http::timeout(10)
                ->withOptions([
                    'verify' => false, // Disable SSL verification
                ])
                ->withHeaders([
                    'X-Api-Key' => $apiKey,
                ])
                ->get('https://api.calorieninjas.com/v1/nutrition', [
                    'query' => $query,
                ]);

            \Log::info('CalorieNinjas API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'items' => $data['items'] ?? [],
                ]);
            }

            // Handle specific status codes
            if ($response->status() == 502) {
                return response()->json([
                    'success' => false,
                    'message' => 'CalorieNinjas API is temporarily unavailable. Please try again later.',
                ], 502);
            }

            return response()->json([
                'success' => false,
                'message' => 'API returned status: ' . $response->status() . '. Please check your API key or try again later.',
                'details' => $response->body(),
            ], 400);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            \Log::error('CalorieNinjas API Connection Error', [
                'message' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to CalorieNinjas API. Please check your internet connection or try again later.',
            ], 500);
        } catch (\Exception $e) {
            \Log::error('CalorieNinjas API Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while searching for food. Please try again.',
            ], 500);
        }
    }

    /**
     * Store a new meal
     */
    public function store(Request $request)
    {
        $request->validate([
            'meal_name' => 'required|string',
            'calories' => 'required|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
            'carbohydrates' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'sugar' => 'nullable|numeric|min:0',
            'sodium' => 'nullable|numeric|min:0',
            'serving_size' => 'required|numeric|min:0',
            'serving_unit' => 'required|string',
            'meal_date' => 'required|date',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
        ]);

        $meal = Meal::create([
            'user_id' => Auth::id(),
            'meal_name' => $request->meal_name,
            'calories' => $request->calories,
            'protein' => $request->protein,
            'carbohydrates' => $request->carbohydrates,
            'fat' => $request->fat,
            'fiber' => $request->fiber,
            'sugar' => $request->sugar,
            'sodium' => $request->sodium,
            'serving_size' => $request->serving_size,
            'serving_unit' => $request->serving_unit,
            'meal_date' => $request->meal_date,
            'meal_type' => $request->meal_type,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Meal logged successfully!',
            'meal' => $meal,
        ]);
    }

    /**
     * Delete a meal
     */
    public function destroy(Meal $meal)
    {
        // Check if user owns this meal
        if ($meal->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $meal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Meal deleted successfully',
        ]);
    }
}

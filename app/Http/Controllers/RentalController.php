<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function rentBike(Request $request, Bike $bike): JsonResponse
    {
        $request->validate([
            'rental_start' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        if (!$bike->isAvailable()) {
            return response()->json(['message' => 'Bike is not available for rent'], 400);
        }

        $rental = Rental::create([
            'user_id' => Auth::id(),
            'bike_id' => $bike->id,
            'rental_start' => $request->rental_start,
            'status' => 'active',
            'notes' => $request->notes
        ]);

        return response()->json(['message' => 'Bike rented successfully', 'rental' => $rental]);
    }

    public function returnBike(Rental $rental): JsonResponse
    {
        if ($rental->status !== 'active') {
            return response()->json(['message' => 'This rental is not active'], 400);
        }

        if ($rental->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $rental->rental_end = now();
        $rental->total_price = $rental->calculateTotalPrice();
        $rental->status = 'completed';
        $rental->save();

        return response()->json([
            'message' => 'Bike returned successfully',
            'rental' => $rental,
            'total_price' => $rental->total_price
        ]);
    }

    public function getUserRentals(): JsonResponse
    {
        $rentals = Rental::with('bike')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['rentals' => $rentals]);
    }

    public function calculatePrice(Rental $rental): JsonResponse
    {
        if ($rental->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $price = $rental->calculateTotalPrice();
        return response()->json(['total_price' => $price]);
    }
}
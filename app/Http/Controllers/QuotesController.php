<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Exception;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function favoritesQuotes($id)
    {
        try {
            $quote = Quote::where('user_id', $id)->get();
            return response()->json($quote, 200);
        } catch (Exception $e) {
            return response()->json($e, 400);
        }
    }

    public function addFavoriteQuote(Request $request)
    {
        try {
            $quote = new Quote;
            $quote->quote = $request->quote;
            $quote->author = $request->author;
            $quote->user_id = $request->user_id;
            $quote->save();
            
            return response()->json(['message' => 'Quote saved!'], 201);
        } catch (Exception $e) {
            return response()->json($e, 400);
        }
    }

    public function deleteFavoriteQuote($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();
        return response()->json('Quote deleted!', 200);
    }
}

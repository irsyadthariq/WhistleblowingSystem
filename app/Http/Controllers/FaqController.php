<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mfaq;

class FaqController extends Controller
{
    public function index()
    {
        try {
            $faqs = Mfaq::all();
            return response()->json(['message' => 'Success', 'data' => $faqs], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string',
            ]);

            $faq = Mfaq::create($validatedData);

            return response()->json(['message' => 'Faq created successfully', 'data' => $faq], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $faq = Mfaq::findOrFail($id);

            $validatedData = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string',
            ]);

            $faq->update($validatedData);

            return response()->json(['message' => 'Faq updated successfully', 'data' => $faq], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $faq = Mfaq::findOrFail($id);
            $faq->delete();

            return response()->json(['message' => 'Faq deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}

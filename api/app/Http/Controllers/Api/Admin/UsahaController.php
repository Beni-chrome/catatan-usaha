<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsahaResource;
use App\Models\Usaha;
use Illuminate\Http\Request;

class UsahaController extends Controller
{
    public function index()
    {
        $usaha = Usaha::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data semua usaha',
            'data' => UsahaResource::collection($usaha),
        ]);
    }

    public function show($id)
    {
        $usaha = Usaha::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail usaha',
            'data' => new UsahaResource($usaha),
        ]);
    }

    public function destroy($id)
    {
        $usaha = Usaha::findOrFail($id);

        if ($usaha->role === 'super_admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akun super admin tidak boleh dihapus',
                'data' => null,
            ], 403);
        }

        $usaha->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usaha berhasil dihapus',
            'data' => null,
        ]);
    }
}

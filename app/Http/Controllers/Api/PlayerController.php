<?php

namespace App\Http\Controllers\Api;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $players = Player::latest()->paginate(500);

        //return collection of posts as a resource
        return new PlayerResource(true, 'List Data Players', $players);
    }

    public function store(Request $request )
    {
        // Define validation rules
    $validator = Validator::make($request->all(), [
        'nickname'  => 'required',
        'username'  => 'required',
        'email'     => 'required|email', // Add email validation rule
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Create player
    $player = Player::create([
        'nickname'  => $request->input('nickname'),
        'username'  => $request->input('username'),
        'email'     => $request->input('email'),
    ]);

    // Return response
    return new PlayerResource(true, 'Data Player Berhasil Ditambahkan!', $player);
    }

    public function show(Player $player)
    {
        //return single post as a resource
        return new PlayerResource(true, 'Data Player Ditemukan!', $player);
    }

    public function update(Request $request, Player $player)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nickname'  => 'required',
            'username'  => 'required',
            'email'     => 'required|email',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);

        } else {

            $player->update([
                 'nickname'  => $request->nickname,
                 'username'  => $request->username,
                 'email'     => $request->email,
            ]);
        }

        //return response
        return new PlayerResource(true, 'Data Player Berhasil Diubah!', $player);
    }

    public function destroy(Player $player)
    {


        // Hapus player
    $player->delete();

    // Periksa apakah metode permintaan adalah DELETE
    if (request()->isMethod('delete')) {
        // Kembalikan respons khusus untuk permintaan DELETE
        return response()->json([
            'success' => true,
            'message' => 'Data Player Berhasil Dihapus!',
        ]);
    }

    // Kembalikan respons dengan kunci 'data' untuk metode permintaan lainnya
    return new PlayerResource(true, 'Data Player Berhasil Dihapus!', null);
    }
}

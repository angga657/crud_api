<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    //
    /**
     * index
     *
     * @return void
     */

     
    public function index()
    {
        //get games
        $games = Game::latest()->paginate(500);

        //return collection of games as a resource
        return new GameResource(true, 'List Data Games', $games);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_player' => 'required',
            'game_name' => 'required',
            'platform' => 'required',
            'game_type' => 'required',         
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create game
        $game = Game::create([
            'id_player' => $request->id_player,
            'game_name' => $request->game_name,
            'platform'  => $request->platform,
            'game_type' => $request->game_type,
        ]);

        //return response
        return new GameResource(true, 'Data Game Berhasil Ditambahkan!', $game);

    }

    public function show(Game $game)
    {
        //return single post as a resource
        return new GameResource(true, 'Data Game Ditemukan!', $game);
    }

    public function update(Request $request, Game $game)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_player'  => 'required',
            'game_name'  => 'required',
            'platform'   => 'required',
            'game_type'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);

        } else {

            $game->update([
                'id_player'  => $request->id_player,
                'game_name'  => $request->game_name,
                'platform'   => $request->platform,
                'game_type'  => $request->game_type,
            ]);
        }

        //return response
        return new GameResource(true, 'Data Game Berhasil Diubah!', $game);
    }

    public function destroy(Game $game)
    {
        // Hapus game
    $game->delete();

    // Periksa apakah metode permintaan adalah DELETE
    if (request()->isMethod('delete')) {
        // Kembalikan respons khusus untuk permintaan DELETE
        return response()->json([
            'success' => true,
            'message' => 'Data Game Berhasil Dihapus!',
        ]);
    }

    // Kembalikan respons dengan kunci 'data' untuk metode permintaan lainnya
    return new GameResource(true, 'Data Game Berhasil Dihapus!', null);
    }
}

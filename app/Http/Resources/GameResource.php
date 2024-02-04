<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    //define properti
    public $status;
    public $message;

    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data = null;

        if ($this->resource) {
            // Periksa apakah $this->resource sudah diset

            // Periksa apakah resource adalah instance dari LengthAwarePaginator
            if ($this->resource instanceof \Illuminate\Pagination\LengthAwarePaginator) {
                // Dapatkan data dari hasil paginasi
                $data = $this->resource->getCollection()->map(function ($item) {
                    return [
                        'id' => $item->id ?? null,
                        'game_name' => $item->game_name ?? null,
                        'platform' => $item->platform ?? null,
                        'game_type' => $item->game_type ?? null,
                        'nickname' => optional($item->player)->nickname ?? null,
                        'username' => optional($item->player)->username ?? null,
                        'email' => optional($item->player)->email ?? null,
                        'created_at' => $item->created_at->toDateTimeString(),
                        'updated_at' => $item->updated_at->toDateTimeString(),
                        
                        // ... (properti lain)
                    ];
                });
            } else {
                // Jika resource bukan paginasi, langsung akses propertinya
                $data = [
                    'id' => $this->resource->id ?? null,
                    'game_name' => $this->resource->game_name ?? null,
                    'platform' => $this->resource->platform ?? null,
                    'game_type' => $this->resource->game_type ?? null,
                    'nickname' => optional($this->resource->player)->nickname ?? null,
                    'username' => optional($this->resource->player)->username ?? null,
                    'email' => optional($this->resource->player)->email ?? null,
                    'created_at' => $this->resource->created_at->toDateTimeString(), 
                    'updated_at' => $this->resource->updated_at->toDateTimeString(), 
                    
                    // ... (properti lain)
                ];
            }
        }

        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => $data,
        ];
    }
}
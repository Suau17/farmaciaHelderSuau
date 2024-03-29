<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $Productes= Producte::all();
         $Productes= Producte::Paginate(10);
        return [
            'id' => $this->id,  // conservem nom columna, conservem valor
            'nom' => $this->nom,  
            'tipus' => $this->tipus,
            'stock' => $this->stock
             //'conservem nom columna, canviem els valors
            //'created_at' => '' ?? $this->created_at->format('d/m/Y'),
            //'updated_at' => $this->updated_at,

        ];
    }
}

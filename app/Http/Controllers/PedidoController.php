<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producte; 
use App\Models\Pedido;
use App\Models\Client;

class PedidoController extends Controller
{
   
    public function index()
    {
      
        $pedidos = Pedido::with('client')->paginate(10);
        
        $response = [
            'success' => true, 
            'message' => "Llista pedidos recuperada",
            'data' => $pedidos, 
        ];
  
        return response()->json($response, 200);  

    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
        ]);
        $Client = Client::where('tarja_sanitaria', $request->tarjeta_sanitaria)->first();

        $pedido = new Pedido;
        $pedido->client_id = $Client->id;
        $pedido->preuTotal = 0;
        $pedido->save();

        $response = [
            'success' => true, 
            'message' => "pedido creado con exito",
            'data' => $pedido, 
        ];
  
        return response()->json($response, 200); 
    }

    public function showPedido($idPedido)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $productesPedido = $pedido->productes()->where('pedido_id', $idPedido)->get();

        $response = [
            'success' => true, 
            'message' => "Llista pedidos recuperada",
            'data' => $productesPedido, 
            'pedido' => $pedido
        ];
  
        return response()->json($response, 200); 
    }

    public function pagar($idPedido)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $pedido->estado = 1;
        $pedido->save();

        $response = [
            'success' => true, 
            'message' => "Pedido pagado y listo",
        ];
  
        return response()->json($response, 200); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());

        $response = [
            'success' => true, 
            'message' => "pedido actualizado",
            'data' => $pedido, 
        ];
  
        return response()->json($response, 200); 
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        if ($pedido->estado == 0) {
            try {
                $pedido->delete();
                $response = [
                    'success' => true, 
                    'message' => "pedido eliminado",
                ];
          
                return response()->json($response, 200); 
            } catch (\Illuminate\Database\QueryException $e) {
                $response = [
                    'success' => true, 
                    'message' => "error al eliminar el pedido",
                ];
          
                return response()->json($response, 400); 
            }
        } else {
            return response()->json(['message' => 'El pedido ya está pagado'], 400);
        }
    }

    public function agregarProducte(Request $request)
    {
        $idPedido = $request->idPedido;
        $idProducte = $request->idProducte;
        $pedido = Pedido::findOrFail($idPedido);
        $producte = Producte::findOrFail($idProducte);

        if ($pedido->estado == 0) {
            $preuProducte = $producte->preu;
            $preuPedido = $pedido->preuTotal;

            $preuTotal = $preuPedido + $preuProducte;

            $pedido->preuTotal = $preuTotal;
            $pedido->save();

            $pedido->productes()->attach($idProducte);

            $response = [
                'success' => true, 
                'message' => "pedido agregado al carrito",
            ];
      
            return response()->json($response, 200); 
        } else {
            return response()->json(['message' => 'El pedido ya está pagado'], 400);
        }
    }
    
    public function deleteProducte( $idPedido, $idProducte) {
        $pedido = Pedido::findOrFail($idPedido);
        $producte = Producte::findOrFail($idProducte);
        if ($pedido->estado == 0) {
            $preuProducte = $producte->preu;
            $preuPedido = $pedido->preuTotal;
            $preuTotal = $preuPedido - $preuProducte;
    
            $pedido->preuTotal = $preuTotal;
            $pedido->save();
    
            $pedido->productes()->detach($idProducte);
            
            $response = [
                'success' => true, 
                'message' => "pedido retirado del carrito",
            ];
      
            return response()->json($response, 200); 
        } else {
            return response()->json([
                'message' => 'El pedido ja està pagat'
            ], 200);
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producte; 
use App\Models\Pedido;

class PedidoController extends Controller
{
   
    public function index($id)
    {
        if (auth()->user()->role == 'admin') {
            $pedidos = Pedido::where('user_id', auth()->user()->id)
                ->where('restaurante_id', $id)
                ->get();
            return response()->json(compact('pedidos'));
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $pedido = new Pedido;
        $pedido->client_id = $request->client_id;
        $pedido->preuTotal = 0;
        $pedido->save();

        return response()->json(['message' => 'Pedido creado correctamente']);
    }

    public function showPedido($id, $idPedido)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $productesPedido = $pedido->productes()->where('pedido_id', $idPedido)->get();

        return response()->json(compact('platosPedido', 'pedido'));
    }

    public function pagar($idPedido)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $pedido->estado = 1;
        $pedido->save();

        return response()->json(['message' => 'Pedido pagado correctamente']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());

        return response()->json(['message' => 'Pedido actualizado correctamente']);
    }

    public function destroy($idRestaurante, $id)
    {
        $pedido = Pedido::findOrFail($id);
        if ($pedido->estado == 0) {
            try {
                $pedido->delete();
                return response()->json(['message' => 'Pedido eliminado correctamente']);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json(['error' => 'Error eliminando el pedido'], 500);
            }
        } else {
            return response()->json(['message' => 'El pedido ya está pagado'], 400);
        }
    }

    public function agregarPlato($idRestaurante, $idPedido, $idProducte)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $producte = Producte::findOrFail($idProducte);

        if ($pedido->estado == 0) {
            $preuProducte = $producte->preu;
            $preuPedido = $pedido->preuTotal;

            $preuTotal = $preuPedido + $preuProducte;

            $pedido->preuTotal = $preuTotal;
            $pedido->save();

            $pedido->productes()->attach($idProducte);

            return response()->json(['message' => 'Producto agregado correctamente']);
        } else {
            return response()->json(['message' => 'El pedido ya está pagado'], 400);
        }
    }
    
    public function deletePlato($idRestaurante,$idPedido, $idProducte){
        
        $pedido = Pedido::findOrFail($idPedido);
        $producte = Producte::findOrFail($idProducte);
        if ($pedido->estado == 0) {

            $preuProducte = $producte->preu;
            $preuPedido = $pedido->preuTotal;

            $preuTotal = $preuPedido - $preuProducte;

            $pedido->preuTotal = $preuTotal;
            $pedido->save();
            
            $pedido->productes()->detach($idProducte);
            return redirect()->route('ClientePedidos.index', $idRestaurante);
        } else {
            return response('El pedido ya esta pagado', 200);
        }
    }
}


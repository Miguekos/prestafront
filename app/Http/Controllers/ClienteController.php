<?php

namespace App\Http\Controllers;

use App\User;
use App\Control;
use App\Cliente;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    static public function hora()
    {
        $now = new DateTime('America/Lima');
        // $hora = $now->format('d-M-Y H:i:s');
        return $now->format('y/m/d H:i:s');
    }

      public function __construct()
      {
          $this->middleware('auth');
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $cliente = Cliente::where('deuda','!=',0.00)->get();
//        $clientesd = Cliente::where('deuda',0.00)->get();
//        $user = Auth::user();
        return view('clientes.index');
//        return json_encode([
//            "cliente" => $cliente,
//            "clientesd" => $clientesd
//        ]);
    }


    public function indexapi()
    {
        $cliente = Cliente::where('deuda','!=',0.00)->get();
        $clientesd = Cliente::where('deuda',0.00)->get();
//        $user = Auth::user();
//        return view('clientes.index',compact('cliente','clientesd','user'));
        return json_encode([
            "cliente" => $cliente,
            "clientesd" => $clientesd
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //   $now = new DateTime('America/Lima');
      // $hora = $now->format('d-M-Y H:i:s');
    //   $hora = $now->format('d/m/Y');
      // $hora = $this->hora();
      return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        // $flight = Cliente::find($control);
        // $flight->deuda = $flight->deuda + $cliente->abono;
        return redirect()->route('cliente.index')->with('success','Se guardo correctammente el cliente');
//        return $cliente;
    }

    public function storeapi(Request $request)
    {
        $cliente = Cliente::create($request->all());
        // $flight = Cliente::find($control);
        // $flight->deuda = $flight->deuda + $cliente->abono;
//        return redirect()->route('cliente.index')->with('success','Se guardo correctammente el cliente');
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($cliente)
    {
      $clientes = Cliente::findOrFail($cliente);
      return view('clientes.show',compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {

      return view('clientes.edit',compact('cliente'));
      // $clientes = Cliente::findOrFail($cliente);
      // return view('clientes.edit',compact('clientes'));
      // return $clientes->nombre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cliente)
    {
      $clientes  = Cliente::findOrFail($cliente);
      $input = $request->all();
      $clientes->fill($input)->save();
      return back()->with('flash','Se actualizo el empleado correctamente');
    }

    public function updateapi(Request $request, $cliente)
    {
      $clientes  = Cliente::findOrFail($cliente);
    //   return $clientes;
      $input = $request->all();
    //   return $input;
      $clientes->fill($input)->save();
    
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $clientes  = Cliente::findOrFail($cliente);
        $cliente->delete();
        return redirect()->route('cliente.index')->with('flash','Se elimino el cliente correctamente..!!');
//        return $clientes;

    }

    public function destroyapi(Cliente $cliente)
    {
        $clientes  = Cliente::findOrFail($cliente);
        $cliente->delete();
//        return redirect()->route('cliente.index')->with('flash','Se elimino el cliente correctamente..!!');
        return $clientes;

    }

    public function limpiarClientes()
    {
      $clientesd = Cliente::where('deuda',0.00)->get();
      foreach ( $clientesd as $clientesds){
        $id = $clientesds->id;
        Cliente::destroy($id);
      }
      return redirect()->route('cliente.index')->with('flash','Se elimino el cliente correctamente..!!');
    }
}

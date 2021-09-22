<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Type_product;

class Type_productController extends Controller
{
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

   $type_products = auth()->user()->type_product()->get();
   // $type_products = Type_product::all();

   // dd($type_products);


        return view('inventory.type_product.index', ['type_products' => $type_products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $type_product = new \App\Models\Type_product([


        ]);

        return view('inventory.type_product.create',compact('type_product'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type_product $type_product)
    {
        if ($request['note'] == null){
            $request['note'] = "...";
         }

        $data = $this->validateRequest();

     
        $type_product = new type_product();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $type_product->storetype_product($data);

        if ($response)

        return redirect()
                        ->route('type_product.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o tipo de atividade');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(type_product $type_product)
    {

        return view('inventory.type_product.show', compact('type_product' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(type_product $type_product) {


        $user = auth()->user();


        return view('inventory.type_product.edit',['type_product' => $type_product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_product $type_product)
    {

       $dataRequest = $request; 

   
    $data['name']           = $dataRequest['name'];
    $data['note']           = $dataRequest['note'];
    $data['in_use']         = $dataRequest['in_use'];
  
    //dd($data);

      $update  = $type_product -> update($data);

      if ($update)

        return redirect()
                        ->route('type_product.edit' ,[ 'type_product' => $type_product->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do tipo de atividade');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(type_product $type_product)
    {
  
        $type_product->delete();
      

        return redirect('/type_product');
    }

    private function validateRequest()
    {

        return request()->validate([

        
            'name'      => 'required',
            'note'      => 'required',
            'in_use'    => 'required',
            
            
       ]);

    }
}

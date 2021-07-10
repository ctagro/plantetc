<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Pesticide;
use App\Models\Active_principle;
use App\Models\Category_pesticide;
use App\User;
use Redirect;

class Active_principleController extends Controller
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

    $active_principles = auth()->user()->active_principle()->get();

    $category_pesticides = Category_pesticide::where('in_use', '=', "S")->get();


    // $active_principles = Active_principle::all();

    // dd($active_principles);   

        return view('pesticide.active_principle.index', compact('active_principles','category_pesticides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $category_pesticides = Category_pesticide::where('in_use', '=', "S")->get();

        $active_principle = new \App\Models\Active_principle([


        ]);

        return view('pesticide.active_principle.create',compact('active_principle','category_pesticides'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Active_principle $active_principle)
    {
        $data = $this->validateRequest();

        $active_principle = new active_principle();

        

        //dd($active_principle);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $active_principle->storeActive_principle($data);



        if ($response)

            return redirect()
                            ->route('active_principle.create')
                            ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar o funcionário');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(active_principle $active_principle)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $active_principles = auth()->user()->active_principle()->get();


        return view('pesticide.active_principle.show', compact('active_principle' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(active_principle $active_principle) {


        $user = auth()->user();

        $category_pesticides = Category_pesticide::where('in_use', '=', "S")->get();


        return view('pesticide.active_principle.edit',compact('active_principle','category_pesticides'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Active_principle $active_principle)
    {

        $dataRequest = $this->validateRequest();


        $data['name']                       = $dataRequest['name'];
        $data['category_pesticide_id']      = $dataRequest['category_pesticide_id'];
        $data['description']                = $dataRequest['description'];
        $data['main_uses']                  = $dataRequest['main_uses'];
        $data['note']                       = $dataRequest['note'];
        $data['in_use']                     = $dataRequest['in_use'];
       

        $update = $active_principle -> update($data);

        if ($update)

        return redirect()
                        ->route('active_principle.edit' ,[ 'active_principle' => $active_principle->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização do cadastro');     

    }

/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(active_principle $active_principle)
    {
        $path = 'active_principles/'.$active_principle['image'];

        if($path != "active_principles/active_principle_avatar.png")

        Storage::delete($path);

        $destroy = $active_principle->delete();

        return redirect('/active_principle');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    private function validateRequest()
    {

        return request()->validate([

            'name'                  => 'required',
            'category_pesticide_id' => 'required',
            'description'           => 'required',
            'main_uses'             => 'required',
            'note'                  => 'required',
            'in_use'                => 'required',
    
       ]);


    }
}

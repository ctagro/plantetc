<?php

namespace App\Http\Controllers\Pesticide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Category_pesticide;
use App\Models\Sale;
use Carbon\Carbon;
use Redirect;
//teste

class Category_pesticideController extends Controller
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

   // $category_pesticides = auth()->user()->category_pesticide()->get();



    $category_pesticides = Category_pesticide::all();

    // dd($category_pesticides);   

        return view('pesticide.category_pesticide.index', ['category_pesticides' => $category_pesticides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $category_pesticide = new \App\Models\Category_pesticide([


        ]);

        return view('pesticide.category_pesticide.create',compact('category_pesticide'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category_pesticide $category_pesticide)
    {

        $data = $this->validateRequest();


        $category_pesticide = new category_pesticide();



        $response = $category_pesticide->storeCategory_pesticide($data);



        if ($response)

            return redirect()
                            ->route('category_pesticide.create')
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
    public function show(Category_pesticide $category_pesticide)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $category_pesticides = auth()->user()->category_pesticide()->get();


        return view('pesticide.category_pesticide.show', compact('category_pesticide' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category_pesticide $category_pesticide) {


        $user = auth()->user();


        return view('pesticide.category_pesticide.edit',['category_pesticide' => $category_pesticide]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category_pesticide $category_pesticide)
    {


        $dataRequest = $this->validateRequest();
        

        $data['name']           = $dataRequest['name'];
        $data['description']    = $dataRequest['description'];
        $data['in_use']         = $dataRequest['in_use'];

       

        $update = $category_pesticide -> update($data);

        if ($update)

        return redirect()
                        ->route('category_pesticide.edit' ,[ 'category_pesticide' => $category_pesticide->id ])
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
    public function destroy(Category_pesticide $category_pesticide)
    {
        $path = 'category_pesticides/'.$category_pesticide['image'];

        if($path != "category_pesticides/category_pesticide_avatar.png")

        Storage::delete($path);

        $destroy = $category_pesticide->delete();

        return redirect('/category_pesticide');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'          => 'required',
            'description'   => 'required',
            'in_use'        => 'required',
        
       ]);


    }
}

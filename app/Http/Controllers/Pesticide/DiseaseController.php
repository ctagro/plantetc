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
use App\Models\Disease;
use App\User;
use Redirect;

class DiseaseController extends Controller
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


    $category_pesticide = Category_pesticide::where('in_use', '=', "S")->get();
   

    // dd($active_principles);

    $diseases = auth()->user()->disease()->get();

 // dd($diseases);


    // $diseases = disease::all();

    // dd($diseases);   

        return view('pesticide.disease.index', compact('diseases','category_pesticide'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $active_principles = Active_principle::where('in_use', '=', "S")->get();


 //       $disease = new \App\Models\disease([
 //       ]);

       $disease = new disease();

     //  dd($disease);

        return view('pesticide.disease.create',compact('disease','active_principles'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, disease $disease)
    {
      //dd($request);

      if ($request['note'] == null){
        $request['note'] = "...";
        }

        $data = $this->validateRequest();

        //dd($data, $data['name']);
    
    // -------------   Upload da image -------------------
        if ($request->file('image') === null){
            $data['image'] = 'disease_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
              
            //cria um nome para a imagem concatenado id e nome do user
                $name = $data['name_vulgar']."_image";   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
                   
                $upload = $request->file('image')->storeAs('diseases', $nameFile);
            }
        }


        $disease = new disease();

        // relacionando pesticidas com  principios ativos

        $disease_id = 

        

        //dd($disease);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view diseaseiro/despesa

        $response = $disease->storedisease($data);



        if ($response)

            return redirect()
                            ->route('disease.create')
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
    public function show(disease $disease)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $diseases = auth()->user()->disease()->get();


        return view('pesticide.disease.show', compact('disease' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(disease $disease) {


        $user = auth()->user();


        return view('pesticide.disease.edit',['disease' => $disease]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, disease $disease)
    {
        

     $dataRequest = $this->validateRequest();


     //----------------Upload image---------------

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $disease['image'];
              
            if  ($nameFile == "disease_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = $dataRequest['name_vulgar']."_image";   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $disease['image'] = $nameFile;
                //dd($nameFile);
            }
        
            //dd($nameFile);

            $upload = $request->file('image')->storeAs('diseases', $nameFile);

            if (!$upload)
            return redirect() 
                        ->back()
                        ->with('error', 'Falha ao fazer o upload');
        }

   

       //dd($dataRequest);

       $data['name_vulgar']             = $dataRequest['name_vulgar'];
       $data['name_scientific']         = $dataRequest['name_scientific'];
       $data['description' ]            = $dataRequest['description'];
       $data['symptoms']                = $dataRequest['symptoms'];
       $data['indicated_pesticide']     = $dataRequest['indicated_pesticide'];
       $data['control']                 = $dataRequest['control'];
       $data['image']                   = $dataRequest['image'];
       $data['note']                    = $dataRequest['note'];
       
       
        $update = $disease -> update($data);

        if ($update);

        return redirect()
                        ->route('disease.edit' ,[ 'disease' => $disease->id ])
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
    public function destroy(disease $disease)
    {
        $path = 'diseases/'.$disease['image'];

        if($path != "diseases/disease_avatar.png")

        Storage::delete($path);

        $destroy = $disease->delete();

        return redirect('/disease');
    }

    private function validateRequest()
    {

        return request()->validate([

            
            'name_vulgar'           => 'required',
            'name_scientific'       => 'required',
            'description'           => 'required',
            'symptoms'              => 'required',
            'indicated_pesticide'   => 'required',
            'control'               => 'required',
         //   'image'                 => 'required',
            'note'                  => 'required',

    
       ]);


    }
}

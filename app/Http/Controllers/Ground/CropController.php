<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Activity;
use App\User;
use App\Models\Crop;
use Redirect;

class CropController extends Controller
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

    $crops = auth()->user()->crop()->get();


    // $crops = Crop::all();

    // dd($crops);   

        return view('ground.crop.index', ['crops' => $crops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $crop = new \App\Models\Crop([


        ]);

        return view('ground.crop.create',compact('crop'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Crop $crop)
    {
        if ($request['note'] == null){
            $request['note'] = "...";
         }


        $data = $this->validateRequest();

        if ($request->file('image') === null){
            $data['image'] = 'crop_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'crop_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('crops', $nameFile);
            }
        }


        $crop = new crop();

        

        //dd($crop);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view groundiro/despesa

        $response = $crop->storeCrop($data);



        if ($response)

            return redirect()
                            ->route('crop.create')
                            ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar a cultura');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Crop $crop)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $crops = auth()->user()->crop()->get();


        return view('ground.crop.show', compact('crop' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Crop $crop) {


        $user = auth()->user();


        return view('ground.crop.edit',['crop' => $crop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crop $crop) 
    {

        if ($request['note'] == null){
            $request['note'] = "...";
         }

        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $crop['image'];
              
            if  ($nameFile == "crop_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'crop_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $crop['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('crops', $nameFile);
        }

        
        $data['crop_name']      = $dataRequest['crop_name'];
        $data['name']           = $dataRequest['name'];
        $data['description']    = $dataRequest['description'];
        $data['packing']        = $dataRequest['packing'];
        $data['unity']          = $dataRequest['unity'];
        $data['in_use']         = $dataRequest['in_use'];
       

        $update = $crop -> update($data);

        if ($update)

        return redirect()
                        ->route('crop.edit' ,[ 'crop' => $crop->id ])
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
    public function destroy(Crop $crop)
    {
        $path = 'crops/'.$crop['image'];

        if($path != "crops/crop_avatar.png")

        Storage::delete($path);

        $destroy = $crop->delete();

        return redirect('/crop');
    }

    private function validateRequest()
    {

        return request()->validate([

            'crop_name'     => 'required',
            'name'          => 'required',
            'description'   => 'required',
            'packing'       => 'required',
            'unity'         => 'required',
            'in_use'        => 'required',
            'note'          => 'required',
  
    
       ]);


    }
}

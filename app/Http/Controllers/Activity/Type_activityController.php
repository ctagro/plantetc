<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Type_activity;

class Type_activityController extends Controller
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

    $type_activities = auth()->user()->type_activity()->get();


        return view('activity.type_activity.index', ['type_activities' => $type_activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();
       

        $type_activity = new \App\Models\Type_activity([


        ]);

        return view('activity.type_activity.create',compact('type_activity'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type_activity $type_activity)
    {
       
        $data = $this->validateRequest();
 
        if ($request->file('image') === null){
            $data['image'] = 'type_activity_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'type_activity_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               //dd($data['image']);

               $upload = $request->file('image')->storeAs('type_activities', $nameFile);
            }

        }
     
        $type_activity = new type_activity();

        // Chamando a objeto a funcao do model  e passando o array 
        // capiturado no formulario da view 

        $response = $type_activity->storetype_activity($data);

        if ($response)

        return redirect()
                        ->route('type_activity.create')
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
    public function show(type_activity $type_activity)
    {

        return view('activity.type_activity.show', compact('type_activity' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(type_activity $type_activity) {


        $user = auth()->user();


        return view('activity.type_activity.edit',['type_activity' => $type_activity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_activity $type_activity)
    {

       $dataRequest = $request; 

    if ($request->hasFile('image') && $request->file('image')->isValid()) {

        $nameFile = $type_activity['image'];
          
        if  ($nameFile == "type_activity_avatar.png"){

            //cria um nome para a imagem concatenado id e nome do user
            $name = 'type_activity_'.time();   // tirar os espacos com o kebab_case
            $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
            $nameFile = "{$name}.{$extenstion}"; // concatenando
            $type_activity['image'] = $nameFile;
        }
    
        $upload = $request->file('image')->storeAs('type_activities', $nameFile);
    }

    $data['description'] = $dataRequest['description'];

  
    $data['note'] = $dataRequest['note'];
    $data['image'] = $type_activity['image'];
  

      $update  = $type_activity -> update($data);

      if ($update)

        return redirect()
                        ->route('type_activity.edit' ,[ 'type_activity' => $type_activity->id ])
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
    public function destroy(type_activity $type_activity)
    {
         $path = 'type_activities/'.$type_activity['image'];

        if($path != "type_activities/type_activity_avatar.png")
            Storage::delete($path);

        $type_activity->delete();
      

        return redirect('/type_activity');
    }

    private function validateRequest()
    {

        return request()->validate([

        
            'description' => 'required',
            'note' => 'required',
            
            
       ]);


    }
}

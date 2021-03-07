<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Activity;
use App\User;
use App\Models\Worker;
use Redirect;

class WorkerController extends Controller
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

    $workers = auth()->user()->worker()->get();


    // $workers = Worker::all();

    //dd($workers);   

        return view('activity.worker.index', ['workers' => $workers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $user = auth()->user();

        $worker = new \App\Models\Worker([


        ]);


        return view('activity.worker.create',compact('worker'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Worker $worker)
    {
        $data = $this->validateRequest();

        if ($request->file('image') === null){
            $data['image'] = 'worker_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'worker_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('workers', $nameFile);
            }
        }


        $worker = new worker();

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $worker->storeWorker($data);



        if ($response)

            return redirect()
                            ->route('worker.create')
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
    public function show(worker $worker)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $workers = auth()->user()->worker()->get();


        return view('activity.worker.show', compact('worker' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(worker $worker) {


        $user = auth()->user();


        return view('activity.worker.edit',['worker' => $worker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, worker $worker)
    {
        
        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $worker['image'];
              
            if  ($nameFile == "worker_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'worker_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $worker['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('workers', $nameFile);
        }

        if ($dataRequest['date'] == null){
            $dataP = explode('/',$worker->date);
            $data['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }
         else {           
            $data['date'] = $dataRequest['date'];
         }

        $data['name'] = $dataRequest['name'];
        $data['date'] = $dataRequest['date'];
        $data['salary'] = $dataRequest['salary'];
       

        $update = $worker -> update($data);

        if ($update)

        return redirect()
                        ->route('worker.edit' ,[ 'worker' => $worker->id ])
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
    public function destroy(worker $worker)
    {
        $path = 'workers/'.$worker['image'];

        if($path != "workers/worker_avatar.png")

        Storage::delete($path);

        $destroy = $worker->delete();

        return redirect('/worker');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'=> 'required',
            'date'=> 'required',
            'salary' => 'required',
    
       ]);


    }
}

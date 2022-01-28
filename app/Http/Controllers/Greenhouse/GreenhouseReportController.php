<?php

namespace App\Http\Controllers\Greenhouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Activity;
use App\User;
use App\Models\Greenhouse_report;
use App\Models\Worker;
use App\Models\Ground;
use Redirect;

class GreenhouseReportController extends Controller
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

        $user = auth()->user();

      //  dd($user);



  // $greenhouse_reports = auth()->user()->greenhouse_report()->get();

     

    $greenhouse_reports = Greenhouse_report::all();
 

        return view('greenhouse.greenhouse_report.index', ['greenhouse_reports' => $greenhouse_reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $grounds = Ground::where('in_use', '=', "S")->orderby('name','asc')->get();

     //   dd($workers,$grounds,$user);


        $greenhouse_report = new \App\Models\Greenhouse_report([


        ]);

    // dd($greenhouse_report);   

        return view('greenhouse.greenhouse_report.create',compact('greenhouse_report','workers','grounds'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Greenhouse_report $greenhouse_report)
    {
        $data = $this->validateRequest();

        if ($request->file('image') === null){
            $data['image'] = 'greenhouse_report_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'greenhouse_report_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('greenhouse_reports', $nameFile);
            }
        }


        $greenhouse_report = new Greenhouse_report();

        

    //  dd($greenhouse_report,$data);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $greenhouse_report->storeGreenhouse_report($data);



        if ($response)

            return redirect()
                            ->route('greenhouse_report.create')
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
    public function show(greenhouse_report $greenhouse_report)
    {

       // dd($greenhouse_report);

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $greenhouse_reports = Greenhouse_report::get();

      $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

      $grounds = Ground::where('in_use', '=', "S")->orderby('name','asc')->get();


        return view('greenhouse.greenhouse_report.show', compact('greenhouse_report','workers','grounds' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(greenhouse_report $greenhouse_report) {


        $user = auth()->user();
        $workers = Worker::where('in_use', '=', "S")->orderby('name','asc')->get();

        $grounds = Ground::where('in_use', '=', "S")->orderby('name','asc')->get();

       // dd($grounds,$greenhouse_report);
      //  return view('greenhouse.greenhouse_report.edit', ['greenhouse_report' => $greenhouse_report] , ['workers'=> $workers] , ['grounds'=> $grounds]);

      return view('greenhouse.greenhouse_report.edit', compact('greenhouse_report', 'workers', 'grounds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Greenhouse_report $greenhouse_report)
    {

        

        if ($request['date'] == null){
            $dataP = explode('/',$greenhouse_report->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        }

        

        $dataRequest = $this->validateRequest();

    
       

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $greenhouse_report['image'];
              
            if  ($nameFile == "greenhouse_report_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'greenhouse_report_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $greenhouse_report['image'] = $nameFile;
    
            }
    

            $upload = $request->file('image')->storeAs('greenhouse_reports', $nameFile);
        }


        $data['date'] = $dataRequest['date'];
        $data['worker_id'] = $dataRequest['worker_id'];
        $data['ground_id'] = $dataRequest['ground_id'];
        $data['note'] = $dataRequest['note'];
       

        $update = $greenhouse_report -> update($data);

        if ($update)

        return redirect()
                        ->route('greenhouse_report.edit' ,[ 'greenhouse_report' => $greenhouse_report->id ])
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
    public function destroy(greenhouse_report $greenhouse_report)
    {
       // dd('delete');
        
        $path = 'greenhouse_reports/'.$greenhouse_report['image'];

        if($path != "greenhouse_reports/greenhouse_report_avatar.png")

        Storage::delete($path);

        $destroy = $greenhouse_report->delete();

        return redirect('/greenhouse_report');
    }

    private function validateRequest()
    {

        return request()->validate([

            'user_id'      => 'required',
            'date'      => 'required',
            'worker_id' => 'required',
            'ground_id' => 'required',
            'note'      => 'required',
    
       ]);


    }
}

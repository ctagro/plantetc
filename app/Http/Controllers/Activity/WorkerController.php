<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\User;
use App\Models\worker;
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

    // dd($workers);   

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
        $data = $request->all();

       // dd($data, $worker);

      $data['user_id'] = auth()->user()->id;

    

      /*    if($data['nikename'] === null)
                $data['nikename'] = "";

        if($data['hourly_wage'] === null)
                $data['hourly_wage'] = 0;

        $string = 'true';
        $data['active'] = settype($string, 'boolean');
*/
        
        $worker = new worker();

        

        //dd($worker);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $worker->storeWorker($data);



        if ($response['sucess'])

            return redirect()
                        ->route('worker.index')
                        ->with('sucess', $response['mensage']);
                    

        return redirect()
                    ->back()
                    ->with('error', $response['mensage']);

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

        $data['name'] = $dataRequest['name'];
        $data['admission'] = $dataRequest['admission'];
        $data['salary'] = $dataRequest['salary'];
       

        $worker -> update($data);

        return redirect('/worker');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(worker $worker)
    {
        $worker->delete();

        return redirect('/worker');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'=> 'required',
            'admission'=> 'required',
            'salary' => 'required',
    
       ]);


    }
}

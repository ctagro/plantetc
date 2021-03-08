<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Models\Activity;
use App\Models\Type_activity;
use App\Models\Worker;
use App\Models\Ground;
use App\Models\Product;
use DateTime;
use Redirect;



class ActivityController extends Controller
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
   
    $activitys = auth()->user()->activity()->get();

        return view('activity.activity.index',compact('activitys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        $user = auth()->user();

        $activitys = auth()->user()->activity()->get();

        $type_activitys = auth()->user()->type_activity()->get();

        $workers = auth()->user()->worker()->get();

        $grounds = auth()->user()->ground()->get();

        $products = auth()->user()->product()->get();

        

        $activity = new \App\Models\Activity([

        ]);

   
        return view('activity.activity.create',compact('activity','activitys','type_activitys','workers','grounds','products'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['note'] == null){
            $request['note'] = "...";
         }

       $data = $this->validateRequest();


        $activity = new activity();

       
        $response = $activity->storeActivity($data);



        if ($response)

        return redirect()
                        ->route('activity.create')
                        ->with('sucess', 'Cadastro realizado com sucesso');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha ao cadastrar da atividade');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $type_activities = auth()->user()->type_activity()->get();
      


        return view('activity.activity.show', compact('activity' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity) {

        $type_activitys = auth()->user()->type_activity()->get();

        $type_activitys = auth()->user()->type_activity()->get();

        $workers = auth()->user()->worker()->get();

        $grounds = auth()->user()->ground()->get();

        $products = auth()->user()->product()->get();

        $user = auth()->user();


        return view('activity.activity.edit',compact('activity','type_activitys','workers','grounds','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {

        if ($request['date'] == null){
            $dataP = explode('/',$activity->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

   
        

        $dataRequest = $this->validateRequest();



       
        $data['date']                  = $dataRequest['date'];
        $data['type_activity_id']      = $dataRequest['type_activity_id'];
        $data['ground_id']             = $dataRequest['ground_id'];
        $data['product_id']             = $dataRequest['product_id'];
        $data['worker_id']             = $dataRequest['worker_id'];
        $data['start_time']            = $dataRequest['start_time'];
        $data['final_time']            = $dataRequest['final_time'];
        $data['worked_hours']          = $dataRequest['worked_hours'];
       

       $update = $activity -> update($data);

       if ($update)

        return redirect()
                        ->route('activity.edit' ,[ 'activity' => $activity->id ])
                        ->with('sucess', 'Sucesso ao atualizar');
                    

        return redirect()
                    ->back()
                    ->with('error',  'Falha na atualização da atividade');     

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect('activity');
    }

    private function validateRequest()
    {

        return request()->validate([
             
            'date'                   =>   'required',
            'type_activity_id'       =>   'required',
            'worker_id'              =>   'required',  
            'ground_id'              =>   'required',      
            'product_id'             =>   'required',                   
            'start_time'             =>   'required',       
            'final_time'             =>   'required',         
            'worked_hours'           =>   'required',         
            'note'                   =>   'required',    
    
       ]);


    }
}

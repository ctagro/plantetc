<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Type_activity;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
        //dd('index');
   
    $activitiess = auth()->user()->activity()->get();

    $type_activitiess = auth()->user()->type_activity()->get();

    //.$type_activities = Type_activity::all();

      //dd($type_activitiess);   

        return view('activity.activity.index',compact('activitiess','type_activitiess'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $type_activitiess = auth()->user()->type_activity()->get();

        //dd($type_activities);

        $activity = new \App\Models\Activity([

        


        ]);

        return view('activity.activity.create',compact('activity','type_activitiess'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        dd($data);

        $data['user_id'] = auth()->user()->id;

        if($data['note'] === null)
                $data['note'] = "";

        $string = 'true';
        $data['active'] = settype($string, 'boolean');


        
       // $data('worked_hours') = $data('final_time') - $data('start_time');

      // $data['worked_hours'] = $data['final_time'] - ($data['start_time']);

      // dd($data, $data['worked_hours']);
       // $data = $this->validateRequest();

        $activity = new activity();

        //dd($activity,$data);
        //Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa
        
        $response = $activity->storeActivity($data);

        //dd($response);

        if ($response['sucess'])

            return redirect()
                        ->route('activity.index')
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

        $type_activitiess = auth()->user()->type_activity()->get();

        $user = auth()->user();


        return view('activity.activity.edit',compact('activity','type_activitiess'));
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

        $dataRequest = $request; 

        if ($dataRequest['date'] == null){
            $dataP = explode('/',$activity->date);
            $data['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }
         else {           
            $data['date'] = $dataRequest['date'];
         }

         if($dataRequest['note'] === null)
                $data['note'] = "";

        $string = 'true';
        $dataRequest['active'] = settype($string, 'boolean');

        $data['type_activities_id']    = $dataRequest['type_activities_id'];
        $data['crop']                  = $dataRequest['crop'];
        $data['product']               = $dataRequest['product'];
        $data['worker']                = $dataRequest['worker'];
        $data['start_time']            = $dataRequest['start_time'];
        $data['final_time']            = $dataRequest['final_time'];
        $data['worked_hours']          = $dataRequest['worked_hours'];
        

       // dd($data);

        $activity -> update($data);

        return redirect('/activity');

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


            'user_id'                =>   'required', 
            'type_activities_id'     =>   'required',        
            'date'                   =>   'required',
            'crop'                   =>   'required',      
            'product'                =>   'required',      
            'worker'                 =>   'required',      
            'start_time'             =>   'required',       
            'final_time'             =>   'required',         
            'worked_hours'           =>   'required',         
            'active'                 =>   'required',        
            'note'                   =>   'required',    
    
       ]);


    }
}

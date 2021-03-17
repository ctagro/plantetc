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
Use App\Models\Type_account;
use App\Models\Worker;
use App\Models\Ground;
use App\Models\Product;
use App\Models\Account;
use App\Models\Accounting;

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

        $type_accounts= type_account::where('id', '<=', 2)->get();

        $workers = auth()->user()->worker()->get();

        $grounds = auth()->user()->ground()->get();

        $products = auth()->user()->product()->get();

        $accounts = auth()->user()->account()->get();

        $accountings = auth()->user()->accounting()->get();

        $account = new \App\Models\Account([

            ]);


        $activity = new \App\Models\Activity([

        ]);

   
        return view('activity.activity.create',compact('activity','activitys','account','type_activitys','type_accounts','workers','grounds','accountings','products'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $data = $request;
       
      //dd($data);

        if ($request['note'] == null){
            $request['note'] = "...";
         }
        
        $data = $this->validateRequest();

      //dd($data);

        $dataAccount['date' ] = $request['date'];
        $date['note'] = $request['note'];
     

        // captura json do worker selecionado
        $worker = ($data['worker']);
        // tranforma o worker em array
        $worker = json_decode($worker);
        // seleciona o salary_hour
        $dataSalary_hour = $worker->salary_hour;
        $data['worker_id'] = $worker->id;

        // captura json do worker selecionado
        $type_activity = ($data['type_activity']);
        // tranforma o type_activity em array
        $type_activity = json_decode($type_activity);
        // seleciona o salary_hour
        $type_activity_description = $type_activity->description;

       // dd($type_activity_description);

       $dataAccount['date' ] = $request['date'];

      // dd($dataAccount['date' ]);
    
       
     //  $data = $this->validateRequest();

      // dd($data['worked_hours'],floatval($dataSalary[1]));

      //  $an = $data['worked_hours'] * floatval($dataSalary[1]);

       // dd($an);

    //.  dd($data);
   
   //   $dataAccount['user_id' ] = $data['user_id'];
      $dataAccount['date' ] = $data['date'];
      $dataAccount['description' ] = $type_activity_description;
      $dataAccount['type_account_id'] = $data['type_account_id'];
      $dataAccount['accounting_id'] = $data['accounting_id'];
      $dataAccount['ground_id'] = $data['ground_id'];
      $dataAccount['amount'] = $data['worked_hours'] * floatval($dataSalary_hour);
      $dataAccount['activity'] = "S";
      $dataAccount['note' ] = $data['note'];

  //  dd($dataAccount);

      $account = new account();
    
      $account->storeAccount($dataAccount);

      /// ==> veja se da para incluir um response para garantir
      ///     a integridade dos dados

      $id = DB::getPdo()->lastInsertId();

 //   dd($id);

         $data['account_id'] = $id;
         $data['type_activity_id'] = $type_activity->id;

      //dd($data);
      ////// parei aqui /////////////

      /// criar e carregar o registro de atividade usar
      // o $id para o account_id criandp o relacionamento

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

        $type_accounts = Type_account::all();

        $workers = auth()->user()->worker()->get();

        $grounds = auth()->user()->ground()->get();

        $products = auth()->user()->product()->get();

        $account = account::where('id', '=', $activity->account_id)->get();

        $accountings = auth()->user()->accounting()->get();

        $user = auth()->user();

        return view('activity.activity.edit',compact('activity','account','accountings','type_activitys','type_accounts','workers','grounds','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity, Account $account)
    {

        dd($activity->account->amount);

        if ($request['date'] == null){
            $dataP = explode('/',$activity->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
         }

        $dataRequest = $this->validateRequest();

        $dataAccount['date' ] = $request['date'];
        $date['note'] = $request['note'];
     

        // captura json do worker selecionado
        $worker = ($dataRequest['worker']);
        // tranforma o worker em array
        $worker = json_decode($worker);
        // seleciona o salary_hour
        $dataSalary_hour = $worker->salary_hour;
        $dataRequest['worker_id'] = $worker->id;
     //   dd($dataSalary_hour);



        // captura json do worker selecionado
        $type_activity = ($dataRequest['type_activity']);
        // tranforma o type_activity em array
        $type_activity = json_decode($type_activity);
        // seleciona o salary_hour
        $type_activity_description = $type_activity->description;
        $dataRequest['type_activity_id'] = $type_activity->id;

       // dd($type_activity_description);

       $dataAccount['date' ] = $request['date'];

      // dd($dataAccount['date' ]);
       
        if ($request['note'] == null){
            $request['note'] = "...";
         }

         $account = account::where('id', '=', $activity->account_id)->get();

        $dataActivity['date']                    = $dataRequest['date'];
        $dataActivity['type_activity_id']      = $dataRequest['type_activity_id'];
        $dataActivity['ground_id']             = $dataRequest['ground_id'];
        $dataActivity['product_id']             = $dataRequest['product_id'];
        $dataActivity['worker_id']             = $dataRequest['worker_id'];
        $dataActivity['start_time']            = $dataRequest['start_time'];
        $dataActivity['final_time']            = $dataRequest['final_time'];
        $dataActivity['worked_hours']          = $dataRequest['worked_hours'];
        $dataActivity['note']                   = $dataRequest['note'];
       

       $updateActivity = $activity -> update($dataActivity);


        $dataAccount['date' ] = $dataRequest['date'];
        $dataAccount['description' ] = $type_activity_description;
        $dataAccount['type_account_id'] = $dataRequest['type_account_id'];
        $dataAccount['accounting_id'] = $dataRequest['accounting_id'];
        $dataAccount['ground_id'] = $dataRequest['ground_id'];
        $dataAccount['amount'] = $dataRequest['worked_hours'] * floatval($dataSalary_hour);
        $dataAccount['note' ] = $dataRequest['note'];


        $updateAccount = $activity->account ->update($dataAccount);


       $updateActivity = $activity -> update($dataActivity);

       if ($updateActivity)

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
    public function destroy(Activity $activity, Account $account)
    {
        $activity->delete();
        $activity->account->delete();

        return redirect('activity');
    }

    private function validateRequest()
    {

        return request()->validate([
             
            'date'                  =>   'required',
            'type_activity'         =>   'required',
            'worker'                =>   'required',  
            'ground_id'             =>   'required',      
            'product_id'            =>   'required',
            'type_account_id'       =>   'required',
            'accounting_id'         =>   'required',    
            'start_time'            =>   'required',       
            'final_time'            =>   'required',         
            'worked_hours'          =>   'required',         
            'note'                  =>   'required',

    
       ]);


    }
}

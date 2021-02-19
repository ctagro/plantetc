<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    // dd($type_activities);

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
    public function storetype_activity(Request $request)
    {
        // instaciando $despesa com objeto do Model Despesa

        $data = $this->validateRequest();

       // dd($data);
        
        $type_activity = new type_activity();

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view financeiro/despesa

        $response = $type_activity->storetype_activity($request->all());



        if ($response['sucess'])

            return redirect()
                        ->route('type_activity.index')
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
    public function show(type_activity $type_activity)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();
    

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
    public function update(type_activity $type_activity)
    {

        $data = $this->validateRequest();

        $type_activity -> update($data);

        return redirect('/type_activity');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(type_activity $type_activity)
    {


        $type_activity->delete();

        return redirect('/type_activity');
    }

    private function validateRequest()
    {

        return request()->validate([

            'code'=> 'required',
            'description' => 'required',
            'in_uso'=> 'required',
            'note' => 'required',
            
       ]);


    }
}

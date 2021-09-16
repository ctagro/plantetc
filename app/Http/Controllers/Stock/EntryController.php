<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Type_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use Cookie;
use App\Models\Entry;
use Carbon\Carbon;
use Redirect;

class EntryController extends Controller
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
   
   $entrys = Entry::all();

    $type_products= Type_product::all();



  // dd($entrys,$type_products);



    $response = $entrys->first(); 
    $last = $entrys->last();

    $nr = $last['id'];

  

     if($nr>5):
        $nr = $nr-5;
        $entrys = Entry::where('id','>', $nr)->get();
     else:  
        $entrys = Entry::all();
 
     endif;
    

    if ($response === null) {

        
        $entry = new entry();

   

        return view('stock.entry.index',compact('entrys','type_products','entry'));
    } 
    
        return view('stock.entry.index',compact('entrys','type_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $entrys = auth()->user()->entry()->get();

        $type_products= Type_product::all();
  
        $entry = new \App\Models\Entry([

        ]);

        return view('stock.entry.create',compact('entrys','type_products'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     **/
    public function store(Request $request)
    {

        if ($request['note'] == null){
            $request['note'] = "...";
         }
         
        $data = $this->validateRequest();
        
        $entry = new entry();

        $response = $entry->storeEntry($data);


        if ($response['sucess'])

            return redirect()
                        ->route('entry.index')
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
    public function show(Entry $entry)
    {

        $type_products= type_product::all();

        return view('stock.entry.show', compact('entry','type_products' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry) {


        $user = auth()->user();

        $type_products= type_product::all();

        return view('stock.entry.edit',compact('entry','type_products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {  

        if ($request['date'] == null){
            $dataP = explode('/',$entry->date);
            $request['date'] = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        }

        if ($request['note'] == null){
            $request['note'] = "...";
         }

         

                       
        $dataRequest = $this->validateRequest();

    

        $data['date']                 = $dataRequest['date'];
        $data['type_product_id']      = $dataRequest['type_product_id'];
        $data['product_id']           = $dataRequest['product_id'];
        $data['quantity']             = $dataRequest['quantity'];
        $data['price_unit']           = $dataRequest['price_unit'];
        $data['amount']               = $dataRequest['amount'];
        $data['note']                 = $dataRequest['note'];
    

       //dd($data);

        $entry -> update($data);



        return redirect('/entry');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {

        //dd($entry);       
        $entry->delete();

        return redirect('/entry');
    }

    private function validateRequest()
    {

        return request()->validate([
            
            'date'                  => 'required' ,
            'type_product_id'       => 'required' ,
            'product_id'            => 'required' ,
            'quantity'              => 'required' ,
            'price_unit'            => 'required' ,
            'amount'                => 'required' ,
            'note'                  => 'required' ,
    
       ]);


    }
}

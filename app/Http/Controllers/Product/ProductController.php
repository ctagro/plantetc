<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Activity;
use App\User;
use App\Models\Product;
use Redirect;


class ProductController extends Controller
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

    $products = auth()->user()->product()->get();


    // $products = Product::all();

    // dd($products);   

        return view('product.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user = auth()->user();

        $product = new \App\Models\Product([


        ]);

        return view('product.product.create',compact('product'));
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $data = $this->validateRequest();

        if ($request->file('image') === null){
            $data['image'] = 'product_avatar.png';
            }
        else{
            if ($request->file('image')->isValid() && $request->file('image')->isValid()) {
          
            //cria um nome para a imagem concatenado id e nome do user
                $name = 'product_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $data['image'] = $nameFile;
               
               $upload = $request->file('image')->storeAs('products', $nameFile);
            }
        }


        $product = new product();

        

        //dd($product);

       

        // Chamando a objeto a funcao do model despesa e passando o array 
        // capiturado no formulario da view productiro/despesa

        $response = $product->storeProduct($data);



        if ($response)

            return redirect()
                            ->route('product.create')
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
    public function show(Product $product)
    {

      //  $user_login_id = auth()->user()->id;
      //  $user = auth()->user();

      $products = auth()->user()->product()->get();


        return view('product.product.show', compact('product' ));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {


        $user = auth()->user();


        return view('product.product.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $dataRequest = $this->validateRequest();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $nameFile = $product['image'];
              
            if  ($nameFile == "product_avatar.png"){
    
                //cria um nome para a imagem concatenado id e nome do user
                $name = 'product_'.time();   // tirar os espacos com o kebab_case
                $extenstion = $request->image->extension(); // reguperar a extensao do arquivo de imagem
                $nameFile = "{$name}.{$extenstion}"; // concatenando
                $product['image'] = $nameFile;
                //dd($nameFile);
            }
        
            $upload = $request->file('image')->storeAs('products', $nameFile);

            if (!$upload)
            return redirect() 
                        ->back()
                        ->with('error', 'Falha ao fazer o upload');
        }

        

        $data['name']           = $dataRequest['name'];
        $data['description']    = $dataRequest['description'];
        $data['type_product']   = $dataRequest['type_product'];
        $data['packing']        = $dataRequest['packing'];
        $data['unity']          = $dataRequest['unity'];
        $data['price']          = $dataRequest['price'];
        $data['price_unit']     = $dataRequest['price_unit'];
        $data['note']           = $dataRequest['note'];
        $data['in_use']         = $dataRequest['in_use'];
       

        $update = $product -> update($data);

        if ($update);

        return redirect()
                        ->route('product.edit' ,[ 'product' => $product->id ])
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
    public function destroy(Product $product)
    {
        $path = 'products/'.$product['image'];

        if($path != "products/product_avatar.png")

        Storage::delete($path);

        $destroy = $product->delete();

        return redirect('/product');
    }

    private function validateRequest()
    {

        return request()->validate([

            'name'          => 'required',
            'description'   => 'required',
            'type_product'  => 'required',
            'packing'       => 'required',
            'unity'         => 'required',
            'price'         => 'required',
            'price_unit'    => 'required',
            'in_use'        => 'required',
            'note'          => 'required',
            
    
       ]);


    }
}

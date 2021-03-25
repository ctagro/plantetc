
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$product->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">



            <div class="form-group">

                <input type="text" name="name" value="{{old('name') ?? $product->name }}" class="form-control" placeholder="Nome">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite o Nome</h6> 
                @endif
            </div>

            <div class="form-group">
                <label>Descrição: </label>
                    <input type="txt" name="description" value="{{old('description') ?? $product->description }}" class="form-control py-3" placeholder="Descrição">
                    @if($errors->has('description'))
                      <h6 class="text-danger" >Digite o Descrição</h6> 
                    @endif
              </div>
              

              <div class="form-group">
                <label>Embalagem: </label>
                    <input type="txt" name="packing" value="{{old('packing') ?? $product->packing }}" class="form-control py-3" placeholder="Descrição">
                    @if($errors->has('packing'))
                      <h6 class="text-danger" >Digite o tipo de embalagem</h6> 
                    @endif
              </div>
              
              <div class="form-group">
                <label>Unidade: </label>
                    <input type="txt" name="unity" value="{{old('unity') ?? $product->unity }}" class="form-control py-3" placeholder="Unidade">
                    @if($errors->has('unity'))
                      <h6 class="text-danger" >Digite a unidade</h6> 
                    @endif
              </div> 
              
              
              <div class="form-group">
                <label>Preço: </label>
                    <input type="number"  name="price" value="{{old('price') ?? $product->price }}"  placeholder="0.00" step="0.01" >
                    @if($errors->has('price'))
                      <h6 class="text-danger" >Digite o preço</h6> 
                    @endif
              </div>
              
              <div class="form-group">
                <label>Preço por unidade: </label>
                    <input type="number"  name="price_unit" value="{{old('price_unit') ?? $product->price_unit }}"  placeholder="0.00" step="0.01" >
                    @if($errors->has('price_unit'))
                      <h6 class="text-danger" >Digite o preço por unidade</h6> 
                    @endif
              </div> 

              <input type="hidden" name="type_product" value="?" class="form-control py-3">

              @if(!Request::is('*/edit'))
                    <input type="hidden" name="in_use" value="S" class="form-control py-3">
              @else
                <div class="form-group">
                    <label>Produto em uso: {{$product->in_use}} </label>
                    <select name="in_use"  id="in_use" class="form-control">
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                      </select>
                    @if($errors->has('in_use'))
                        <h6 class="text-danger" >Escolha a opção</h6> 
                    @endif
                </div>
              @endif
        
               <!-- Para ativar o uploud de imagens -->
               <div class="form-group">
                @if ($product->image != null)
                    <img src="{{ asset('storage/products/'.$product->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                    <label for="image">Imagem</label>
                    <input type="file" class="form-control"  name='image' value='product_avatar.png'>
            </div>

            <input type="hidden" name="note" value="?" class="form-control py-3">
              
         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/product') }}" class="float-right" >Voltar </a> 
                    </div>
                </div>
</div>


<!-- ./wrapper -->
<!-- jQuery -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
    window.location.href='#ancora';
</script>
<!-- page script -->



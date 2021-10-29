
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$pesticide->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">



            <div class="form-group">

                <input type="text" name="name" value="{{old('name') ?? $pesticide->name }}" class="form-control" placeholder="Nome">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite o Insumo</h6> 
                @endif
            </div>

              <div class="row">
                <div class="form-group col-sm-6 ">  
                  <label>Fabricante: </label>
                      <input type="txt" name="manufacturer" value="{{old('manufacturer') ?? $pesticide->manufacturer }}" class="form-control py-3" placeholder="Fabricante">
                      @if($errors->has('manufacturer'))
                        <h6 class="text-danger" >Digite as indicações</h6> 
                      @endif
                </div>
             

              <div class="form-group col-sm-6 "> 
                <label for="category_pesticide_id">Categoria:</label>
                <select name="category_pesticide_id"  id="category_pesticide_id" class="form-control">
                  <option selected="selected" value=""></option>
                    @foreach($category_pesticides as $category_pesticide)    

                        <option value="{{$category_pesticide->id}}" {{ $category_pesticide->id == $pesticide->category_pesticide_id ? 'selected' : ''}}>{{$category_pesticide->name}} </option>                 
                    @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="application">Aplicação:</label>    
                  <input type="longtext" name="application" value="{{old('application') ?? $pesticide->application }}" rows="4" class="form-control">                            
          </div>
  

              <div class="row">
                <div class="form-group col-sm-6 ">
                <label>Princípio Ativo: </label>
                    <input type="txt" name="active_principle_id" value="{{old('active_principle_id') ?? $pesticide->active_principle_id }}" class="form-control py-3" placeholder="Princípio Ativo">
                    @if($errors->has('active_principle_id'))
                      <h6 class="text-danger" >Digite o princípio ativo</h6> 
                    @endif
                </div>

                <div class="form-group col-sm-3 ">
                  <label>Carência (dias): </label>
                      <input type="txt" name="grace_period" value="{{old('grace_period') ?? $pesticide->grace_period }}" class="form-control py-3" placeholder="Carência">
                      @if($errors->has('grace_period'))
                        <h6 class="text-danger" >Digite período de carência</h6> 
                      @endif
                </div>

                <div class="form-group col-sm-3 ">
                  <label>Dosagem: </label>
                      <input type="txt" name="dosage" value="{{old('dosage') ?? $pesticide->dosage }}" class="form-control py-3" placeholder="Dosagem">
                      @if($errors->has('dosage'))
                        <h6 class="text-danger" >Digite a dosagem</h6> 
                      @endif
                </div>
              </div>
              
              

              <div class="row">
                  <div class="form-group col-sm-3 ">  
                      <label>Embalagem: </label>
                    <input type="txt" name="packing" value="{{old('packing') ?? $pesticide->packing }}" class="form-control py-3" placeholder="Embalagem">
                    @if($errors->has('packing'))
                      <h6 class="text-danger" >Digite a embalagem</h6> 
                    @endif
                     
                  </div>
              
               
                  <div class="form-group col-sm-3 ">
                    <label>Unidade: </label>
                    <input type="txt" name="unity" value="{{old('unity') ?? $pesticide->unity }}" class="form-control py-3" placeholder="Unidade">
                    @if($errors->has('unity'))
                      <h6 class="text-danger" >Digite a unidade</h6> 
                    @endif
                  </div> 
              
              
                  <div class="form-group col-sm-3 ">
                    <label>Preço: </label>
                    <input type="txt" name="price" value="{{old('price') ?? $pesticide->price }}" class="form-control py-3" placeholder="0.00" step="0.01">
                    @if($errors->has('price'))
                      <h6 class="text-danger" >Digite a unidade</h6> 
                    @endif
                  </div>
              
              
                  <div class="form-group col-sm-3 ">
                    <label>Preço por unidade: </label>
                    <input type="number"  name="price_unit" value="{{old('price_unit') ?? $pesticide->price_unit }}" class="form-control py-3" placeholder="0.0000" step="0.0001" >
                    @if($errors->has('price_unit'))
                      <h6 class="text-danger" >Digite a unidade</h6> 
                    @endif
                  </div> 
                </div>

              @if(!Request::is('*/edit'))
                    <input type="hidden" name="in_use" value="S" class="form-control py-3">
              @else
                <div class="form-group">
                    <label>Produto em uso: {{$pesticide->in_use}} </label>
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
                @if ($pesticide->image != null)
                    <img src="{{ asset('storage/pesticides/'.$pesticide->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                    <label for="image">Imagem</label>
                    <input type="file" class="form-control"  name='image' value='pesticide_avatar.png'>
              </div>

              <div class="form-group">
                @if ($pesticide->medicine_insert != null)
                    <img src="{{ asset('storage/pesticides/'.$pesticide->medicine_insert)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                    <label for="medicine_insert">Bula</label>
                    <input type="file" class="form-control"  name='medicine_insert' value='pesticide_avatar.png'>
              </div>

          

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/pesticide') }}" class="float-right" >Voltar </a> 
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



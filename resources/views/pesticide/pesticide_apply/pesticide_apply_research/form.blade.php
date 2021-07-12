<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Dados da Consulta</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
      <!-- /.card-header -->
    <div class="card-body">

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="date">Data Inicial :</label>
            <input type="date" name="date_inicial" id ="date_inicial"  class="form-control py-3" > 
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="date">Data Final :</label>
            <input type="date" name="date_final" id ="date_final"  class="form-control py-3" > 
          </div>
        </div>
      </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="pesticide_id">Defensivo:</label>
              <select name="pesticide_id"  id="pesticide_id" class="form-control">
                <option selected="selected" value=""></option>
                  @foreach($pesticides as $pesticide)    
                      <option value="{{$pesticide->id}}">{{$pesticide->name}} </option>                  
                  @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
                <label for="worker">Funcionário :</label>
                <select name="worker_id"  id="worker_id" class="form-control">
                  <option selected="selected" value=""></option>
                    @foreach($workers as $worker)    
                        <option value="{{$worker->id}}">{{$worker->name}} </option>                  
                    @endforeach
                </select>
            </div>
          </div>
        </div>

        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="ground">Área :</label>
                <select name="ground_id"  id="ground_id" class="form-control">
                  <option selected="selected" value=""></option>
                    @foreach($grounds as $ground)    
                        <option value="{{$ground->id}}">{{$ground->name}} </option>                  
                    @endforeach
                </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
                <label for="pesticide">Conta :</label>
                <select name="accounting_id"  id="accounting_id" class="form-control">
                  <option selected="selected" value=""></option>
                    @foreach($accountings as $accounting)    
                        <option value="{{$accounting->id}}">{{$accounting->name}} </option>                  
                    @endforeach
                </select>
            </div>
          </div>
       
        </div>
    </div>
        </div>
     </div> 

     
    
  </div>            

<!-- Fim do Formulario de pesticide_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>


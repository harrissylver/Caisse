@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
            @endif
            <div class="card">
                <form action="{{ route('caisse.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h2>Entrée le fond de caisse</h2>
                        <hr class="bg-danger border-4 border-top border-warning">
                        <div class="row mx-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="type">Type d'opération</label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="depot">dépot de caisse</option>
                                        <option value="remise">remise en banque</option>
                                        <option value="retrait ">retrait</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 pt-3 text-end">
                                <h1><span class="total">0</span> €</h1>
                            </div>
                            <div class="col-12 pt-2">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="text" value="{{ date('d/m/Y') }}" name="date" id="date"
                                        class="form-control w-25" readonly>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <div class="form-group">
                                    <label for="date">Note</label>
                                    <textarea name="note" id="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h2>Billets</h2>
                        <hr class="bg-danger border-4 border-top border-warning">
                        <div class="row mx-3 rowBillets">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <select name="nominal" id="nominal" class="form-select nominal">
                                        <option>0</option>
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                        <option>50</option>
                                        <option>100</option>
                                        <option>200</option>
                                        <option>500</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="quantite">Quantite</label>
                                    <input type="number" name="quantite" id="quantite" class="form-control quantite">
                                </div>
                            </div>
                            <div class="col-6 pt-3 text-end">
                                <h1><span class="montant">0</span> €</h1>
                            </div>

                        </div>
                        <div id="billets">

                        </div>
                        <button class="btn-sm btn-success m-4" id="ajoutBillets" type="button">Ajouter</button>
                        <br>
                        <h2>Pièces</h2>
                        <hr class="bg-danger border-4 border-top border-warning">
                        <div class="row mx-3 rowPieces">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <select name="nominal" id="nominal" class="form-select nominal">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="quantite">Quantite</label>
                                    <input type="number" name="quantite" id="quantite" class="form-control quantite">
                                </div>
                            </div>
                            <div class="col-6 pt-3 text-end">
                                <h1><span class="montant">0</span> €</h1>
                            </div>

                        </div>
                        <div id="pieces">

                        </div>
                        <button class="btn-sm btn-success m-4" id="ajoutPieces" type="button">Ajouter</button>
                        <br>
                        <h2>Centimes</h2>
                        <hr class="bg-danger border-4 border-top border-warning">
                        <div class="row mx-3 rowCentimes">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <select name="nominal" id="nominal" class="form-select nominal">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                        <option>50</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="quantite">Quantite</label>
                                    <input type="number" name="quantite" id="quantite" class="form-control quantite">
                                </div>
                            </div>
                            <div class="col-6 pt-3 text-end">
                                <h1><span class="montant">0</span> €</h1>
                            </div>

                        </div>
                        <div id="centimes">

                        </div>
                        <button class="btn-sm btn-success m-4" id="ajoutCentimes" type="button">Ajouter</button>
                        <hr>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <input type="hidden" value="0" name="total" class="total1">
                            <button class="btn btn-secondary float-center" type="submit">Enregistrer</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
            var quantite=0;
            var montant=0;
            var nominal=0;

            var i = 0;
            $("#ajoutBillets").click(function () {
              
                //===============
                $("#billets")
                  .append(
                        `<div class="row mx-3 rowBillets" >
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <select name="nominal" id="nominal" class="form-select nominal">
                                    <option>0</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>200</option>
                                    <option>500</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="quantite">Quantite</label>
                                <input type="number" name="quantite" id="quantite" class="form-control quantite">
                            </div>
                        </div>
                        <div class="col-1 pt-4">
                            <input type="hidden" class="param" value="${i}">
                            <button class="btn-sm btn-danger removeBillets"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="col-5 pt-3 text-end">
                            <h1><span class="montant">0</span> €</h1>
                        </div>

                    </div>`
                   );
                 i++;
            });
            //=============
            $(document).on('click', '.removeBillets', function () {
                var item =$(this).closest('.rowBillets')
                        .find(".param") 
                        .val();
                    val=parseInt(item)+1;
                    if(val==i){
                        $(this).closest('.rowBillets').remove();
                        i--;
                    }
            });

            $(document).on('keyup change', '.quantite,.nominal', function() {
                nominal =$(this).closest('.rowBillets').find(".nominal").val(); 
                quantite =$(this).closest('.rowBillets').find(".quantite").val(); 
                if(quantite!="") {
                    montant=parseInt(nominal)*parseInt(quantite);
                }
                else{
                    montant=0;
                }

                $(this).closest('.rowBillets').find(".montant").text(montant);

            });


            var j = 0;
            $("#ajoutPieces").click(function () {
              
                //===============
                $("#pieces")
                  .append(
                        `<div class="row mx-3 rowPieces" >
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <select name="nominal" id="nominal" class="form-select nominal">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="quantite">Quantite</label>
                                <input type="number" name="quantite" id="quantite" class="form-control quantite">
                            </div>
                        </div>
                        <div class="col-1 pt-4">
                            <input type="hidden" class="param1" value="${j}">
                            <button class="btn-sm btn-danger removePieces"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="col-5 pt-3 text-end">
                            <h1><span class="montant">0</span> €</h1>
                        </div>

                     
                       
                    </div>`
                   );
                 j++;
            });
            //=============
            $(document).on('click', '.removePieces', function () {
                var item =$(this).closest('.rowPieces')
                        .find(".param1") 
                        .val();
                    val=parseInt(item)+1;
                    if(val==j){
                        $(this).closest('.rowPieces').remove();
                        j--;
                    }
            });
            $(document).on('keyup change', '.quantite,.nominal', function() {
                nominal =$(this).closest('.rowPieces').find(".nominal").val(); 
                quantite =$(this).closest('.rowPieces').find(".quantite").val(); 
                if(quantite!="") {
                    montant=parseInt(nominal)*parseInt(quantite);
                }
                else{
                    montant=0;
                }
                $(this).closest('.rowPieces').find(".montant").text(montant);

            });

            var k = 0;
            $("#ajoutCentimes").click(function () {
              
                //===============
                $("#centimes")
                  .append(
                        `<div class="row mx-3 rowCentimes" >
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <select name="nominal" id="nominal" class="form-select nominal">
                                    <option value="0">0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="quantite">Quantite</label>
                                <input type="number" name="quantite" id="quantite" class="form-control quantite">
                            </div>
                        </div>
                        <div class="col-1 pt-4">
                            <input type="hidden" class="param2" value="${k}">
                            <button class="btn-sm btn-danger removeCentimes"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="col-5 pt-3 text-end">
                            <h1><span class="montant">0</span> €</h1>
                        </div>

                     
                       
                    </div>`
                   );
                 k++;
            });
            //=============
            $(document).on('click', '.removeCentimes', function () {
                var item =$(this).closest('.rowCentimes')
                        .find(".param2") 
                        .val();
                    val=parseInt(item)+1;
                    if(val==k){
                        $(this).closest('.rowCentimes').remove();
                        k--;
                    }
            });

            // ================

            $(document).on('keyup change', '.quantite,.nominal', function() {
                nominal =$(this).closest('.rowCentimes').find(".nominal").val(); 
                quantite =$(this).closest('.rowCentimes').find(".quantite").val(); 
                if(quantite!="") {
                    montant=parseInt(nominal)*parseInt(quantite)/100;
                }
                else{
                    montant=0;
                }

                $(this).closest('.rowCentimes').find(".montant").text(montant);
                var sum = 0;
                $('.montant').each(function(){
                    sum += parseFloat($(this).text()); 
                   
                     // Or this.innerHTML, this.innerText
                });
                $('.total').text(sum);
                $('.total1').val(sum);
            });
        
        });
</script>
@endsection
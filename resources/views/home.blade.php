@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
       
        <div class="col-md-12">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            <div class="card">
                <div class="card-body">

                    <div class="row mx-3">
                        <div class="col-4">
                            <h2>Total caisse</h2>
                            <hr class="bg-danger border-4 border-top border-warning">
                            <h1>{{ $total }} €</h1>
                        </div>
                        <div class="col-8">
                            <h2>Opérations du jour</h2>
                            <hr class="bg-danger border-4 border-top border-warning">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Montant</th>
                                        <th>Retraits</th>
                                        <th>Ajouts</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($caisses)
                                    @foreach ($caisses as $date=>$caisse)
                                    <tr>
                                        <td>{{ $date }}</td>
                                        <td>
                                            @foreach ($caisse['rows'] as $item)
                                            <span>{{ $item->type }}</span>,
                                            @endforeach
                                        </td>
                                        <td>{{$caisse['montant']}}</td>
                                        <td>{{$caisse['retrait']}}</td>
                                        <td>{{$caisse['ajout']}}</td>
                                        <td>{{$caisse['total']}}</td>
                                        <td>
                                            <a href="#" class="btn-sm btn-primary edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn-sm btn-danger suppr"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">
                                            Aucune donnée n'est encore enregistrer dans la base de données
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal --}}
<div class="modal fade" id="supprModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('suppresion') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="date" id="date">
                    <label>Voulez vous le supprimez vraiment ?</label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-sm btn-primary">Supprimer</button>
                    <button type="button" class="btn-sm btn-danger" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
            $(".table").on('click','.suppr',function(){
                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text(); 
                $('#date').val(col1);
                $('#supprModal').modal('show');
            });
          });
</script>
@endsection
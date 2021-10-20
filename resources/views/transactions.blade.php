@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="statbox widget box box-shadow mb-4">
                   
                    <div class="col-12 bg-white pt-2 mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-5 text-lg-left text-center pt-2">
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg><b>Liste des transactions</b></h5>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="d-sm-flex justify-content-lg-end justify-content-center text-center">
                                    <button class="btn btn-linnasoft-1 mb-2" type="button" id="btn_new_transaction" data-target="#transactionModal" data-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Créer une opération</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white pt-4 pb-4">
                        <div class="table-responsive">
                            <table id="transactions_table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Date de paiement</td>
                                        <td>Montant TTC</td>
                                        <td>Mode de paiement</td>
                                        <td>Tiers</td>
                                        <td>Formation</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="transactions_list">
                                    @foreach($transactions as $transaction)
                                    <tr id="line{{ $transaction['id'] }}">
                                        <td nowrap>{{ returnDate($transaction['date']) }}</td>
                                        <td nowrap>{{ number_format($transaction['amount'],0,',',' ') }}</td>
                                        <td class="text-warning">{{ $transaction['payment_mode'] }}</td>
                                        <td><b>{{ $transaction['student'] }}</b></td>
                                        <td nowrap>
                                            "<div class="max-w-180 text-ellipsis inline-elements mt-1">
                                                {{ $transaction['formation'] }}
                                            </div>"
                                        </td>
                                        <td nowrap>
                                            <button class="btn-custom-light btn_delete_transaction" data-target="{{ $transaction['id'] }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-center">
                    <h5 class="modal-title text-white" id="transactionModalLabel">Nouvelle opération</h5>
                </div>
                <div id="validation-main-msg"></div>
                <form id="addNewTransaction" class="" autocomplete="off">
                    @csrf
                    <div class="modal-body pl-4 pr-4" style="max-height:400px;overflow-y:auto">
                        <div class="form-row">
                            <div class="col-12 col-md-7 col-lg-6 mb-3">
                                <label for="" class="text-dark">Etudiant</label>
                                <select name="transaction_student" class="form-control">
                                    <option value="">---</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student['id'] }}">{{ $student['firstname'].' '.$student['lastname'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="" class="text-dark">Montant payé</label>
                                <input type="text" class="form-control" name="transaction_amount" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="" class="text-dark">Date de paiement</label>
                                <input type="text" class="form-control datepicker" name="transaction_date" />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="" class="text-dark">Mode de paiement</label>
                                <select name="transaction_payment_mode" class="form-control">
                                    <option value="">---</option>
                                    <option value="Espèces">Espèces</option>
                                    <option value="Orange money">Orange money</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    
@endsection  

  
@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="statbox widget box box-shadow mb-4">
                   
                    <div class="col-12 bg-white pt-2 mb-3">
                        <div class="row">
                            <div class="col-12 col-lg-5 text-lg-left text-center pt-2">
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg><b>Liste des formations</b></h5>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="d-sm-flex justify-content-lg-end justify-content-center text-center">
                                    <button class="btn btn-linnasoft-1 mb-2" type="button" id="btn_new_formation" data-target="#formationModal" data-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Créer une formation</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white pt-4 pb-4">
                        <div class="table-responsive">
                            <table id="formations_table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Titre</td>
                                        <td>Physique/En ligne</td>
                                        <td>Prix</td>
                                        <td>Places Max</td>
                                        <td>Certifiée ?</td>
                                        <td>Statut</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="formations_list">
                                    @foreach($formations as $formation)
                                    <tr id="line{{ $formation->id }}">
                                        <td>
                                            <div class="max-w-180 text-ellipsis inline-elements mt-1 text-warning">
                                                {{ $formation->f_title }}
                                            </div>
                                        </td>
                                        <td nowrap>{!! formation_type($formation->type) !!}</td>
                                        <td nowrap><b>{{ number_format($formation->f_price,0,',',' ') }}</b></td>
                                        <td>{{ $formation->f_max_students }}</td>
                                        <td>{!! is_certif($formation->f_certification) !!}</td>
                                        <td nowrap>
                                            <b>{{ ($formation->f_state == 'active')? 'Activée': 'Desactivée' }}</b>
                                        </td>
                                        <td nowrap>
                                            <button token="" id="" class="btn-custom-light btn_show_formation" data-target="{{ $formation->token }}" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </button>
                                            <button class="btn-custom-light btn_delete" data-target="{{ $formation->id }}">
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

    <div class="modal fade" id="formationModal" tabindex="-1" role="dialog" aria-labelledby="formationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-center">
                    <h5 class="modal-title text-white" id="formationModalLabel">Nouvelle formation</h5>
                </div>
                <div id="validation-main-msg"></div>
                <form id="addNewFormation" class="" autocomplete="off">
                    @csrf
                    <div class="modal-body pl-4 pr-4" style="max-height:400px;overflow-y:auto">
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="" class="text-dark">Titre</label>
                                <input type="text" class="form-control" id="" name="formation_title" placeholder="entrez le titre de la formation ..." />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="" class="text-dark">Type</label>
                                <select class="form-control" id="" name="formation_type">
                                    <option value="physical">Physique</option>
                                    <option value="online">En ligne</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="" class="text-dark">Tarif</label>
                                <input type="number" class="form-control" id="" name="formation_price" min="1" value="1"  />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <label for="" class="text-dark">Nombre de places</label>
                                <input type="number" class="form-control" id="" name="formation_max_students" min="1" value="1"  />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-5">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" class="new-control-input" name="formation_certification" /> <span class="new-control-indicator"></span>Formation certifiante ?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <h5><b>Ajouter une date</b> <button class="btn btn-sm btn-danger" id="btn_add_date" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></button> </h5>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-md-6 col-xl-3 mb-3">
                                <label for="" class="text-dark">Date</label>
                                <input type="text" class="form-control datepicker" name="starton1" />
                            </div>
                            <div class="col-4 col-md-3 col-xl-2 mb-3">
                                <label for="" class="text-dark">De</label>
                                <input type="text" class="form-control custom-timepicker" name="startat1" />
                            </div>
                            <div class="col-4 col-md-3 col-xl-2 mb-3">
                                <label for="" class="text-dark text-uppercase">à</label>
                                <input type="text" class="form-control custom-timepicker" name="endat1" />
                            </div>
                        </div>
                        <div id="datesContent" style=""></div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <ul class="nav nav-tabs mb-3 mt-3" id="borderTop" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" style="color:#0076A8" id="border-top-formationDescription-tab" data-toggle="tab" href="#border-top-formationDescription" role="tab" aria-controls="border-top-formationDescription" aria-selected="true"> Description de la formation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="color:#0076A8" id="border-top-formationRequirements-tab" data-toggle="tab" href="#border-top-formationRequirements" role="tab" aria-controls="border-top-formationRequirements" aria-selected="false"> Prérequis de la formation</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="borderTopContent">
                                    <div class="tab-pane fade show active" id="border-top-formationDescription" role="tabpanel" aria-labelledby="border-top-formationDescription-tab">
                                        <textarea id="description_field" class="form-control" name="formation_description"></textarea>
                                    </div>
                                    <div class="tab-pane fade" id="border-top-formationRequirements" role="tabpanel" aria-labelledby="border-top-formationRequirements-tab">
                                        <textarea id="requirements_field" class="form-control" name="formation_requirements"></textarea>
                                    </div>
                                </div>
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

  
@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="statbox widget box box-shadow mb-4">
                    <div class="text-center bg-linna-light pt-4 pb-4 col-12 mb-3">
                        <h2><b>{{ $formation->f_title }}</b></h2>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-7 col-xl-7 mb-3">
                                <div class="bg-white p-5">
                                    <form id="students_inscription" target="{{ $formation->id }}" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-12 text-center mb-4">
                                                <h5> <b>Remplissez le formulaire d'inscription</b> </h5>
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="n-chk">
                                                <label class="new-control new-checkbox checkbox-success">
                                                    <input type="radio" class="new-control-input" value="female" id="female" name="gender">
                                                    <span class="new-control-indicator"></span>Femme
                                                </label>
                                            </div>
                                            <div class="n-chk">
                                                <label class="new-control new-checkbox checkbox-success">
                                                    <input type="radio" class="new-control-input" value="male" id="male" name="gender">
                                                    <span class="new-control-indicator"></span>Homme
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="" class="text-dark">Prénom</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Entrez votre prénom" />
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="" class="text-dark">Nom</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Entrez votre nom" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="" class="text-dark">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Entrez votre email" />
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="" class="text-dark">Téléphone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 text-center text-md-left">
                                                <button type="submit" class="btn btn-block btn-primary">Je m'inscris</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 col-xl-5 mb-3">
                                <div class="bg-white pt-4 pl-4 pr-4 pb-2">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg> 
                                                        <span class="ml-2"><b>Physique/En ligne</b></span>
                                                    </td>
                                                    <td class="text-right"><b>{!! formation_type($formation->f_type) !!}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg> 
                                                        <span class="ml-2"><b>Tarif</b></span>
                                                    </td>
                                                    <td class="text-right"><b>{{ number_format($formation->f_price,0,',',' ') }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                        <span class="ml-2"><b>Nombre de places</b></span>
                                                    </td>
                                                    <td class="text-right"><b>{{ $formation->f_max_students }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                                        <span class="ml-2"><b>Formation certifiée</b></span>
                                                    </td>
                                                    <td class="text-right"><b>{!! is_certif($formation->f_certification) !!}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                        <span class="ml-2"><b>Dates</b></span>
                                                    </td>
                                                    <td class="text-right text-warning">
                                                        @foreach($dates as $date)
                                                           <div><b>{{ returnDate($date->starts_on) }} : {{ $date->starts_at }} - {{ $date->ends_at }}</b></div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if($conditions)
                                <div class="bg-white pt-4 pl-4 pr-4 pb-2 mt-2">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                            @foreach($conditions as $condition)
                                                <tr>
                                                    <td>{{ $condition->label }} :</td>
                                                    <td><b>{{ $condition->value }}</b></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-white mb-4">
                            <ul class="nav nav-tabs" id="borderTop" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" style="color:#0076A8" id="border-top-description-tab" data-toggle="tab" href="#border-top-description" role="tab" aria-controls="border-top-description" aria-selected="true"> Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="color:#0076A8" id="border-top-requirements-tab" data-toggle="tab" href="#border-top-requirements" role="tab" aria-controls="border-top-requirements" aria-selected="false"> Prérequis</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="borderTopContent">
                                <div class="tab-pane fade show active p-3" id="border-top-description" role="tabpanel" aria-labelledby="border-top-description-tab">
                                    {!! $formation->f_description !!}
                                </div>
                                <div class="tab-pane fade p-3" id="border-top-requirements" role="tabpanel" aria-labelledby="border-top-requirements-tab">
                                    {!! $formation->f_requirements !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection  
@extends('layouts.app')

@section('content')

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="statbox widget box box-shadow mb-4">

                    <div class="col-12 bg-white pt-4 pb-4">
                        <h5><b>Formation</b></h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" style="width:100%">
                                <tbody>
                                    <tr>
                                        <td>Titre</td>
                                        <td>{{ $formation->f_title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tarif</td>
                                        <td>{{ number_format($formation->f_price,0,',',' ') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type (Physique/En ligne)</td>
                                        <td>{!! formation_type($formation->f_type) !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Dates</td>
                                        <td nowrap>
                                            @foreach($dates as $date)
                                                <div class="mb-2 text-warning">
                                                        {{ returnDate($date->starts_on).' : '.$date->starts_at.' - '.$date->ends_at }}
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Certifiée ?</td>
                                        <td>{!! is_certif($formation->f_title) !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Places Max</td>
                                        <td>{{ $formation->f_max_students }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $formation->f_description}}</td>
                                    </tr>
                                    <tr>
                                        <td>Prérequis</td>
                                        <td>{{ $formation->f_requirements }}</td>
                                    </tr><tr>
                                        <td>Statut</td>
                                        <td>{{ ($formation->f_state == 'active')? 'Activée': 'Desactivée' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 bg-white pt-4 pb-4">
                        <h5><b>Inscriptions</b> (TOTAL : <b id="count_reg">{{ count($students) }}</b> / {{ $formation->f_max_students }})</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <td>Prénom</td>
                                        <td>Nom</td>
                                        <td>Sexe</td>
                                        <td>Email</td>
                                        <td>Téléphone</td>
                                        <td>Date d'inscription</td>
                                        <td>Paiement</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr id="student_line{{ $student['id'] }}">
                                        <td>{{ $student['firstname'] }}</td>
                                        <td>{{ $student['lastname'] }}</td>
                                        <td class="text-uppercase"><b>{{ $student['gender'] }}</b></td>
                                        <td>{{ $student['email'] }}</td>
                                        <td>{{ $student['phone'] }}</td>
                                        <td>{{ returnDate($student['date']) }}</td>
                                        <td>{{ number_format($student['payment'],0,',',' ') }}</td>
                                        <td>
                                            <button class="btn-custom-light bg-white btn_delete_student" type="button" id="{{ $student['id'] }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
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
    
@endsection  

  
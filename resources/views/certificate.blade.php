<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title><!-- -->
    <style type="text/css">
        @page { margin: 0px; }
        body
        {
            margin: 0px;
            font-family: Verdana, Arial, sans-serif;
            font-size:14px;
            padding:30px;
            background-image: url('{{ public_path("storage/background.png") }}');
            background-repeat: no-repeat;
            background-color: #e8f4fe;
            background-size: cover;
            background-position: center;
        }

        .base-color-text{
            color:#3d6581;
        }

        .base-color{
            background-color:#e8f4fe;
            color:#ffffff;
        }

        .text-gray{
            color:#414141;
        }

        .float-right{
            float:right;
        }

        .float-left{
            float-left;
        }

        .mb-15{
            margin-bottom:15px;
        }

        .text-left{
            text-align: left;
        }

        .text-right{
            text-align: right;
        }

        .text-center{
            text-align: center;
        }

        .text-uppercase{
            text-transform: uppercase;;
        }

        .text-uppercase{
            text-transform: uppercase;
        }

        .border-bottom{
            border-bottom:1px solid #000;
        }

        .border-bottom-base{
            border-bottom: 1px solid #3d6581;
        }

        .border-top-double{
            border-top: 2px double #000;
        }

        .pb-15{
            padding-bottom: 15px;
        }

        .pt-15{
            padding-top: 15px;
        }

        .block-span{
            display:block;
        }

        .pb-10{
            padding-bottom: 10px;
        }

        .font-normal{
            font-weight: normal;
        }

        .p-8{
            padding:8px;
        }

        .p-3{
            padding:3px;
        }

        .ptb-3{
            padding-top: 3px;
            padding-bottom: 3px;
        }

        .clear{
             clear: both;
        }

        table{
            border-collapse: collapse;
        }

        .footer{
            position: fixed;
            bottom: 200px;
            left: 30px;
            right: 30px;
            text-align: center;
        }

        .text-gray-dark{
            color: #363636;
        }

        .text-50{
            font-size:50px;
        }

        .text-22{
            font-size:22px;
        }

        .text-35{
            font-size:35px;
        }

        .text-30{
            font-size: 30px;
        }

        .text-18{
            font-size: 18px;
        }

        .mb--10{
            margin-bottom: -10px;
        }

        .d-block{
            display:block;
        }
    </style>
</head>
<body>
    <div id="main-content">
      <div class="">
          <table style="width:100%">
                  <tbody>
                      <tr>
                          <td width="30%" class="text-center">
                              <img src="{{ public_path('assets/img/logo/logo_dsg_dark.png') }}" class="pt-10" width="250px" alt="logo">
                          </td>
                      </tr>
                  </tbody>
          </table>
      </div>
        <div class="text-center">
            <h3 class="text-uppercase text-50"><b>Attestation de formation</b></h3>
            <h4 class="font-normal text-22 text-gray">ce document atteste que</h4>
            <h3 class="font-normal text-35 text-gray-dark">
                <b>{{ (($data['student']->gender == 'm')? 'M.': 'Mme').' '.$data['student']->firstname.' '.$data['student']->lastname }}</b>
            </h3>
            <h5 class="font-normal text-30 text-gray-dark">
                <span class="font-normal text-22 text-gray-dark d-block pt-15">
                    a activement participé {!! ($data['date_start'] == $data['date_end'])? 'le <b>'.returnDate($data['date_end']).'</b>': 'du <b>'.returnDate($data['date_start']).'</b> au <b>'.returnDate($data['date_end']).'</b>' !!} à la formation :
                </span>
                <span class="font-normal text-gray-dark d-block pt-15">
                    "{{ $data['formation']->f_title }}"
                </span>
            </h5>
        </div>
        <div class="footer">
            <table style="width:100%">
                    <tbody>
                        <tr>
                            <td width="35%" class="font-normal text-18 text-gray-dark text-center">
                                Directrice Générale de Linnasoft sarl
                            </td>
                            <td width="30%" class="text-center">
                                <span class="font-normal text-18 text-gray-dark d-block pb-10">
                                    Délivrée le {{ returnDate($data['date_end']) }}
                                </span>
                                <img src="{{ public_path('assets/img/logo/reward.png') }}" width="120px" alt="reward icon">
                            </td>
                            <td width="35%" class="font-normal text-18 text-gray-dark text-center">
                                Directeur adjoint de Linnasoft sarl, Responsable des formations
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>

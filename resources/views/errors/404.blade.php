<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo/favicon.ico')}}"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    
    <style>
        .theme-logo {
          width: 62px;
          height: 62px;
          border-radius: 5px;
        }

        body.error404 {
          background-attachment: fixed;
          background-size: cover;
          background-color: #ffffff;
        }
        body.error404 > .error-content {
          min-height: 80vh;
          display: flex;
          align-items: center;
          justify-content: center;
          text-align: center;
          padding: 30px;
        }

        .error404 .mini-text {
          font-size: 33px;
          font-weight: 700;
          margin-bottom: 0;
          color: #1b55e2;
        }
        .error404 .img-cartoon {
          width: 170px;
          height: 170px;
        }
        .error404 .error-number {
          font-size: 170px;
          color: #fff;
          font-weight: 600;
          margin-bottom: 5px;
          margin-top: 15px;
          text-shadow: 0px 5px 4px rgba(31, 45, 61, 0.1019607843);
        }
        .error404 .error-text {
          font-size: 18px;
          color: #3b3f5c;
          font-weight: 600;
        }
        .error404 a.btn {
          width: 134px;
          padding: 6px;
          font-size: 17px;
          background-image: linear-gradient(135deg, #1b55e2 0%, #5c1ac3 100%);
          border: none;
          letter-spacing: 2px;
        }
        .error404 a.btn:hover, .error404 a.btn:not(:disabled):not(.disabled):active {
          background-image: linear-gradient(to right, #1b55e2 0%, #5c1ac3 100%);
        }      
    </style>
</head>
<body class="error404 text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="/" class="ml-md-5">
                    <img alt="logo" width="50px" height="50px" src="{{asset('assets/img/logo/logo_110x110.png')}}"> 
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number"><img alt="sad-icon" width="150px" height="150px" src="{{asset('assets/img/sad.png')}}"></h1>
            <p class="mini-text">Oops !</p>
            <p class="error-text mb-4 mt-1">{{ ($exception->getMessage())? $exception->getMessage() : 'La page que vous recherchez est introuvable !'}}</p>
            <a href="javascript:history.back()" class="btn btn-primary mt-5">Retour</a>
        </div>
    </div>    
</body>
</html>

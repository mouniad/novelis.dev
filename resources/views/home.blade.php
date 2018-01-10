<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novelis PFE Project</title>
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link href="{{ asset('css/style.less') }}" rel="stylesheet">
</head>
<body>

<div ng-app="app">
    <div ng-view></div>
</div>


<!-- SCRIPTS -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/angular/angular.min.js')}}"></script>
<script src="{{asset('bower_components/angular-route/angular-route.min.js')}}"></script>

<script src="{{asset('js/angularfiles/app.js')}}"></script>
<script src="{{asset('js/angularfiles/views/MainController.js')}}"></script>


</body>
</html>
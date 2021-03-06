<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Novelis PFE Project</title>
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link href="{{ asset('css/style.less') }}" rel="stylesheet">
    </head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="#"><img id="logo" src="{{asset('assets/logo.png')}}"></a>
            <a class="navbar-brand" href="#">Contacts Manager</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="./#!/contacts">Contacts</a></li>
                <li><a href="./#!/groups">Groups</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div ng-app="app">
    <div ng-view></div>
</div>


<!-- SCRIPTS -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/angular/angular.min.js')}}"></script>
<script src="{{asset('bower_components/angular-route/angular-route.min.js')}}"></script>

<script src="{{asset('js/angularfiles/app.js')}}"></script>
<script src="{{asset('js/angularfiles/views/main/MainController.js')}}"></script>
<script src="{{asset('js/angularfiles/views/contact/ContactsController.js')}}"></script>
<script src="{{asset('js/angularfiles/views/group/GroupsController.js')}}"></script>

<script src="{{asset('js/angularfiles/services/ContactService.js')}}"></script>

</body>
</html>
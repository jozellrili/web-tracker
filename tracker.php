<!DOCTYPE html>
<html ng-app="myApp" ng-app lang="en">
<!-- Header -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Redmorph</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/web_crawler.css" rel="stylesheet">

    <!-- column cursor -->
    
    <style type="text/css">
    ul>li, a{cursor: pointer;}
    </style>

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              </button>
                 <a class="navbar-brand topnav" href="#">
                    <img src="img/logo.gif" alt="" class="img-responsive">
                </a>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php"  class="active">HOME</a>
                    </li>
                    <li>
                        <a href="tracker.php">TRACKER LIST</a>
                    </li>
                    
                   
                </ul>
            </div>
           <!-- navigation  -->
            
        </div>
        <!-- /.container -->
       
    </nav> 

<div class="space"></div>
<div ng-controller="dataCrtl">
<div class="container">

    <div class="row">
        <div class="col-md-2">PageSize:
            <select ng-model="entryLimit" class="form-control">
                <option>5</option>
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="col-md-3">Filter:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
        </div>
        <div id="csv" class="col-md-2"style="float:right; padding-top: 30px;">
                    <a type="submit" id="btncsv" name="btncsv" class="btn btn-default" onclick="downloadcsv()"><i class="fa fa-download"></i><span> Download</span></a>

        </div>
        
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12" ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
            <th>No.&nbsp;<a ng-click="sort_by('id');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>DOMAIN NAME&nbsp;<a ng-click="sort_by('domain');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>URL&nbsp;<a ng-click="sort_by('url');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>TYPE&nbsp;<a ng-click="sort_by('type');"><i class="glyphicon glyphicon-sort"></i></a></th>
            
        
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.id}}</td>
                    <td>{{data.domain}}</td>
                    <td>{{data.url}}</td>
                    <td>{{data.type}}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-offset-5">
                <h4>No record found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
            
            
        </div>
    </div>
</div>
</div>

<script src="js/jquery.js"></script>
<script>
function downloadcsv() {
    window.open("export.php");
}
</script>
<script src="js/angular.min.js"></script>
<script src="js/ui-bootstrap-tpls-0.10.0.min.js"></script>
<script src="js/app.js"></script>   
<script src="js/bootstrap.min.js"></script>      
</body>
</html>
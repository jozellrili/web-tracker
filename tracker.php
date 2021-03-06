<?php
include("header.php");
?>
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
    <div class="row col-md-5">
    
        <label class="row col-md-5 label-control">Total No. of Records:</label><p>{{ totalItems}}</p>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12" ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
            <th>NO.&nbsp;<a ng-click="sort_by('id');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>REQUESTED PAGE.&nbsp;<a ng-click="sort_by('requested_page');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>DOMAIN NAME&nbsp;<a ng-click="sort_by('domain');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>URL&nbsp;<a ng-click="sort_by('url');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>TYPE&nbsp;<a ng-click="sort_by('type');"><i class="glyphicon glyphicon-sort"></i></a></th>
            <th>ACTION</th>
           
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td class="hidden">{{data.id}}</td>
                    <td>{{filtered.indexOf(data)+1}}</td>
                    <td>{{data.requested_page}}</td>
                    <td>{{data.domain}}</td>
                    <td class="word-break"><a target="_blank" href="http://{{data.url}}">{{data.url}}</a></td>
                    <td>{{data.type}}</td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button id="del-btn" ng-href="delete_data.php?id={{ data.id }}" class="btn btn-danger btn-xs"  data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                   
                </tr>
            </tbody>
            </table>
        </div>
       
            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
    <div class="modal-content">
         
          
        
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    

        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-offset-5">
                <h4>No record found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
           <pagination total-items="filteredItems" on-select-page="setPage(page)" page="currentPage" items-per-page="entryLimit" max-size="entryLimit" class="pagination-small" boundary-links="true" rotate="false" num-pages="numPages"></pagination>
            
           
            
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
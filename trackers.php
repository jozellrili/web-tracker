<!DOCTYPE html>
<html lang="en">
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

    <!-- paganation CSS -->
    <link href="css/page.css" rel="stylesheet">


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

<!-- Navigation -->
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
                        <a href="trackers.php">TRACKER LIST</a>
                    </li>
                    
                   
                </ul>
            </div>
           <!-- navigation  -->
            
        </div>
        <!-- /.container -->
       
    </nav> 

		<div class="container content-section-a" id = "list">
   			 <div class="row">
        		<div class="container">
        		<form method="POST">
        		<div id="csv" style="float:right; padding-bottom: 10px;">
        			<a type="submit" id="btncsv" name="btncsv" class="btn btn-default" onclick="downloadcsv()"><i class="fa fa-download"></i><span> Download</span></a>

        		</div>
        		</form>
<?php
	include('db_connection.php');

	$tbl_name="tracker_list";
	// How many adjacent pages should be shown on each side?
	$adjacents = 5;
	
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$result = $conn->query($query);
	$total_pages = $result->fetch_array();
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "trackers.php"; 	//your file name  (the name of this file)
	$limit = 10;							//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	$result = $conn->query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	//firstpage = 1;
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	$pagination = "";
	if($lastpage > 1)
	{	

		$pagination .= "<div class='container row pagination'>";
        //first button
        if ($page > 1){
        	$pagination.="<span class ='visible'><a href='$targetpage?page=1'>first</a></span>";
        }
        else {
        	$pagination.= "<span class='hidden'>previous</span>";
        }
		//previous button
		if ($page > 1){
			$pagination.= "<span class ='visible'><a href='$targetpage?page=$prev'>previous</a></span>";
		}
		else{
			$pagination.= "<span class='hidden'>previous</span>";	
		}
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$pagination.= "<span class='current'>$counter</span>";
				}
				else{
					$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";				
				}
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page){
						$pagination.= "<span class='current'>$counter</span>";
					}
					else{	
						$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";		
					}		
				}
				$pagination.= "...";
				$pagination.= "<a href='$targetpage?page=$lpm1'>$lpm1</a>";
				$pagination.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href='$targetpage?page=1'>1</a>";
				$pagination.= "<a href='$targetpage?page=2'>2</a>";
				$pagination.= "<a href='$targetpage?page=2'>2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page){
						$pagination.= "<span class='current'>$counter</span>";
					}
					else{
						$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";					
					}
				}
				$pagination.= "...";
				$pagination.= "<a href='$targetpage?page=$lpm1'>$lpm1</a>";
				$pagination.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{	
				$pagination.= "<a href='$targetpage?page=1'>1</a>";
				$pagination.= "<a href='$targetpage?page=2'>2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$pagination.= "<span class='current'>$counter</span>";
					}
					else{
						$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";					
					}
				}
			}
		}
		
		//next button
		if ($page < $counter - 1){
			$pagination.= "<span class ='visible'><a href='$targetpage?page=$next'>next</a></span>";
		}
		else{
			$pagination.= "<span class='hidden'>next</span>";
			$pagination.= "</div>\n";	
		}

		//last button
		if ($page < $counter - 1){
			$pagination.= "<span class ='visible'><a href='$targetpage?page=$lastpage'>last</a></span>";
		}
		else{
			$pagination.= "<span class='hidden'>last</span>";
			$pagination.= "</div>\n";	
		}
	}
?>

	<?php
	
	if ($result->num_rows > 0) {

		echo "
		<div class='container'>
		<table class = 'table table-striped'>
		<tbody>
		<tr>
		<th>#</th><th>DOMAIN NAME</th><th>URL</th><th>TYPE</th>
		</tr>
		";
		
		while($row = $result->fetch_assoc())
		{	
			echo "
			<tr>
			<td>".$row['id']."</td><td>".$row['domain']."</td><td><a target='_blank' href= 'http://".$row['url']."'>".$row['url']."</a></td><td>".$row['type']."</td>
			</tr>
			";
	
		}
	}
		else {

			echo '
			<script language="javascript">
			alert("No record Found! You will be directed to home page.")
			window.location.href = "index.php"; 
			</script>

			';

		}
	echo "
	</table>
	</tbody>
	</div>
	";
	?>

<?=$pagination?>
</div>
</div>
</div>
<script src="js/jquery.js"></script>
<script>
function downloadcsv() {
    window.open("export.php");
}
</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
	
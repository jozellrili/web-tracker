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
                 <a class="navbar-brand topnav" href="#">
                    <img src="img/logo.gif" alt="" class="img-responsive">
                </a>

            </div>
           <!-- navigation  -->
            
        </div>
        <!-- /.container -->
       
    </nav>  
<div class="home-banner"></div>
 <div class="container content-section-a">
    <div class="row">
        <div class="container">
            <div class="col-md-offset-2">
    			
    			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                   <label class="control-label col-sm-1">URL:</label>
                    <div class="col-sm-7">          
                    <input type="text" name="url" id="url" class="form-control" placeholder="http://www.example.com">
                    </div>
                    <input type="submit" name="submit" class="btn btn-danger" value="Start Crawling">
                </form>
                <div class="form col-md-7">
                <h4>The URL's you submit for crawling are recorded.</h4>
                <p>See All Crawled URL's <a href="">here.</a></p>
           		</div>
            <!-- <div class="form col-md-7">
                <h4>The URL's you submit for crawling are recorded.</h4>
                <p>See All Crawled URL's <a href="">here.</a></p>
            </div> -->
            </div>
            	<?php
				include('db_connection.php');
				

				error_reporting(E_ALL);
				ini_set('display_errors', '1');

				if(isset($_POST['submit'])) {
					if (empty($_POST['url']))
					{
						echo '
						<script language="javascript">
						alert("Please input a URL")
						</script>'
						;
					}
					else {

					$c = array();
					$i = 0;

					$url = $_POST['url'];

						if ((substr($url,0,7) != "http://")) {
							$url = "http://".$url;
						}

					function get_links($url)
					{	
						global $c;
						$doc = new DOMDocument();
						libxml_use_internal_errors(true);
						$doc->loadHTMLFile($url);
						libxml_clear_errors();
						$base_url = parse_url($url, PHP_URL_HOST);
						
					// fetching all stylesheet
					foreach( $doc->getElementsByTagName('link') as $style){
					   
					    $href =  $style->getAttribute('href');

					       if (!in_array($href, $c)) {
							array_push($c, $href);
						 }					
					}

					// fetching all href
					foreach( $doc->getElementsByTagName('a') as $a){
					   
					    $href =  $a->getAttribute('href');
					 
						if (strpos($href, "#")) {
							$href = substr($href, 0, strpos($href, "#"));
						}
						if (substr($href,0,1) == ".") {
							$href = substr($href, 1);
						}
						if (substr($href,0,7) == "http://") {
							$href = $href;
						}
						else if (substr($href,0,8) == "https://") {
							$href = $href;
						}
						else if (substr($href,0,2) == "//") {
							$href = substr($href, 2);
						}
						else if (substr($href,0,1) == "#") {
							$href = $url;
						}
						else if (substr($href,0,7) == "mailto:") {
							$href = "[".$href."]";
						}
						else {
							if (substr($href, 0, 1) != "/") {
								$href = $base_url."/".$href;
							}
							else {
								$href = $base_url.$href;
								}
						}	

						if (substr($href, 0, 7) != "http://" && substr($href, 0, 8) != "https://" && substr($href, 0, 1) != "[") {
							if (substr($href, 0, 8) == "https://") {
								$href = "https://".$href;
							}
							else {
								$href = "http://".$href;
							}
						}
						if (!in_array($href, $c)) {
							array_push($c, $href);
						 }			   
					}
					// fetching all image
					foreach( $doc->getElementsByTagName('img') as $image){
					  
					    $href =  $image->getAttribute('src');
					  	if (!in_array($href, $c)) {
							array_push($c, $href);
						 }						
					}

					// fetching all script
					foreach( $doc->getElementsByTagName('script') as $scripts){
						
					    $href =  $scripts->getAttribute('src');
							if (substr($href,0,2) == "//") {
							$href = substr($href, 2);
						}
					     if (!in_array($href, $c)) {
							array_push($c, $href);
						 }									
					}
						
					}

					get_links($url);


					function get_domain($url) {


						$host = @parse_url($url, PHP_URL_HOST);

						if (substr($host, 0, 4) == "www.") {
					        $host = substr($host, 4);
						}

						$theHost = $host;
						return $host;
					}

					$theHost = get_domain($url);



					function content_type($url) {

						$ch = curl_init($url);

						curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_exec($ch);

						if(!curl_errno($ch))
							{
								$info = curl_getinfo($ch);
								return $info['content_type'];
								
							}

						curl_close($ch);

					}

					function classification($domain,$url) {
		
						if (preg_match("/\b$domain\b/i", $url, $match)) {
			  				//Safe URL
			  				$icon = "fa fa-check-square fa-lg";
						}
						else {
							//Potential Tracker!
							$icon = "fa fa-exclamation-triangle fa-lg";
						}


						return $icon;

					}

						echo "<table class = 'table table-striped'>";
						echo "<tbody>";
						echo "<tr>";
						echo "<th>#</th><th>DOMAIN NAME</th><th>CATEGORY</th><th>URL</th><th>STATUS</th><th>Existing in DB?</th>";
						echo "</tr>";
						foreach ($c as $page) {
						$i++;
						$theDomain = get_domain($page);
						$icon = classification($theHost, $page);
							if ($icon == "fa fa-check-square fa-lg") {
								$color = "green";
							}
							else {
								$color = "red";
							}
							
							$url_stat = classification($theHost, $page);
							
								if ((substr($page,0,7) == "http://")) {
									$page = substr($page, 7);
								} else if ((substr($page,0,8) == "https://")){
									$page = substr($page, 8);
									}

							$sql = "SELECT * FROM tracker_list WHERE url = '".$page."' ";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
							// output data of each row
									$a = "Existing in the database";
							} else {
								if ($url_stat == "Potential Tracker!") {
									$conn->query("INSERT INTO tracker_list (domain, url, type) VALUES ('".$theDomain."', '".$page."', 'TBD')");
									$a = "Added to the database!";
								}
								else {
									$a = "Do nothing";
								}
							}

						echo "<tr>";
						echo "<td >".$i."</td><td>".get_domain($url)."</td><td>"."null"."</td><td>".$page."</td><td>"."<label class ='".$icon."' style='color:".$color."'></label>";
						//echo "</td><td>".content_type($page);
						echo "</td><td>".$a;
						echo "</td>";

						echo "</tr>";
						}
						echo "</tbody>";
						echo "</table>";

					//isset child else	
					}
				//eof	
				}

				?>
        </div>  
    </div>     
</div>



<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
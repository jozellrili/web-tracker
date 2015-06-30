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
<div class="home-banner"></div>
 <div class="container content-section-a">
    <div class="row">
        <div class="container">
            <div class="col-md-offset-2">
    			
    			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                   <label class=" control-label col-sm-1">FILE:</label>
                    <div class="col-sm-7">          
                 <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file" >
                        Browse <input type="file" name="file" multiple>
                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
                   <a class="btn-link" href="index.php"><i><u>Basic Crawl</u></i></a>
                    </div>
                    <input type="submit" name="submit1" class="btn btn-danger" value="Start Crawling">
                </form>
               
                <div class="form col-md-7">
                <h4>The URL's you submit for crawling are recorded.</h4>
                <p>See All Crawled URL's <a href="">here.</a></p>
           		</div>

           	</div>
<?php
include('db_connection.php');

	if(isset($_POST['submit1'])) {
		$file = $_FILES["file"]["tmp_name"] ;

		$i = 0;
		$url = file($file, FILE_IGNORE_NEW_LINES);
		$c = array();

	function get_links($url)
	{	

		$doc = new DOMDocument();
		global $c ,$base;
		foreach ($url as $urls) {
			$doc->loadHTMLFile($urls);
			$base_url = parse_url($urls, PHP_URL_HOST);

			// fetching all stylesheet
			foreach( $doc->getElementsByTagName('link') as $style){

				$href =  $style->getAttribute('href');
				if (substr($href,0,2) == "//") {
					$href = substr($href, 2);

				}
				if (!in_array($base_url, $href, $c)) {
					array_push($c, $href);
					$base[] = $base_url;
					
				}
				
					
			}

			// fetching all href
			foreach($doc->getElementsByTagName('a') as $a){

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
					$base[] = $base_url;
					

				}
			
			}
			// // fetching all image
			foreach( $doc->getElementsByTagName('img') as $image){

				$href =  $image->getAttribute('src');
				if (substr($href,0,2) == "//") {
					$href = substr($href, 2);

				}
				if (!in_array($href, $c)) {
					array_push($c, $href);
					$base[] = $base_url;
					
				}
				
			}

			//fetching all script
			foreach( $doc->getElementsByTagName('script') as $scripts){

				$href =  $scripts->getAttribute('src');

				if (substr($href,0,2) == "//") {
					$href = substr($href, 2);

				}
				if (!in_array($href, $c)) {
					array_push($c, $href);
					$base[] = $base_url;
					
				}
					
				
			}

			
		}				

	}
	get_links($url);


	function classification($domain,$url) {

		if (preg_match("/\b$domain\b/i", $url, $match)) {
			$status = "Safe URL";
		}
		else {
			$status = "Potential Tracker!"; 
		}
		return $status;
	}

	function get_domain($url) {

			$pieces = parse_url($url);
		    $domain = isset($pieces['host']) ? $pieces['host'] : '';
			    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
			      $la = $regs['domain'];
			      return $la;
			    }
		    
		}

	function strposa($haystack, $needles=array()) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
     }


	// function content_type($url) {

	// 	$ch = curl_init($url);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_exec($ch);
	// 	/* Get the content type from CURL */
	// 	$content_type = curl_getinfo( $ch, CURLINFO_CONTENT_TYPE );
		 
	// 	 Get the MIME type and character set 
	// 	preg_match( '@([\w/+]+)(;\s+charset=(\S+))?@i', $content_type, $matches );
	// 	if (isset($matches[1])) {
	// 	    $mime = $matches[1];
	// 	}
	// 	else {
	// 		$mime = "others";
	// 	}
	// 	return $mime;

	// 	curl_close($ch);

	// }

	function get_content_type($url)
		{

        				// our list of mime types
		$mime_types = array(
			"pdf"=>"application/pdf"
			,"exe"=>"application/octet-stream"
			,"zip"=>"application/zip"
			,"docx"=>"application/msword"
			,"doc"=>"application/msword"
			,"xls"=>"application/vnd.ms-excel"
			,"ppt"=>"application/vnd.ms-powerpoint"
			,"gif"=>"image/gif"
			,"png"=>"image/png"
		    ,"ico"=>"image/ico"
		    ,"jpeg"=>"image/jpg"
		    ,"jpg"=>"image/jpg"
		    ,"mp3"=>"audio/mpeg"
		    ,"wav"=>"audio/x-wav"
		    ,"mpeg"=>"video/mpeg"
		    ,"mpg"=>"video/mpeg"
		    ,"mpe"=>"video/mpeg"
		    ,"mov"=>"video/quicktime"
		    ,"avi"=>"video/x-msvideo"
		    ,"3gp"=>"video/3gpp"
		    ,"css"=>"text/css"
		    ,"jsc"=>"application/javascript"
		    ,"js"=>"application/javascript"
		    ,"php"=>"text/html"
		    ,"htm"=>"text/html"
		    ,"html"=>"text/html"
		    ,"xml"=>"application/xml"
		         
		);
		$var = explode('.', $url);
		$extension = strtolower(end($var));
		if(isset($mime_types[$extension])){
		    return $mime_types[$extension];
		}
		else{
			return 'other';
		}
	}


	
	

			
echo "
<div class='container'>
<table class = 'table table-striped'>
<tbody>
<tr>
<th>#</th><th>REQUESTED PAGE(DOMAIN NAME)</th><th>TYPE</th><th>URL</th><th>STATUS</th>
</tr>
";
foreach (array_filter($c) as $index => $page) {
	
	$i++;
	//$type = content_type($page);
	$type = "";
	$theDomain = get_domain($page);
	
	if ((substr($page,0,7) == "http://")) {
		$page = substr($page, 7);
	} else if ((substr($page,0,8) == "https://")){
		$page = substr($page, 8);
	}


	$array  = array('tracker', 'stats', 'analytics', 'omniture', 'tracking', 'tags');

		if (strposa($page, $array) || ($match == "Potential Tracker!")) {
			//true
			$sql = "SELECT * FROM tracker_list WHERE url = '".$page."' ";
			$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					$conn->query("UPDATE tracker_list SET domain = '".$theDomain."', url = '".$page."', type = '".$type."'  WHERE url = '".$page."' ");

				} else {

					$conn->query("INSERT INTO tracker_list (domain, url, type) VALUES ('".$theDomain."', '".$page."', '".$type."')");
				 }

			$icon = "fa fa-exclamation-triangle fa-lg";
			$color = "red";
		    
		} else {
			//false
		    $icon = "fa fa-check-square fa-lg";
			$color = "green";
		}
	
	echo "
	<tr>
	<td >".$i."</td><td>".$base[$index]."</td><td>".get_content_type($page)."</td><td>".$page."</td><td>"."<label class ='".$icon."' style='color:".$color."'></label></td>

	</tr>";

}
	echo "
	</tbody>
	</table>
	</div>
	";

}

?>
</div>  
</div>     
</div>



<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- script browse button -->
<script type="text/javascript">
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>


</body>
</html>


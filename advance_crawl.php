<?php
include("header.php");
?>

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
                 <a class="navbar-brand topnav" href="index.php">
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
<div class="home-banner"></div>
 <div class="container content-section-a">
    <div class="row">
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
                   <input type="submit" name="submit1" class="btn btn-danger" onclick="waitingDialog.show('Crawling...');(function () {waitingDialog.hide();}, 2000);" value="Start Crawling">
                </form>
               
                <div class="form col-md-7">
                <h4>The URL's you submit for crawling are recorded.</h4>
                
           		</div>

           	</div>
				<?php
				ini_set('display_errors', 1); 
				error_reporting(E_ALL);
				
				set_time_limit(0);
				include('db_connection.php');

					if(isset($_POST['submit1'])) {
						$file = $_FILES["file"]["tmp_name"] ;
						$i = 0;
						$url = file($file, FILE_IGNORE_NEW_LINES| FILE_SKIP_EMPTY_LINES);
						$c = array();
						$l = array();
						

					function urlLooper($urls) {

						global $l, $c, $base;
						$doc = new DOMDocument();
						foreach ($urls as $url) {
							if (substr($url,0,7) != "http://") {
								if (substr($url,0,4) != "www.") {
									$url = "www.".$url;
								}
								if (substr($url,0,4) == "www."){
									$url = "http://".$url;
								}

							}
							if (substr($url, 0,11) != "http://www."){
								$url = str_replace("http://", "http://www.", $url);
										
							}
							else {
								$url = $url ;
							}
							

									
							$doc->loadHTMLFile($url);
							$base_url = parse_url($url, PHP_URL_HOST);

						foreach( $doc->getElementsByTagName('link') as $style){

							$href =  $style->getAttribute('href');
							if (strpos($href, "#")) {
								$href = substr($href, 0, strpos($href, "#"));
								}
								if (strpos($href, "?")) {
									$href = substr($href, 0, strpos($href, "?"));
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
							if (!in_array($base_url, $href, $c)) {
								array_push($c, $href);

								if (substr($base_url, 0, 4) == "www.") {
								    $base[] = substr($base_url, 4);
								}
								
							}
								
									
						}

						//fetching all the images
						foreach( $doc->getElementsByTagName('img') as $image){

								$href =  $image->getAttribute('src');
								if (strpos($href, "#")) {
								$href = substr($href, 0, strpos($href, "#"));
								}
								if (strpos($href, "?")) {
									$href = substr($href, 0, strpos($href, "?"));
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

									if (substr($base_url, 0, 4) == "www.") {
									    $base[] = substr($base_url, 4);
									}
									
								}
								
							}

						// fetching all href
						foreach( $doc->getElementsByTagName('a') as $a){
						   
						    $href =  $a->getAttribute('href');
						 
							if (strpos($href, "#")) {
								$href = substr($href, 0, strpos($href, "#"));
							}
							if (strpos($href, "?")) {
								$href = substr($href, 0, strpos($href, "?"));
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

									if (substr($base_url, 0, 4) == "www.") {
									    $base[] = substr($base_url, 4);
									}	
								}

							if (preg_match("/\b$base_url\b/i", $href, $match)) {
				  				array_push($l, $href);
							}
			   
						}
					}
				}
				urlLooper($url);


					function get_links($url) {	

						global $c, $base;
						$doc = new DOMDocument();
					    //foreach ($url as $urls) {
							$doc->loadHTMLFile($url);
							$base_url = parse_url($url, PHP_URL_HOST);


							//fetching all script
							foreach( $doc->getElementsByTagName('script') as $scripts){

								$href =  $scripts->getAttribute('src');

								if (strpos($href, "#")) {
								$href = substr($href, 0, strpos($href, "#"));
								}
								if (strpos($href, "?")) {
									$href = substr($href, 0, strpos($href, "?"));
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

									if (substr($base_url, 0, 4) == "www.") {
									    $base[] = substr($base_url, 4);
									}			
								}					
							}
							//}
					}
					//get_links($url);


					
					function get_domain($url) {

							$pieces = parse_url($url);
						    $domain = isset($pieces['host']) ? $pieces['host'] : '';
							    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
							      $la = $regs['domain'];
							      return $la;
							    }		    
					}
						$theHost = get_domain($url);



					function classification($domain,$url) {

						if (preg_match("/\b$domain\b/i", $url, $match)) {
							$status = "Safe URL";
						}
						else {
							$status = "Potential Tracker!"; 
						}
						return $status;
					}


					

					function get_content_type($url){
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



					function strposa($haystack, $needles=array()) {
					$chr = array();
					    foreach($needles as $needle) {
					        $res = stripos($haystack, $needle);
					        if ($res !== false)
					        {
					            $chr[$needle] = $res;
					            $string_exist = $needle; break;
					        }
					    }
					    if(empty($chr)) return false; 
					    return $string_exist;
					}


				$links = array_unique($l);
			    foreach (array_filter($links) as $link) {
			     	get_links($link);
			    }
							
				echo "
				<div class='container'>
				<div class='row'>
				<table class ='table table-striped'>
				<tbody>
				<tr>
				<th>#</th><th>REQUESTED PAGE(DOMAIN NAME)</th><th>TYPE</th><th>URL</th><th>STATUS</th>
				</tr>
				";

				$query= "SELECT * FROM keywords";
					$result = $conn->query($query);

					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$keys[] = $row['keyword'];
						}
					}

				$collected = array_unique($c);
				foreach (array_filter($collected) as $index => $page) {
				$i++;
				$theDomain = get_domain($page);
				$multipleDomain = $base[$index];
				$match = classification($multipleDomain,$page);
				$type = get_content_type($page);
				$category = strposa($page, $keys);


				//strip http/https before inserting into the database
				if ((substr($page,0,7) == "http://")) {
					$page = substr($page, 7);
				} if ((substr($page,0,8) == "https://")){
					$page = substr($page, 8);
				} if ($theDomain =='') {
					$pattern = '/\w+\..{2,3}(?:\..{2,3})?(?:$|(?=\/))/i';
					if (preg_match($pattern, $page, $matches) === 1) {
					    $theDomain = $matches[0];
					}
				}

				//|| ($match == "Potential Tracker!")
				if (strposa($page, $keys)) {

					$query = "SELECT id, category FROM keywords WHERE keyword = '".$category."' ";
					$result = $conn->query($query);

						if($result->num_rows > 0) {

							$row = $result->fetch_assoc();
							$cat[0] = $row['id'];
							$cat[1] = $row['category'];

						}

					$sql = "SELECT * FROM tracker_list WHERE url = '".$page."' ";
					$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							$conn->query("UPDATE tracker_list SET requested_page = '".$multipleDomain."', domain = '".$theDomain."', url = '".$page."', type = '".$type."', category = '".$cat[1]."'  WHERE url = '".$page."' ");
						} else {

							$conn->query("INSERT INTO tracker_test (requested_page, domain, url, type, category) VALUES ('".$multipleDomain."', '".$theDomain."', '".$page."', '".$type."', '".$cat[1]."' )");
						}
					$icon = "fa fa-exclamation-triangle fa-lg";
					$color = "red";

				} else {

					$icon = "fa fa-check-square fa-lg";
					$color = "green";
				}
				
					
					echo "
					<tr>
					<td>".$i."</td><td>".$base[$index]."</td><td>".$type."</td><td class='word-break'>".$page."</td><td>"."<label class ='".$icon."' style='color:".$color."'></label>"."</td>
					</tr>";

				}

				// if (empty($collected)) {
				// 		echo '
				// 			<script language="javascript">
				// 			alert("No Links Catched!\\nMake sure you input correct URL")
				// 			</script>'
				// 		;
				// 		header("Refresh:0");	
				// }
					echo "
					</tbody>
					</table>
					</div>
					</div>
					";
				}

				?>

</div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/loading.js"></script>
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

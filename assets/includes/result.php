<?php 


define ('result_search', 'RESULTS | FINDER');
require ('config.php');

$db = mysqli_connect('localhost', 'root', '', 'finder');
    
if(isset($_GET['search'])){
	//to get the value of the searched query
	$get_value = $_GET['user_query'];
	// if the value is empty
	if($get_value==''){
	
		echo "<center><b>Please go back, and write something in the search box!</b></center>";
		exit();
	}
     
// the code below will get search result from not just site_kewords but from also site_title, site_desc and whatever you specify. just study and understand    
	$result_query = "SELECT * FROM sites WHERE site_keywords LIKE '%$get_value%' OR site_title LIKE '%$get_value%' OR site_desc LIKE '%$get_value%' ";
	$run_result = mysqli_query($db,$result_query);
    
    
    // this is the code for pagintion
    
   
  




?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title><?php echo result_search; ?></title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="team" content="">
     <meta name="author" content="opiaaustin">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" type="text/css" href="/../finder/assets/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="/../finder/assets/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="/../finder/assets/css/vegas.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" type="text/css" href="/../finder/assets/css/style.css">
     <!-- MEDIA QUERY -->
     <link rel="stylesheet" type="text/css" href="/../finder/assets/css/mediaquries.css">
     
 
</head>
<body>
    
      
    <!-- RESULT -->
            
          <div class="container">
              <div class="row">
                  <div class="col-lg-10 col-md-10 col-sm-10">
              <div id="top"></div>
              <header class="line">
                  <div class="result-form">
                <form action="result.php" method="get" class="form-result">
                 <img  class="img-responsive" alt="responsive-image" src="/../finder/assets/image/logomain (1) - Copy.png" id="logo_Redx" alt="finder-logo">
                  <input type="text" name="user_query" class="form-control" placeholder="Search the web" value="<?=$get_value;?>" required="">
                  <button type="submit" name="search" class="form-control"><i class="fa fa-search"></i></button>
                </form>
                      <!-- top nav links -->
                        <nav class="" id="Top-Nav">
                         <a class="p-2 text-muted" href="result.php?user_query=<?=$get_value;?>&search=">All</a>
                         <a class="p-2 text-muted" href="img.php?result_img=<?=$get_value;?>">Images</a>
                        </nav>
                </div>
              </header> 
          
          <?php
	               if(mysqli_num_rows($run_result)<1){
	                 echo "<center><b>Oops! sorry, nothing was found!</b></center>";
	                  exit();
	                }
	
	               while($row_result=mysqli_fetch_array($run_result)){
		
		           $site_title=$row_result['site_title'];
		           $site_link=$row_result['site_link'];
		           $site_desc=$row_result['site_desc'];
		           $site_image=$row_result['site_image'];
	
	              echo "<div class=''>
                         <div class='row mb-2'>
                          <div class=''>
                            <div class='card flex-md-row mb-4 box-shadow h-md-250'>
                            <div class='card-body d-flex flex-column align-items-start'>
                            <strong class='d-inline-block mb-2 text-primary'><h4>$site_title</h4></strong>
                             <h5 class='mb-0'>
                             <a class='text-dark' href='$site_link'>$site_link</a>
                             </h5>
                        <div class='mb-1 text-muted'>$site_desc</div>
                       <p class='card-text mb-auto'>This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                      <a href='#'>Continue reading</a>
                     </div>
                    </div>
                  </div>
                </div>
             </div>
        ";

		}  
      }
     ?>
               
              </div>
  
    <div class="col-lg-2 col-md-2 col-sm-2" id="M_Top">
    <!-- suggested keywords-->
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark">@username</strong>
            Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
          </p>
        </div>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1" alt="" class="mr-2 rounded">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark">@username</strong>
            Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
          </p>
        </div>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=6f42c1&fg=6f42c1&size=1" alt="" class="mr-2 rounded">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark">@username</strong>
            Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
          </p>
        </div>
        <small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>
      </div>
    <!-- end of suggested keywords -->
    </div>          
                  
    </div>
           <!-- finder pagination -->
    <nav>
        <?php require_once('pagination.php'); ?>
        <ul class="pagination">
  <?php if($curpage != $startpage){ ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>
    <?php if($curpage >= 2){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
    <?php if($curpage != $endpage){ ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
    </li>
    <?php } ?>
  </ul>
               
    </nav>
        
           <!-- end of finder pagination -->     
    </div>
    </body>
    <?php include 'footer.php'; ?>
    
</html>

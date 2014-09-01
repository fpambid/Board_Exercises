<?php

    function pagination($row_length, $pagenum, array $url = NULL) {

	$pagination = array();

	$page_rows = 10;

    $last = ceil($row_length/$page_rows); 

    if(isset($pagenum)){
    	$pagenum = 1; 
    }

    if(isset($_GET['pn'])){ 
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']); 
    }

    if($last < 1){ 
    	$last = 1; 
    } 

    if ($pagenum < 1){ 
    	$pagenum = 1; 
    } 
    else if ($pagenum > $last){
        $pagenum = $last; 
    }

    $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

    $page_url =& $url['pn'];
    $pageCtrls = ''; 

    if($last != 1){ 
    	if ($pagenum > 1){ 
    		$page_url = $pagenum - 1; 
    		$pageCtrls .= "<a href='". url('', $url) ."'>Previous</a> &nbsp; &nbsp;"; 

 		    for($i = $pagenum-4; $i < $pagenum; $i++){
	    		if($i > 0){ 
	    			$pageCtrls .= '<a href="'. url('', $url) .'">'.$i.'</a> &nbsp; '; 
        		}
			}
		}

		$pageCtrls .= ''.$pagenum.' &nbsp; ';

	    for($i = $pagenum+1; $i <= $last; $i++){ 
		    $page_url = $i;
		    $pageCtrls .= "<a href='".url('', $url)."')'.$i.'</a> &nbsp;"; 
		    if($i >= $pagenum+4){ 
			    break; 
		    } 
	    }

	    if ($pagenum != $last) {
		    $page_url = $pagenum + 1; 
		    $pageCtrls .= "&nbsp; &nbsp; <a href='".url('', $url)."'>Next</a>";
	    } 
    } 

$pagination['pagenum'] = $pagenum;
$pagination['max'] = $limit;
$pagination['control'] = $pageCtrls;
$pagination['last_page'] = $last;
   
return $pagination;
}
<?php
// class pagination for Outlet
class PaginationOutlet{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=outlets.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=outlets.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=outlets.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=outlets.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=outlets.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=outlets.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=outlets.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for User
class PaginationUser{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=users.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=users.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=users.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=users.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=users.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=users.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=users.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Categories
class PaginationCategory{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=categories.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=categories.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=categories.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=categories.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=categories.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=categories.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=categories.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Brands
class PaginationBrand{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=brands.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=brands.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=brands.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=brands.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=brands.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=brands.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=brands.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Suppliers
class PaginationSupplier{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=suppliers.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=suppliers.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=suppliers.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=suppliers.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=suppliers.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=suppliers.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=suppliers.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Members
class PaginationMember{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=members.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=members.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=members.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=members.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=members.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=members.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=members.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Product
class PaginationProduct{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=products.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=products.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=products.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=products.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=products.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=products.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=products.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Pending transaction
class PaginationTrxPending{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=sales_transactions.php?module=trx&act=pending&page=1><< First</a></span> 
		                    <span class=prevnext><a href=sales_transactions.php?module=trx&act=pending&page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=sales_transactions.php?module=trx&act=pending&page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=sales_transactions.php?module=trx&act=pending&page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=sales_transactions.php?module=trx&act=pending&page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=sales_transactions.php?module=trx&act=pending&page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=sales_transactions.php?module=trx&act=pending&page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Account
class PaginationAccount{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=accounts.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=accounts.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=accounts.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=accounts.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=accounts.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=accounts.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=accounts.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}

// class pagination for Mechanic
class PaginationMechanic{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<span class=prevnext><a href=mechanics.php?page=1><< First</a></span> 
		                    <span class=prevnext><a href=mechanics.php?page=$prev>< Prev</a></span> ";
		}
		else{ 
			$link_page .= "<span class=disabled><< First</span> <span class=disabled>< Prev</span>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<a href=mechanics.php?page=$i>$i</a>";
		}
		$numeric .= " <span class=current>$activePage</span> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<a href=mechanics.php?page=$i>$i</a>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " ... <a href=mechanics.php?page=$amountPage>$amountPage</a> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <span class=prevnext><a href=mechanics.php?page=$next>Next ></a></span> 
		                     <span class=prevnext><a href=mechanics.php?page=$amountPage>Last >></a></span> ";
		}
		else{
			$link_page .= "<span class=disabled>Next ></span><span class=disabled>Last >></span>";
		}
		
		return $link_page;
	}
}
?>
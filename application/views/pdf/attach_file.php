<div class="container">
	<h4>See Tha data You Saved</h4>
	<?php
			$data['table']= '<div class="table-responsive"><table border="1" align="center">';
			$lable = '';
			for ($i=1; $i <= $row ; $i++) {
				if($i==1){ $lable = "Name";}
				if($i==2){ $lable = "Email";}
				if($i==3){ $lable = "Phone";}
				if($i==4){ $lable = "City";}
				if($i==5){ $lable = "State";}
				if($i==6){ $lable = "Country";}
				if($i==7){ $lable = "Age";}
				if($i==8){ $lable = "Gender";}
				$data['table'] .= '<tr><th>'.$lable.':</th>';
				
				foreach ($getInfo as $key => $value) {
					
				 	$data['table'] .= '<td>'.$value->$lable.'</td>';
				 
				 }
				$data['table'] .= '</tr>';

		}
		$data['table'] .='</table></div>';
		print_r($data['table']) ;
	?>
		
		
</div>

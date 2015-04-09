<script type="text/javascript">
     function run(){
          document.getElementById('form1').submit();
     }
</script>

<div id="search">
    
    
    <h3>Search Landscape Designers</h3>
    <p>Choose your state, then city.</p>

        
       
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">

    
    <select name='state' id='state' onchange="run()">
   <option value="">Select State</option>
     <?php foreach($des as $de) :
           $state = $de['state']; 
     if (isset($_POST['state']))
    { $thestate = $_POST['state'];
     $yes = 'selected';  
     }
?>
          
            
            <option value="<?php echo $de['state']; ?>" <?php if ((isset($_POST['state'])) && ($thestate == $state)) { echo $yes; } ?>><?php echo $de['state']; ?></option>
  
   
    <?php endforeach; ?>
    
    </select>
    
     <select name='city' id='city' onchange="run()">
   <option value="">Select City</option>
     <?php 
     
     
     if (isset($_POST['state']))
    {
        $poststate = $_POST['state'];
         foreach($citres as $citress) :
            if (isset($_POST['city']))
            { $thecity = $_POST['city'];
             $yes = 'selected';  
             }
        
         $city = $citress['city'];
         $state = $citress['state'];
         
         if ($state == $poststate) {
?>

            
            <option value="<?php echo $citress['city']; ?>" <?php if ((isset($_POST['city'])) && ($thecity == $city)) { echo $yes; } ?>><?php echo $citress['city']; ?></option>
  
   
    <?php } endforeach; } ?>
    
    </select>
    
</form>
    
     <?php  
     
     if ((isset($_POST['city'])) && (($_POST['city']) != '') )
    { ?>
         
     <div id="userlistdiv">
	<table id="userstable">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Experience</th>
			<th>Price</th>
			<th>City</th>
			<th>State</th>
		</tr>
		    
       <?php  
     
        $poststate = $_POST['state'];
        $postcity = $_POST['city'];
         foreach($desres as $desress) :
    
        
         $city = $desress['city'];
         $state = $desress['state'];
         
         if (($state == $poststate) && ($city == $postcity)) {
        ?>
                        <tr>
				<td><?php echo $desress['firstname']; ?></td>
                                <td><?php echo $desress['lastname']; ?></td>
                                <td><?php echo $desress['experience']; ?></td>
                                <td><?php echo $desress['price']; ?></td>
                                <td><?php echo $desress['city']; ?></td>
                                <td><?php echo $desress['state']; ?></td>
				
			</tr>

    <?php } endforeach;} ?>
	</table>
</div>
  
   
   
     
     
     
     
     
     
     
     
    
    
    
    
    
</div>
  
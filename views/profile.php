<?php
	// $user set by the controller.
	$message = isset($message) ? $message : null;
?>
<div id="message">
	<p>
	<?php 
        
        echo $message; 
        ?>
            
	</p>
</div>

<div id="infoupdate">
	<form id="infoupdateform" method="POST" action="/?action=profile">
		<fieldset>
                    <legend>Update Information</legend>
                    <ul>   
                        <li><label>First Name: </label><input type="text" name="firstname" id="firstname" value="<?php echo $user->firstname; ?>" required /><br /></li>
			<li><label>Last Name: </label><input type="text" name="lastname" id="lastname" value="<?php echo $user->lastname; ?>" required /><br /></li>
			<li><label>Email Address: </label><input type="email" name="emailreg" id="email" value="<?php echo $user->emailreg; ?>" required /><br /></li>
                        <li><label>City: </label><input type="text" name="city" id="address" value="<?php echo $user->city; ?>" placeholder="City" /></li>
                    </ul>
                        <select name="state" class="valid">
                                <option value="Choose a State">Choose a State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                        </select> <br/>	
                    <ul>
                        <li><label>Years Experience: </label><input type="number" name="experience" id="experience" value="<?php echo $user->experience; ?>" required='required'/><br /></li>
                        <li><label>Price for Design Work: </label><input type="text" name="price" id="price" value="<?php echo $user->price; ?>" required='required' /><br /><br /></li>
                        <li><input type="submit" name="Submit" value="Submit" /></li>
                    </ul>
		</fieldset>
	</form>
	<form id="passwordupdateform" method="POST" action="/?action=updatepassword">
		<fieldset>
			<legend>Update your password</legend>
                        <ul>
                        <li><label>Current Password: </label><input type="password" name="currentpassword" id="currentpassword" /><br /></li>
			<li><label>New Password: </label><input type="password" name="newpassword" id="newpassword" /><br /></li>
                        <li><label>Repeat New Password: </label><input type="password" name="repeatpassword" id="repeatpassword" /><br /><br /></li>
                        <li><input type="submit" name="Submit" value="Submit" /></li>
                        </ul>
		</fieldset>
	</form>
</div>
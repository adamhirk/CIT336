<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="/js/login.js" ></script>
        <?php
    
       //if ($message) {
		//echo $message;
	//} 
        ?>

<div id="loginregister">
	<form action='/?action=registersubmit' method="POST" id="registerform">
            
                <input type="hidden" name="registerform" />
		<input type="hidden" name="actiontype" id="actiontype" value="" />
		<fieldset class="form-horizontal">
			<legend>Register Here</legend>
                    <ul>    
                        <li><label>First Name: </label><input type="text" name="firstname" id="firstname" required='required' /><br /></li>
			<li><label>Last Name: </label><input type="text" name="lastname" id="lastname" required='required'/><br /></li>
			<li><label>Email Address:</label><input type="email" name="emailreg" id="emailreg" required='required'/><br /></li>
                        <li><label>Password: </label><input type="password" name="passwordreg1" id="passwordreg1" required='required'/><br /></li>
			<li><label>Verify Password: </label><input type="password" name="passwordreg2" id="passwordreg2" required='required'/><br /></li>
                        <li><label>City:</label><input type="text" name="city" id="address" placeholder="City" /></li>
                    </ul>    
                        <select name="state">
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
                        </select>
                        <ul>        
                        <li><label>Years Experience:</label><input type="number" name="experience" id="experience" required='required'/><br /></li>
                        <li><label>Price for Design Work:</label><input type="text" name="price" id="price" required='required' /><br /><br /></li>
			<li><button name="register" id="buttonRegister">Register</button>
                    </ul>    
		</fieldset>
	</form>
	
	<br /><br />
		
	<form action='/?action=loginsubmit' method="POST" id="loginform">
                <input type="hidden" name="loginform" />
		<fieldset>
			<legend>Login Here</legend>
                        <ul>
			<li><label>Email Address: </label><input type="text" name="emailreg" id="emaillogin" /><br /></li>
			<li><label>Password: </label><input type="password" name="passwordreg1" id="passwordlogin" /><br /></li>
                        <li><button name="login" id="buttonLogin">Login</button></li>
                        </ul>
		</fieldset>
	</form>
</div>
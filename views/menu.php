<h3>Menu:</h3><br />
<ul>
	<li><a href="/?action=profile">Update Profile</a></li>
        <li><a href='/?action=deleteme'>Delete  My Account</a></li>
</ul>


<?php if(LoggedInUserIsAdmin()) : ?>

<h3>Admin Items: </h3> <br />
	<ul>
		<li><a href="/?action=editusers">Edit Users</a></li>
	</ul>

<?php endif; ?>
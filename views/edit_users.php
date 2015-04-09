<script src="/js/editusers.js" ></script>
	
<div id="userlistdiv">
	<table id="userstable">
		<tr>
			<th>Email Address</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Role</th>
			<th>Delete</th>
			<th>Change Role</th>
		</tr>
		
		<?php foreach ($users as $user) :
			$roleName = 'User';
			$changeRole = 'Admin';
			
			if ($user->role_id == ROLE_ID_ADMIN)
			{
				$roleName = 'Admin';
				$changeRole = 'User';
			}
			?>
			
			<tr>
				<td><?php echo $user->emailreg; ?></td>
				<td><?php echo $user->firstname; ?></td>
				<td><?php echo $user->lastname; ?></td>
				<td><?php echo $roleName; ?></td>
				<td><button onclick="DeleteUser(<?php echo $user->designer_id; ?>)">Delete</button></td>
				<td><button onclick="ChangeUserRole(<?php echo $user->designer_id; ?>,'<?php echo $changeRole; ?>');">Make <?php echo $changeRole; ?></button></td>
			</tr>

		<?php endforeach; ?>
	</table>
</div>
// Function used to confirm a role change.
// id - the User Id to change
// role - the role to change to.
function ChangeUserRole(designer_id, role_id) {
	var confirmed = confirm("Change the user's role to: " + role_id);
	
	if (confirmed) {
		// Again, this could be done through AJAX.
		window.location = '/?action=changerole&designer_id=' + designer_id + '&role_id=' + role_id;
	}
}

// Function used to confirm user deletion.
// id - the id of the user to remove.
function DeleteUser(designer_id) {
	var confirmed = confirm("Are you sure you want to remove this user?");
	
	if (confirmed) {
		// We could make an AJAX call here. That goes a little beyond what is expected in CIT 336.
		// Instead, let's redirect them through some other actions.
		window.location = '/?action=deleteuser&designer_id=' + designer_id;
	}	
}
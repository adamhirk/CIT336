<?php

function GetStates()
{
	$query = "SELECT * FROM designers GROUP BY state";
	return DbSelect($query);
}

function GetCity()
{
	$query = "SELECT * FROM designers GROUP BY city";
	return DbSelect($query);
}

function GetDes()
{
	$query = "SELECT * FROM designers ORDER BY firstname ASC";
	return DbSelect($query);
}


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form>
	<input type="text" name="name" value="" placeholder="name" />
    <button type="submit">Add</button>
</form>
<form>
	<input type="text" name="name" value="" placeholder="name" />
    <select name="cat">
    	<option value=""></option>
    </select>
    <button type="submit">Add</button>
</form>
<form>
	<input type="text" name="name" value="" placeholder="name" />
    <button type="submit">Add</button>
</form>
<?php
	$x=fopen("css/test.txt","w");
	fwrite($x,"Helo Usman");
	fclose($x);
?>
</body>
</html>
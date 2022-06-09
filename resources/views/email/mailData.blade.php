<!DOCTYPE html>
<html>
<head>
	<title>mail sending</title>
</head>
<body>
	@if(isset($name))
	<h3>Name :  <span>{{$name}}</span></h3> 
	<h3>Mobile Number :  <span>{{$mobile_no}}</span></h3> 
	<h3>Email Address :  <span>{{$email}}</span></h3> 
	@endif
	
	<h4>{{$message1}}</h4>
</body>
</html>
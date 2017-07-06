<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">	
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<title>SelectWord 1</title>
</head>
<body>
	<div class="container">
	<div class="row">


 <form role="form1"  method="post" action="SelectWord2.php" enctype="multipart/form-data" >
    <div class="form-group">
    <label for="txtName">Filename : </label> <input type="textbox" name="txtName"><br>
      <label for="filUpload">File : </label> <input type="file" name="filUpload">
      
      <br>
      <label for="formGender">Type : </label> 

<select name="formGender">
  <option value="">Select...</option>
   <option value="1">จดหมาย</option>
  <option value="2">บันทึกข้อความ</option>
  <option value="3">Letter</option>
  <option value="4">Memo</option>

</select>
     
    </div>
    <button type="btnSubmit" value="Submit" class="btn btn-default">Submit</button>
  </form>





<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


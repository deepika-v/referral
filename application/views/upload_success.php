<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<?php print_r($upload_data);?>
<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>

</body>
</html>
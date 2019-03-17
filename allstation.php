<?php
include "../pdo.php";
$text = "%".$_POST['text']."%";

  if(!isset($_POST['text'])){$text="толмачево";}
  else{}
  
	$stmt = $pdo->prepare("SELECT name FROM rzd WHERE name LIKE(?)");
	$stmt->execute(array($text));
	$row_count = $stmt->rowCount();
	$array = $stmt->fetchall();
	if($row_count!=0)  
	{
		$x=0; $list='';
		while($x<$row_count)
		{
			$name = $array[$x]['name'];
			$list[] = $name;
			$x=$x+1;
		}
		
		echo json_encode($list);
	}
	else
	{
		echo "0";
	}

?>
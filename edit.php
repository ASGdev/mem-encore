<?php
//var_dump($_REQUEST);
$dataOffset = 3;
$fileGiven = false;
$fileUri = "";
	$user_type = "editor";
	if(isset($_GET['file'])){
		$fileUri = $_GET['file'];
		$fileGiven = true;
	}
	else if(isset($_REQUEST['file'])) {
		$fileUri = $_REQUEST['file'];
		$fileGiven = true;
	}


	if(isset($_REQUEST['do'])){
		if($_REQUEST['do'] == "save"){
			$data = json_decode(file_get_contents($fileUri));
			$qIndex = $aIndex = 0;
			foreach ($data->questions as &$obj) {
				if($qIndex == (int)$_REQUEST['qIndex']){
					$obj->question = $_REQUEST["question"];
					foreach ($obj->answers as &$ans) {
						$ans = $_REQUEST[$aIndex];
						$aIndex++;
					}
				}
			$qIndex++;
			}
			file_put_contents($fileUri, json_encode($data));
		
		}
	}

	
	
	if($fileGiven){
		$data = json_decode(file_get_contents($fileUri));
		// check if file is editable
		if($data->infos->editable){
			if($user_type == "editor"){
				?>
					<h2>Modify informations</h2>
					<form method="post" action="index.php" enctype="multipart/form-data"><div style="width:100%;overflow: auto;"><div style="float:left">
						<input type="text" name="action" value="edit" hidden><input type="text" name="do" value="save" hidden><input type="text" name="file" value="<?php echo $fileUri ?>" hidden> 
						Title : <input type="text" name="title" value="<?php echo $data->infos->title ?>" /><br />
						Author : <input type="text" name="author" value="<?php echo $data->infos->author ?>" /><br />
						</div>
						 <div style="float:left;margin-left: 10%;"><input type="submit" value="Save informations"></div></div></form>
					<h2>Modify questions</h2>
					<?php
						$index = 0;					
						foreach ($data->questions as $obj) {
							$answIndex = 0;
							echo '<hr><form method="post" action="index.php" enctype="multipart/form-data"><div style="width:100%;overflow: auto;"><div style="float:left">';
							echo '<input type="text" name="action" value="edit" hidden><input type="text" name="do" value="save" hidden><input type="text" name="file" value="'.$fileUri.'" hidden><input type="number" name="qIndex" value="'.$index.'" hidden>'; 
							echo 'Question : <input type="text" name="question" value="'.$obj->question.'" /><br /><br />';
							foreach ($obj->answers as $ans) {
						   		echo 'Answer : <input type="text" name="'.$answIndex.'" value="'.$ans.'" /><br />';
						   		$answIndex++;
						    }
						    echo '</div>';
						    echo '<div style="float:left;margin-left: 10%;"><input type="submit" value="Save"></div></div></form>';   
							$index++;
						}
					?>
				<?php
			}
			else {
				echo "Error : you don't have right to edit this file.";
			}
		}
		else {
			echo "Error : edition of this file is forbidden.";
		}
	}
	else {
		echo "Error : no file given.";
	}
?>
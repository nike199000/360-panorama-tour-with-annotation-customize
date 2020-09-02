<?php
define('IMAGEPATH', 'images/room/');

if(isset($_GET['param'])){
	switch($_GET['param']){
		case "image":
			foreach(glob(IMAGEPATH.'*') as $filename){
			    $imag[] =  basename($filename);
			}
			echo json_encode($imag);

		break;
		case "upload":
            $uploadedFile = ''; 
            if(!empty($_FILES["file"]["name"])){
                $fileName = basename($_FILES["file"]["name"]); 
                $targetFilePath = IMAGEPATH . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            }
            
            if($uploadStatus != 0){
	            echo json_encode('{message:"success",code:200}'); 
            }
		break;
		case "remove":
            $uploadedFile = ''; 
            $fileName = $_GET['filename'];
            $targetFilePath = IMAGEPATH . $fileName;
            if (is_file($targetFilePath)){
				unlink($targetFilePath);
			}
            
            if($uploadStatus != 0){
	            echo json_encode('{message:"success",code:200}'); 
            }
		break;
		default:
			echo 'not valid';
		break;
	}
}else{
	echo 'huhuy';
}
?>
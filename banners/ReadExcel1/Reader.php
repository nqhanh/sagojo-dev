<?php
    
    if(isset($_POST['tag']) && $_POST['tag'] != '')
    {
        
        require_once("PHPExcel/IOFactory.php");
        require_once("PHPExcel.php");
        
        $tag=$_POST['tag'];
        $birthday=$_POST['birthday'];
        
        
        
        if($tag == 'excel')
        {
            $excel1 = PHPExcel_IOFactory::createReader('Excel2007');
            $excel1 = $excel1->load('birth102b_opens.xlsx');
            $excel1->setActiveSheetIndex(1);
            $excel1->getActiveSheet()->setCellValue('K2', $birthday);
            
            $response["success"] = 1;
			$response["msg"] = $excel1->getActiveSheet()->getCell('C22')->getFormattedValue();

            echo json_encode($response);
        }
        else if ($tag == 'tomorrow')
        {
            
            $excel1 = PHPExcel_IOFactory::createReader('Excel2007');
            $excel1 = $excel1->load('birth102b.xlsx');
            $excel1->setActiveSheetIndex(1);
            
            $excel1->getActiveSheet()->setCellValue('K2', $birthday);
            
            $response["success"] = 1;
			$response["msg"] = $excel1->getActiveSheet()->getCell('C22')->getFormattedValue();
            
            echo json_encode($response);
        }
        else if ($tag == 'ChuaBiet')
        {
            $string = file_get_contents("ChuaBiet.json");
            $json_a = json_decode($string, true);
            echo json_encode ($json_a);
        }
        else if ($tag == 'BiMat')
        {
            $string = file_get_contents("BiMat.json");
            $json_a = json_decode($string, true);
            echo json_encode ($json_a);
        }
        else if ($tag == 'XepHang')
        {
            $string = file_get_contents("XepHang.json");
            $json_a = json_decode($string, true);
            echo json_encode ($json_a);
        }
        else if ($tag == 'Compatibility')
        {
            $string = file_get_contents("Compatibility.json");
            $json_a = json_decode($string, true);
            echo json_encode ($json_a);
        }
        else
        {
            echo "Invalid Request";
        }
    }
    else
    {
        echo "Access Denide";
    }
?>
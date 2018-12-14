<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

function update_database($fileName,$time)
{
        //header("Content-Type: text/html;charset=utf-8");
        ini_set('date.timezone','Asia/Shanghai');
        require_once './PHPExcel/Classes/PHPExcel.php';
        require_once './PHPExcel/Classes/PHPExcel/IOFactory.php';
        require_once './PHPExcel/Classes/PHPExcel/Reader/Excel5.php';  

        if (!file_exists($fileName)) 
            die('no file!');
        $extension = strtolower( pathinfo($fileName, PATHINFO_EXTENSION) );
        echo $fileName;

        if ($extension =='xlsx') 
        {
            $objReader = new PHPExcel_Reader_Excel2007();
            $objExcel = $objReader ->load($fileName);
        } else if ($extension =='xls') 
        {
            $objReader = new PHPExcel_Reader_Excel5();
            $objExcel = $objReader ->load($fileName);
        }

        $lin = mysql_connect('localhost','root','root');

        if ($lin)
            mysql_select_db('gpa',$lin);
        else
            echo "link error";

        $sheet = $objExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $count_success = 0;
        $count_fail = 0;

        for($j=2;$j<=$highestRow;$j++)
        {
            $id = $objExcel->getActiveSheet()->getCell("B".$j)->getValue();
            $name = $objExcel->getActiveSheet()->getCell("C".$j)->getValue();
            $major = $objExcel->getActiveSheet()->getCell("D".$j)->getValue();
            $class = $objExcel->getActiveSheet()->getCell("E".$j)->getValue();
            $GPA = $objExcel->getActiveSheet()->getCell("F".$j)->getValue();
            $GPARank = $objExcel->getActiveSheet()->getCell("G".$j)->getValue();
            $score = $objExcel->getActiveSheet()->getCell("H".$j)->getValue();
            $scoreRank = $objExcel->getActiveSheet()->getCell("I".$j)->getValue();
            $fail = $objExcel->getActiveSheet()->getCell("J".$j)->getValue();
            $credit = $objExcel->getActiveSheet()->getCell("K".$j)->getValue();
            
            $sql = "SELECT * FROM BKS WHERE studentName='".$name."'";
            $query = mysql_query($sql);
            if ($query)
            {
                $arr = mysql_fetch_array($query);
                if ($arr)
                {
                    $sql = "UPDATE BKS SET studentID='".$id."', "
                            . "major='".$major."', "
                            . "class='".$class."', "
                            . "GPA='".$GPA."', "
                            . "GPARank='".$GPARank."', "
                            . "score='".$score."', "
                            . "scoreRank='".$scoreRank."', "
                            . "fail=".$fail.", "
                            . "credit=".$credit.", "
                            . "time='".$time."' "
                            . "where studentName='".$name."'";
                    $query = mysql_query($sql);
                     if ($query)
                         $count_success++;
                     else
                         $count_fail++;
                }
                else
                {
                     $sql = "INSERT INTO BKS (studentName, studentID, major, class, GPA, GPARank, score, scoreRank, fail, credit, time)
                    VALUES ('".$name."', '".$id."', '".$major."', '".$class."', '".$GPA."', '".$GPARank."', '".$score."', '".$scoreRank."', ".$fail.", ".$credit.", '".$time."')";
                     $query = mysql_query($sql);
                     if ($query)
                         $count_success++;
                     else
                         $count_fail++;
                }
            }
            
        }
        return array('success' => $count_success,'fail' => $count_fail);
}
        ?>
    </body>
</html>
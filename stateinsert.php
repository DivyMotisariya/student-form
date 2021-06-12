<?php
    include_once('./config.php');
    $tblCreateQry = 'CREATE TABLE STATE_LIST(SID INT PRIMARY KEY AUTO_INCREMENT, SNAME VARCHAR(150) NOT NULL);';
    $tblChkQry = 'SHOW TABLES LIKE "STATE_LIST";';
    $res = mysqli_query($conn, $tblChkQry);
    if($res->num_rows > 0) {
    } else {
        if(!mysqli_query($conn, $tblCreateQry)) {
            die(mysqli_error($conn));
        } else {
        }
    }

    if(isset($_POST['type'])) {
        if($_POST['type'] == 'insert') {
            $name = $_POST['name'];
        
            $idQry = 'SELECT CASE WHEN SID IS NULL THEN 1 ELSE MAX(SID) + 1 END AS SID FROM state_list';
            $res = mysqli_query($conn, $idQry);

            $sid = mysqli_fetch_array($res)['SID'];

            $insertQry = 'INSERT INTO STATE_LIST VALUES('.$sid.', "'.$name.'");';
            if(mysqli_query($conn, $insertQry)) {
                echo json_encode(Array('Saved'=>''.$name.''));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'update') {
            $id = $_POST['id'];
            $name = $_POST['name'];
        
            $insertQry = 'UPDATE STATE_LIST SET SNAME = "'.$name.'" WHERE SID = '. $id .';';
            if(mysqli_query($conn, $insertQry)) {
                echo json_encode(Array('Updated'=>$id));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'disp') {
            $dispQry = 'SELECT * FROM STATE_LIST;';
            if($res = mysqli_query($conn, $dispQry)) {
                $resArray = array();
                $rowCnt = $res->num_rows;
                $cnt = 0;

                while(($row = mysqli_fetch_assoc($res)) && ($cnt < $rowCnt)) {
                    $resArray[$cnt++] = $row;
                }
                
                echo json_encode($resArray);
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'get') {
            $dispQry = 'SELECT * FROM STATE_LIST WHERE SID = ' . $_POST['id'] . ';';
            if($res = mysqli_query($conn, $dispQry)) {
                $resArray = array();
                $rowCnt = $res->num_rows;
                $cnt = 0;

                while(($row = mysqli_fetch_assoc($res)) && ($cnt < $rowCnt)) {
                    $resArray[$cnt++] = $row;
                }
                
                echo json_encode($resArray);
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'dlt') {
            $dispQry = 'DELETE FROM STATE_LIST WHERE SID = ' . $_POST['id'] . ';';
            if(mysqli_query($conn, $dispQry)) {
                echo json_encode(Array('Deleted'=>$_POST['id']));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }
    }
?>
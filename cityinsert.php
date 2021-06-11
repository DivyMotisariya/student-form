<?php
    include_once('./config.php');
    $tblCreateQry = 'CREATE TABLE CITY_LIST(CID INT AUTO_INCREMENT, CNAME VARCHAR(150) NOT NULL, SID INT NOT NULL, PRIMARY KEY(CID, SID));';
    $tblChkQry = 'SHOW TABLES LIKE "CITY_LIST";';
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
            $sid = $_POST['sid'];
        
            $insertQry = 'INSERT INTO CITY_LIST(CNAME, SID) VALUES("'.$name.'", '.$sid.');';
            if(mysqli_query($conn, $insertQry)) {
                echo json_encode(Array('Saved'=>''.$name.''));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'update') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $sid = $_POST['sid'];
        
            $insertQry = 'UPDATE CITY_LIST SET CNAME = "'.$name.'", SID = '.$sid.' WHERE CID = '. $id .';';
            if(mysqli_query($conn, $insertQry)) {
                echo json_encode(Array('Updated'=>$id));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'disp') {
            $dispQry = 'SELECT C.CID, C.CNAME, S.SNAME FROM CITY_LIST C
                        LEFT JOIN STATE_LIST S ON S.SID = C.SID;';
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
            $dispQry = 'SELECT * FROM CITY_LIST WHERE CID = ' . $_POST['id'] . ';';
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
            $dispQry = 'DELETE FROM CITY_LIST WHERE CID = ' . $_POST['id'] . ';';
            if(mysqli_query($conn, $dispQry)) {
                echo json_encode(Array('Deleted'=>$_POST['id']));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }
    }
?>
<?php
    include_once('./config.php');
    $tblCreateQry = 'CREATE TABLE STUDENT_DATA(ID INT PRIMARY KEY AUTO_INCREMENT, NAME VARCHAR(150) NOT NULL, AGE INT NOT NULL, CITY INT NOT NULL, SID INT NOT NULL);';
    $tblChkQry = 'SHOW TABLES LIKE "STUDENT_DATA";';
    $res = mysqli_query($conn, $tblChkQry);
    if($res->num_rows > 0) {
        // echo 'Table Already Present';
    } else {
        if(!mysqli_query($conn, $tblCreateQry)) {
            die(mysqli_error($conn));
        } else {
            // echo 'Table Created';
        }
    }

    if(isset($_POST['type'])) {
        if($_POST['type'] == 'insert') {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $city = $_POST['city'];
            $state = $_POST['state'];
        
            $insertQry = 'INSERT INTO STUDENT_DATA(NAME, AGE, CITY, SID) VALUES("'.$name.'", '.$age.', '.$city.', '.$state.');';
            if(mysqli_query($conn, $insertQry)) {
                echo json_encode(Array('Saved'=>''.$name.' '.$age.''));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'update') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $city = $_POST['city'];
            $state = $_POST['state'];
        
            $insertQry = 'UPDATE STUDENT_DATA SET NAME = "'.$name.'", AGE = '.$age.', CITY = '.$city.', SID = '.$state.' WHERE ID = '. $id .';';
            if(mysqli_query($conn, $insertQry)) {
                echo json_encode(Array('Updated'=>$id));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'disp') {
            $dispQry = 'SELECT S.ID, S.NAME, S.AGE, C.CNAME, ST.SNAME FROM STUDENT_DATA S
                        LEFT JOIN CITY_LIST C ON C.CID = S.CITY
                        LEFT JOIN STATE_LIST ST ON ST.SID = S.SID;';
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
            $dispQry = 'SELECT * FROM STUDENT_DATA WHERE ID = ' . $_POST['id'] . ';';
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
            $dispQry = 'DELETE FROM STUDENT_DATA WHERE ID = ' . $_POST['id'] . ';';
            if(mysqli_query($conn, $dispQry)) {
                echo json_encode(Array('Deleted'=>$_POST['id']));
            } else {
                echo json_encode(mysqli_error($conn));
            }
        }

        if($_POST['type'] == 'fillState') {
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

        if($_POST['type'] == 'fillCity') {
            $dispQry = 'SELECT * FROM CITY_LIST WHERE SID = '.$_POST['sid'].';';
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
    }
?>
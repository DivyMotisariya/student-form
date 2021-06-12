<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <script src="./index.js"></script>
    <title>Student Form</title>
    <style>
        #data,
        #data th,
        #data tr,
        #data td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
    <a href="./"><button class="btn-primary btn-sm">Student List</button></a>
    <a href="./state.php"><button class="btn-primary btn-sm">State List</button></a>
    <a href="./city.php"><button class="btn-primary btn-sm">City List</button></a>
    <!-- <button class="btn-primary btn-sm" href="./" >Student List</button>
    <button class="btn-primary btn-sm" href="./city.php" >City List</button> -->

    <br><br><br>

    <form action="./" method="post">
        <table style="border: 0; text-align: center;">
            <tr>
                <td style="display: none; text-align: left">ID</td>
                <td>
                    <input style="display: none" type="text" name="id" id="id" autocomplete="false" />
                </td>
            </tr>
            <tr>
                <td style="text-align: left">Enter Name</td>
                <td>
                    <input type="text" name="name" id="name" autocomplete="off" />
                </td>
            </tr>
            <tr>
                <td style="text-align: left">Enter Age</td>
                <td>
                    <input type="number" name="age" id="age" min="1" max="100" onchange="checkAge(this.value)" autocomplete="off" />
                </td>
            </tr>
            <tr>
                <td style="text-align: left">Select State</td>
                <td>
                    <select name="state" id="state" onchange="fillCity(this.value, 0);"></select>
                </td>
            </tr>
            <tr>
                <td style="text-align: left">Select City</td>
                <td>
                    <select name="city" id="city"><option value="0">Select City</option></select>
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="2">
                    <button class="btn-primary btn-sm" onclick="save()" value="insert" type="submit">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <br /><br /><br />
    <table id="data"></table>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <script src="./city.js"></script>
    <title>City Form</title>
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

    <br><br><br>

    <form action="./city" method="post">
        <table style="border: 0; text-align: center">
            <tr>
                <td style="display: none; text-align: left">ID</td>
                <td>
                    <input style="display: none" type="text" name="id" id="id" autocomplete="false" />
                </td>
            </tr>
            <tr>
                <td style="text-align: left">City Name</td>
                <td>
                    <input type="text" name="name" id="name" autocomplete="false" />
                </td>
            </tr>
            <tr>
                <td style="text-align: left">Select State</td>
                <td>
                    <select name="state" id="state"></select>
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan="2">
                    <button class="btn-primary btn-sm" onclick="save()" type="submit" value="insert">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <br /><br /><br />
    <table id="data"></table>
    </div>
</body>

</html>
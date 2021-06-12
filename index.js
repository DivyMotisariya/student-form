$(document).ready(display);

function save() {
    event.preventDefault();
    var id = document.getElementById("id").value;
    var name = document.getElementById("name").value;
    var age = document.getElementById("age").value;
    var city = document.getElementById("city").value;
    var state = document.getElementById('state').value;
    var type = document
        .querySelector('button[type="submit"]')
        .value.toLowerCase();
    if (!name || !age) {
        alert("All Inputs Are Required");
        return;
    }

    if (Number(age) < 1 || Number(age) > 100) {
        alert('Age must be greater than 0 and less than 100');
        return;
    }

    if (state == 0) {
        alert('Select State');
        return;
    }

    if (city == 0) {
        alert('Select City');
        return;
    }

    $.post({
        url: "./insert.php",
        data: {
            type: type,
            id: id,
            name: name,
            age: age,
            city: city,
            state: state
        },
        cache: false,
        success: (data) => {
            data = JSON.parse(data);
            console.log(data);
            document.querySelector('button[type="submit"]').value = "insert";
            document.getElementById("name").value = "";
            document.getElementById("age").value = "";
            document.getElementById("state").value = 0;
            document.getElementById('city').innerHTML = '<option value="0">Select City</option>';
            document.getElementById("name").focus();
            document.getElementById('search').value = "";
            display();
        }
    });
}

function display() {
    fillState();
    $.post({
        url: "./insert.php",
        data: {
            type: "disp",
        },
        success: function(data, status, xhr) {
            var table = `<!--<tr>
                                <td style="border:none; display:none;" colspan="4">
                                    <button>Insert</button>
                                </td>
                                <td style="border:none;" colspan="13">
                                    <button style="display: none;" class="btn-primary btn-sm" onclick="display()">Refresh</button>
                                </td>
                            </tr>--><tr>
                            <th style="display:none;" colspan="1">ID</th>
                            <th colspan="5">Name</th>
                            <th colspan="2">Age</th>
                            <th colspan="2">City</th>
                            <th colspan="2">State</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>`;
            JSON.parse(data).forEach((row) => {
                table += // onclick='show(this)'
                    "<tr>" +
                    "<td style='display:none;'' colspan='1'>" +
                    row.ID +
                    "</td>" +
                    "<td style='text-align:left;' colspan='5'>" +
                    row.NAME +
                    "</td>" +
                    "<td colspan='2'>" +
                    row.AGE +
                    "</td>" +
                    "<td colspan='2'>" +
                    row.CNAME +
                    "</td>" +
                    "<td colspan='2'>" +
                    row.SNAME +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.ID +
                    " onclick='update(this.value)'>Update</button>" +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.ID +
                    " onclick='dlt(this.value)'>Delete</button>" +
                    "</td>" +
                    "</tr>";
            });
            document.getElementById("data").innerHTML = table;
            document.getElementById("id").value = ''
            document.getElementById("name").value = ''
            document.getElementById("age").value = ''
            document.getElementById("city").innerHTML = '<option value="0">Select City</option>';
            document.getElementById('state').value = 0
            document.querySelector('button[type="submit"]').value = 'insert';
            $("#search").on('input', function() {
                search($(this).val());
            });
        }
    });
}

function search(txt) {
    $.post({
        url: "./insert.php",
        data: {
            type: "filter",
            q: txt
        },
        success: function(data, status, xhr) {
            var table = `<tr>
                            <th style="display:none;" colspan="1">ID</th>
                            <th colspan="5">Name</th>
                            <th colspan="2">Age</th>
                            <th colspan="2">City</th>
                            <th colspan="2">State</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>`;
            JSON.parse(data).forEach((row) => {
                table += // onclick='show(this)'
                    "<tr>" +
                    "<td style='display:none;'' colspan='1'>" +
                    row.ID +
                    "</td>" +
                    "<td style='text-align:left;' colspan='5'>" +
                    row.NAME +
                    "</td>" +
                    "<td colspan='2'>" +
                    row.AGE +
                    "</td>" +
                    "<td colspan='2'>" +
                    row.CNAME +
                    "</td>" +
                    "<td colspan='2'>" +
                    row.SNAME +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.ID +
                    " onclick='update(this.value)'>Update</button>" +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.ID +
                    " onclick='dlt(this.value)'>Delete</button>" +
                    "</td>" +
                    "</tr>";
            });
            document.getElementById("data").innerHTML = table;
        }
    });
}

function fillState() {
    $.post({
        url: "./insert.php",
        data: {
            type: "fillState",
        },
        success: (data) => {
            var state = '<option value="0">Select State</option>';
            JSON.parse(data).forEach((row) => {
                state += "<option value=" + row.SID + ">" + row.SNAME + "</option>";
            });
            document.getElementById("state").innerHTML = state;
        },
    });
}

function fillCity(sid, cid) {
    $.post({
        url: "./insert.php",
        data: {
            type: "fillCity",
            sid: sid
        },
        success: (data) => {
            var city = '<option value="0">Select City</option>';
            JSON.parse(data).forEach((row) => {
                city += "<option value=" + row.CID + ">" + row.CNAME + "</option>";
            });
            document.getElementById("city").innerHTML = city;
            document.getElementById("city").value = cid;
        },
    });
}

function update(id) {
    $.post({
        url: "./insert.php",
        data: {
            type: "get",
            id: id,
        },
        success: (data) => {
            data = JSON.parse(data);
            document.querySelector('button[type="submit"]').value = "update";
            document.getElementById("id").value = data[0].ID;
            document.getElementById("name").value = data[0].NAME;
            document.getElementById("age").value = data[0].AGE;
            document.getElementById("state").value = data[0].SID;
            fillCity(data[0].SID, data[0].CITY);
            // document.getElementById("city").value = data[0].CITY;
        },
    });
}

function dlt(id) {
    event.preventDefault();
    $.post({
        url: "./insert.php",
        data: {
            type: "dlt",
            id: id,
        },
        cache: false,
        success: (data) => {
            data = JSON.parse(data);
            console.log(data);
            display();
        }
    });
}

function show(row) {
    alert(row.attributes.value.nodeValue);
}
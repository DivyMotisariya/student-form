$(document).ready(display);

function save() {
    event.preventDefault();
    var id = document.getElementById("id").value;
    var name = document.getElementById("name").value;
    var type = document
        .querySelector('button[type="submit"]')
        .value.toLowerCase();
    if (!name) {
        alert("Please Enter State Name");
        return;
    }

    $.ajax({
        type: "POST",
        url: "./stateinsert.php",
        data: {
            type: type,
            id: id,
            name: name
        },
        cache: false,
        success: (data) => {
            data = JSON.parse(data);
            console.log(data);
            document.querySelector('button[type="submit"]').value = "insert";
            document.getElementById("name").value = "";
            document.getElementById("name").focus();
            document.getElementById('search').value = "";
            display();
        },
    });
}

function display() {
    $.ajax({
        type: "POST",
        url: "./stateinsert.php",
        data: {
            type: "disp"
        },
        success: (data) => {
            var table = `<!--<tr>
                            <td style="border:none; display:none;" colspan="4">
                                <button>Insert</button>
                            </td>
                            <td style="border:none;" colspan="7">
                                <button class='btn-primary btn-sm' onclick="display()">Refresh</button>
                            </td>
                        </tr>-->`;
            table += `<tr>
                        <th style="display:none;" colspan="1">ID</th>
                        <th colspan="5">State Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>`;
            JSON.parse(data).forEach((row) => {
                table +=
                    "<tr>" +
                    "<td style='display:none;'' colspan='1'>" +
                    row.SID +
                    "</td>" +
                    "<td style='text-align:left;' colspan='5'>" +
                    row.SNAME +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.SID +
                    " onclick='update(this.value)'>Update</button>" +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.SID +
                    " onclick='dlt(this.value)'>Delete</button>" +
                    "</td>" +
                    "</tr>";
            });
            document.getElementById("data").innerHTML = table;
            $("#search").on('input', function() {
                search($(this).val());
            });
        },
    });
}

function search(txt) {
    $.post({
        url: "./stateinsert.php",
        data: {
            type: "filter",
            q: txt
        },
        success: function(data, status, xhr) {
            var table = `<tr>
                            <th style="display:none;" colspan="1">ID</th>
                            <th colspan="5">State Name</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>`;
            JSON.parse(data).forEach((row) => {
                table +=
                    "<tr>" +
                    "<td style='display:none;'' colspan='1'>" +
                    row.SID +
                    "</td>" +
                    "<td style='text-align:left;' colspan='5'>" +
                    row.SNAME +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.SID +
                    " onclick='update(this.value)'>Update</button>" +
                    "</td>" +
                    "<td><button class='btn-secondary btn-sm' value=" +
                    row.SID +
                    " onclick='dlt(this.value)'>Delete</button>" +
                    "</td>" +
                    "</tr>";
            });
            document.getElementById("data").innerHTML = table;
        }
    });
}

function update(id) {
    $.ajax({
        type: "POST",
        url: "./stateinsert.php",
        data: {
            type: "get",
            id: id,
        },
        success: (data) => {
            data = JSON.parse(data);
            document.querySelector('button[type="submit"]').value = "update";
            document.getElementById("id").value = data[0].SID;
            document.getElementById("name").value = data[0].SNAME;
        },
    });
}

function dlt(id) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "./stateinsert.php",
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
<html>

<head>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
      width: 60%;
    }

    th {
      background-color: #337CFF;
      color: black;
    }

    tr {
      background-color: whitesmoke;
      color: black;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

  <table class="center">
    <tr>
      <th>Employee Name</th>
      <th>Employee ID</th>
      <th>Department</th>
      <th>Salary</th>
      <th>Remove</th>
    </tr>
    <?php
    $usern = $_GET['User'];
    $pass = $_GET['Pass'];
    $con = mysqli_connect("localhost", "root", "", "amogham");
    $query = "select *from admin";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $u = $row['Username'];
      $p = $row['Password'];
    }
    if ($usern == $u && $pass == $p) {
      $sql = "select *from employee";
      $res = $con->query($sql);
      if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
          echo "<tr><td>" . $row['Name'] . "</td><td>" . $row['Employee_id'] . "</td><td>" . $row['Department'] . "</td><td>" . $row['Salary'] . "</td><td><input type='button' value='Remove' class='rmv'></td></tr>";
        }
        echo "</table>";
      }
    } else {
      echo "<script>alert('Invalid Username or Password')</script>";
    }
    mysqli_close($con);
    ?>
    
    <script>
      console.log("before Jq");
      $(document).ready(function() {

          $("#add").on('click', function() {
            var name = document.getElementById("name").value;
          var id = document.getElementById("id").value;
          var dept = document.getElementById("dept").value;
          var salary =  document.getElementById("salary").value;
          $("table").append("<tr><td>" + name + "</td><td>" + id + "</td><td>" + dept + "</td><td>" + salary + "</td><td><input type='button' value='Remove' class='rmv'></td></tr>");
          
        });
        $("body").on("click", ".rmv", function() {
          $(this).closest("tr").remove();
        });
        $("th").each(function(column){
        $(this).data("type", $(this).attr("class"));
        $(this).click(function() {
          var records = $("table").find("tbody > tr");
          records.sort(function(a, b) {

            var type = $(this).data("type");
            var v1 = $(a).children("td").eq(column).text();
            var v2 = $(b).children("td").eq(column).text();
            if (type == "num") {
              v1 *= 1;
              v2 *= 2;
            }
            return (v1 < v2) ? -1 : (v1 > v2 ? 1 : 0)

          });
          $.each(records, function(index, row) {
            $("tbody").append(row);

          });
        });
      });
    });
    </script>
    <div id="enter">
      <label for="">Employee name</label>
      <input type="text" id="name">
      <label for="">Employee id</label>
      <input type="text" id="id">
      <label for="">Department</label>
      <input type="text" id="dept">
      <label for="">Salary</label>
      <input type="text" id="salary">
    </div>
    <button id="add">ADD</button>
</body>

</html>
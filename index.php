<?php

$connication = mysqli_connect("localhost", 'root','', 'employees');

// Insert;

if (isset($_POST['send'])) {
    $Name = $_POST["empName"];
    $Salary = $_POST["empSalary"];
    $Phone = $_POST["empPhone"];
    $dep_ID = $_POST["depId"];
    $insert = "INSERT INTO employee VALUES(NULL,'$Name',$Salary,'$Phone',$dep_ID)";
    $insertEmployeeCheck =  mysqli_query($connication, $insert);
}

$select = "SELECT * FROM employee";
$s = mysqli_query($connication,$select);

$selectDep = "SELECT * FROM `department`";
$departments = mysqli_query($connication,  $selectDep);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM employee WHERE id=$id ";
    $id=mysqli_query($connication, $delete);
    header("location: index.php");
}
$Name = "";
$Salary = "";
$Phone = "";
$dep_ID = "";
$update = false;


if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $selectEmployee = "SELECT * FROM employee where id =$id";
    $employee =  mysqli_query($connication, $selectEmployee);
    $row = mysqli_fetch_assoc($employee);
    $Name = $row['Name'];
    $Salary = $row['Salary'];
    $Phone = $row['Phone'];
    $dep_ID = $row['dep_ID'];

    if (isset($_POST['update'])) {
        $Name = $_POST["empName"];
        $Salary = $_POST["empSalary"];
        $Phone = $_POST["empPhone"];
        $dep_ID = $_POST["depId"];
        $update = "UPDATE employee SET `Name` ='$Name' ,Salary=$Salary , Phone='$Phone',dep_ID=$dep_ID where id =$id";
        $id=mysqli_query($connication, $update);
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index1.css">
    </LInk>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">EmployeeName : </label>
                        <input class="form-control" value="<?= $Name ?>" type="text" name="empName">
                    </div>
                    <div class="form-group">
                        <label for="">EmployeeSalary : </label>
                        <input class="form-control" value="<?= $Salary ?>" type="text" name="empSalary">
                    </div>
                    <div class="form-group">
                        <label for="">EmployeePhone : </label>
                        <input class="form-control" value="<?= $Phone ?>" type="text" name="empPhone">
                    </div>
                    <div class="form-group">
                        <label for="">EmployeeDepartment </label>
                        <select class="form-control" type="text" name="depId">
                            <?php foreach ($departments as $data) { ?>

                            <option value="<?= $data['id'] ?>"> <?= $data['department_name'] ?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                    <?php if ($update) : ?>
                    <br>
                    <button name="update" class="btn btn-primary"> Update </button>
                    <?php else : ?>
                    <br>
                    <button name="send" class="btn btn-info"> Send Data </button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th> id </th>
                        <th> Name </th>
                        <th> Salary </th>
                        <th> Phone </th>
                        <th> Dempartment </th>
                        <th> Action</th>
                        <th> </th>
                    </tr>
                    <?php foreach ($s as $data) { ?>
                    <tr>
                        <td><?= $data['id'] ?> </td>
                        <td><?= $data['Name'] ?> </td>
                        <td><?= $data['Salary'] ?> </td>
                        <td><?= $data['Phone'] ?> </td>
                        <td><?= $data['dep_ID'] ?> </td>
                        <td> <a class="btn btn-info" href="index.php?edit=<?= $data['id'] ?>"> Update </a> </td>
                        <td> <a class="btn btn-danger" href="index.php?delete=<?= $data['id'] ?>"> Delete </a> </td>
                    </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>

    </div>

</body>

</html>
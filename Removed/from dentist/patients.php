<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Patients </title>
</head>
<!-- <script>
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "/processSearchDataProfile.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }
        $('#search').keyup(function() {
            var search = $(this).val();
            if (search !== '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script> -->

<body class="body">

    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>


    <!-- <section class="home-section">
        <h2 class="page-title">PATIENTS</h2>

        <div>
            <form action="#">
                <input class="searchText" type="text" id="search" name="search" placeholder="Search">
            </form>
        </div>
        <div id="result"></div>

    </section> -->

    <!-- <section class="home-section">
        <h2 class="page-title">PATIENTS</h2>

        <div>
            <form action="#">
                <input class="searchText" type="text" id="search" name="search" placeholder="Search">
            </form>
        </div>
        <div id="result"></div>
                        
                                //                include "../connection/db.php";
                                //
                                //                $sql = "
                                //                        SELECT admin.loginID, admin.fName, admin.lName, useraccount.userType
                                //                        FROM admin
                                //                        INNER JOIN useraccount ON admin.loginID = useraccount.loginID
                                //                        UNION ALL
                                //                        SELECT dentalassistant.loginID, dentalassistant.fName, dentalassistant.lName, useraccount.userType
                                //                        FROM dentalassistant
                                //                        INNER JOIN useraccount ON dentalassistant.loginID = useraccount.loginID
                                //                        UNION ALL
                                //                        SELECT dentist.loginID, dentist.fName, dentist.lName, useraccount.userType
                                //                        FROM dentist
                                //                        INNER JOIN useraccount ON dentist.loginID = useraccount.loginID
                                //                        ";
                                //                $result = $link->query($sql);
                                //
                                //                if ($result->num_rows > 0) {
                                //                    // output data of each row
                                //                    while($row = $result->fetch_assoc()) {
                                //                        echo
                                //                            "<tr><td>" . $row["loginID"].
                                //                            "</td><td>" . $row["fName"].
                                //                            "</td><td>" . $row["lName"].
                                //                            "</td><td>" . $row["userType"] .
                                //                            "</td><td><a href='updateUserProfile.php?loginID=".$row['loginID']."'>Update</a>".
                                //                            "</td><td><a onClick=\"javascript: return confirm('Please confirm deletion for ".$row['loginID']." ');\" href=\"delete.php?loginID=".$row['loginID']."\">Delete</a></td></tr>";
                                //                    }
                                //                } else { echo "<script>
                                //                    alert('No item found');
                                //                </script>"; }
                                //                $link->close();
                                //                
                                ?>

    </section> -->


    <section class="home-section">
        <h2 class="page-title">Patients</h2>
        <div class="table-section">
            <table class="patient-table">
                <thead>
                    <tr class="table-header-row">
                        <th id="table-id" class="table-id">ID</th>
                        <th id="table-title" class="table-title">Title</th>
                        <th id="table-name" class="table-name">Name</th>
                        <!-- <th id="table-name" class="table-name"><i class="fa-solid fa-magnifying-glass"></i>
                            <input id="searchInput" type="text" placeholder="Name">
                        </th> -->
                        <th id="table-gender" class="table-gender">Gender</th>
                        <th id="table-number" class="table-number">Phone Number</th>
                        <th id="table-email" class="table-email">Email</th>
                        <th id="table-action" class="table-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../connection/db.php";

                    $sql = "SELECT patientID, title, patientName, sex, phoneNO, email FROM patient";
                    $result = $link->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='table-input'>
                            <td class='table-row table-id'>" . $row["patientID"] . "</td>
                            <td class='table-row table-title'>" . $row["title"] . "</td>
                            <td class='table-row table-name'>" . $row["patientName"] . "</td>
                            <td class='table-row table-gender'>" . $row["sex"] . "</td>
                            <td class='table-row table-number'>" . $row["phoneNO"] . "</td>
                            <td class='table-row table-email'>" . $row["email"] . "</td>
                            <td class='table-row table-action'><i class='fa-solid fa-notes-medical'></i>" .    "</td>
                            </tr>";
                        }
                    } else {
                        echo "<script>
                    alert('No item found');
                </script>";
                    }
                    $link->close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>

</body>

</html>
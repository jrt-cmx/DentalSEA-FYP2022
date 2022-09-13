<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>User Profile</title>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "processSearchDataProfile.php",
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
    </script>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include '../includes/sideBar.php'; ?>
    <?php include "../includes/navBar/navBar.php"; ?>


    <section class="home-section">

        <h2 class="page-title">User Profile</h2>
        <div class="list--top">
            <form action="#">
                <input class="searchText" type="text" id="search" name="search" placeholder="Search">
            </form>
        </div>
        <div class="table-section">
            <div class="table-part">
                <p class="table-column-header">ID</p>
                <p class="table-column-header column-four"></p>
                <p class="table-column-header">First Name</p>
                <p class="table-column-header column-five"></p>
                <p class="table-column-header">Last Name</p>
                <p class="table-column-header column-six"></p>
                <p class="table-column-header action">Action</p>
            </div>
            <div id="result"></div>
        </div>
        <!--                --><?php
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

    <?php include "../includes/footer/footer.php"; ?>
    </section>


    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>
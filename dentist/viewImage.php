<div class="notes--part">
    <!-- Display image -->
    <div class="image-cards">
        <span class="upload-div"><a href="#imageUpload" class="btn-add upload" style="float: right ">Upload</a></span>
        <?php
        include '../connection/db.php';
        $idNo = $_GET['idNo'];
        $count = 1;
        $result = mysqli_query($link, "SELECT * FROM images WHERE idNo = '$idNo'");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <?php
                echo "<div class='card-container' id='img_div'>";
                echo "<div class='image-no'>" . $count++ . "</div>";
                echo "<img class='image zoomE' src='../upload/" . $row['filename'] . "' >";
                echo "<p class='card-date'>Date: " . $row['date'] . "</p>";
                echo "<p class='card-remarks'>Remarks: " . $row['imageText'] . "</p>";
                echo "<a class='card-btn-delete' onClick=\"javascript: return confirm('Please confirm deletion for this image details contain: " . $row['imageText'] . "');\" 
				                        href=\"../dentist/deleteImage.php?no=" . $row['no'] . "\" class='components--button'>
			                            Delete</a>";
                echo "</div>"; ?>
        <?php }
        } else {
            echo "0 results";
        }
        $link->close();
        ?>
    </div>
</div>

<!-- Upload image -->
<form action="../dentist/uploadImage.php" method="post" enctype="multipart/form-data">
    <link rel="stylesheet" href="../css/popUp.css">
    <div class="overlay" id="imageUpload">
        <div class="wrapper">
            <h2>Upload file</h2><a class="close" href="#">&times;</a>
            <div class="content">
                <div class="container">
                    <label>Select image</label>
                    <br>
                    <input type="hidden" name="size" value="1000000">
                    <div>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <textarea id="text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
                    </div>
                    <div>
                        <button type="submit" name="upload">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    window.onload = () => {
        // (A) GET ALL IMAGES
        let all = document.getElementsByClassName("zoomE");

        // (B) CLICK TO GO FULLSCREEN
        if (all.length > 0) {
            for (let i of all) {
                i.onclick = () => {
                    // (B1) EXIT FULLSCREEN
                    if (document.fullscreenElement != null || document.webkitFullscreenElement != null) {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        } else {
                            document.webkitCancelFullScreen();
                        }
                    }

                    // (B2) ENTER FULLSCREEN
                    else {
                        if (i.requestFullscreen) {
                            i.requestFullscreen();
                        } else {
                            i.webkitRequestFullScreen();
                        }
                    }
                };
            }
        }
    };
</script>
<footer class="footer">
    <button id="contact--form--btn--open"><i class="fa-solid fa-circle-question"></i></button>
    <!-- <button id="contact--form--btn--open--mouseover">Need help<i class="fa-solid fa-question"></i></button> -->
    <div id="contact--form--popup">
        <div class="contact--form--popup--top">
            <h4 class="contact--form--title">Contact Us</h4>
            <p class="contact--form--desccription">System decaying? Drop us a message for assistance.</p>
            <form class="contact--form--container" action="https://formsubmit.co/22a952e64dfc9b915b4512aa9671fbc1" method="POST">
                <input type="hidden" name="_captcha" value="false">
                <input id="url" type="hidden" name="_next">
                <label>Clinic: </label>
                <?php
                include "../connection/db.php";
                $clinic = $_SESSION['dbSelection'];
                echo '<input type="text" name="Clinic" class="contact--form--input" value="' . $clinic . '" placeholder="Clinic" required>';
                $id = $_SESSION['username'];
                $sql = "(SELECT fName, lName FROM dentist WHERE loginID = '" . $id . "')
                        UNION        
                        (SELECT fName, lName FROM admin WHERE loginID = '" . $id . "')
                        UNION                
                        (SELECT fName, lName FROM dentalassistant WHERE loginID = '" . $id . "')";
                $result = $link->query($sql);
                $row = $result->fetch_assoc();
                $name = $row['fName'];
                echo '<label>Enquirer: </label>';
                echo '<input type="text" name="Enquirer" class="contact--form--input" value="' . $name . '"placeholder="Enquirer" required>';
                $link->close();
                ?>
                <label>Subject: </label>
                <input type="text" name="Subject" class="contact--form--input" placeholder="Subject" required>
                <label>Message: </label>
                <textarea type="text" name="message" class="contact--form--input" placeholder="Message" required></textarea>
                <button type="submit" id="contact--form--btn--send" class="contact--form--input"><i class="fa-solid fa-paper-plane"></i>Send</button>
            </form>
        </div>
        <div class="contact--form--popup--bottom">
            <button type="button" id="contact--form--btn--close"><i class="fa-solid fa-rectangle-xmark"></i>Close</button>
        </div>
    </div>
</footer>
<script>

    const currentUrl = window.location.href
    console.log(currentUrl)
    document.getElementById("url").value = currentUrl
</script>
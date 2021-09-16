<h1 class="orderh1">Thong tin dat hang</h1>
<?php


?>
<form method="POST" action="./views/handle.php">
    <div class="wrap_login">
        <?php
        if (isset($_SESSION['user_id'])) {
            $query_customer = "SELECT * FROM tbl_customer WHERE id = '" . $_SESSION['user_id'] . "'";
            $result_customer = $conn->query($query_customer);
            $row_cus = mysqli_fetch_array($result_customer);

        ?>
            <label for="uname"><b>Name</b></label>
            <input class="form_usn_login" type="text" value="<?php echo $row_cus['username'] ?>" placeholder="Enter Name" name="uname" required>
        <?php } else { ?>
            <label for="uname"><b>Name</b></label>
            <input class="form_usn_login" type="text" placeholder="Enter Name" name="uname" required>
        <?php  } ?>
        
        <label for="email"><b>Email</b></label>
        <input class="form_psw_login" type="text" placeholder="Enter Email" name="email" required>

        <label for="phone"><b>Phone number</b></label>
        <input class="form_psw_login" type="text" placeholder="Enter Phone Number" name="phone" required>

        <label for="address"><b>Address</b></label>
        <input class="form_psw_login" type="text" placeholder="Enter Address" name="address" required>

        <label for="note"><b>Note</b></label>
        <textarea class="form_psw_login" type="text" placeholder="Enter Note" name="note" required> </textarea>

        <label for="psw"><b>Method order</b></label>
        <?php
        $query = "SELECT * FROM tbl_methodOrder";
        $result = $conn->query($query);
        ?>
        <select class="form_psw_login" name="methodorder">
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['method_order'] ?></option>
            <?php } ?>
        </select>

        <input class="sbm_login_form" name="sbm_order" Value="Order" type="submit" />
    </div>
</form>
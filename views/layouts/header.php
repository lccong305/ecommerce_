<div class="header">
    <ul class="navbar">
        <li><a href=" ?opt=home"> Home</a></li>
        <li><a href=" ?opt=cart"> Cart</a></li>
    </ul>
    <form>
        <input type="hidden" name="opt" value="showprd" />
        <input type="text" name="keywrd" />
        <input type="submit" value="Search" />
    </form>
    <ul>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <li><a href="?opt=logout">Logout</a></li>
        <?php } else { ?>
            <li><a href="?opt=login">Login</a></li>
            <li><a href="?opt=register">Register</a></li>
        <?php } ?>

    </ul>
</div>
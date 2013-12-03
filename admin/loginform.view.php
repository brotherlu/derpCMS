<?php include TEMPLATE_PATH."/includes/header.php"; ?>

    <form action="admin.php?action=login" method="post">
        <input type="hidden" name="login" value="true" />
        
<?php if( isset( $results['errorMessage'] ) ): ?>
    <div class="Error">
        <?php echo $results['errorMessage']; ?>
    </div>
<?php endif; ?>
    
        <ul>
            <li>
                <label>username</label>
                <input type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength=20 />
            </li>
        
            <li>
                <label>password</label>
                <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength=20 />
            </li>
        </ul>
        
        <input type="submit" name="login" value="Login" />
    
    </form>

<?php include TEMPLATE_PATH."/includes/footer.php"; ?>

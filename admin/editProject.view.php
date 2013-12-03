<?php include "template/include/header.php"; ?>

    <div id="adminHeader">
        <h2>Widgets News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']); ?></b>. <a href="admin.php?action="logout"?>Log Out</a></p>
    </div>

    <h1><?php echo $results['pageTitle']; ?></h1>
    
    <form action="admin.php?action=<?php echo $results['formAction']; ?>" method="Post">
        <input type="hidden" name="articleId" value="<?php echo $results['post']->id; ?>" />

<?php if(isset($results['errorMessage'])) {?>

    <div class="errorMessage"><?php echo $results['errorMessage']; ?></div>

<?php } ?>

    <ul>
        <li>
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" placeholder="Name of Post" required autofocus maxlength="255" value="<?php echo htmlspecialchars($results['post']->title) ?>" />
        </li>
        
        <li>
        <label for="summary">Post Summary</label>
        <textarea name="summary" id="summary" placeholder="Brief Description of the Post" required maxlength="1000"><?php echo htmlspecialchars($results['post']->summary) ?></textarea>
        </li>
        
        <li>
        <label for="content">Post Content</label>
        <textarea name="content" id="content" placeholder="Content of the Post" required maxlength="100000"><?php echo htmlspecialchars($results['post']->content) ?></textarea>
        </li>
        
        <li>
        <label for="pubData">Post Date</label>
        <input type="date" name="pubDate" id="pubDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['pubdate'] ? date("Y-m-d",$results['post']->pubdate) : "" ?>" />
        </li>
    
    </ul>

    <div class="buttons">
        <input type="submit" name="saveChanges" value="Save Changes" />
        <input type="submit" formnovalidate name="cancel" value="Cancel" />
    </div>

    </form>

<?php if( $results['post']->id) { ?>
    <p><a href="admin.php?action=deletePost&amp;postId=<?php echo $results['post']->id ?>" onclick="return confirm('Delete this Post?')">Delete this Post</a></p>
<?php } ?>

<?php include "template/include/footer.php"; ?>

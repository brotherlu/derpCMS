<?php include "templates/include/header.php" ?>
 
      <div id="adminHeader">
        <h2>Widget News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
      </div>
 
      <h1>All Posts</h1>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
      <table>
        <tr>
          <th>Publication Date</th>
          <th>Post</th>
        </tr>
 
<?php foreach ( $results['posts'] as $post ) { ?>
 
        <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $post->id?>'">
          <td><?php echo date('j M Y', $post->publicationDate)?></td>
          <td>
            <?php echo $post->title?>
          </td>
        </tr>
 
<?php } ?>
 
      </table>
 
      <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
 
      <p><a href="admin.php?action=newPost">Add a New Post</a></p>
 
<?php include "templates/include/footer.php" ?>

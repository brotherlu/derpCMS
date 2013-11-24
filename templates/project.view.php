<?php include TEMPLATE_PATH."/include/head.php"; ?>

<div class="core">

<?php 

echo $results['project']->title;
echo $results['project']->summary;
echo $results['project']->pubdate;

?>

</div>

<?php include TEMPLATE_PATH."/include/footer.php"; ?>

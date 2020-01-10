<?php
$title = '';
$desc  = '';
$meta = array(
  'description' => 'view all drawings.',
  'image'       => null,
  'title'       => 'drawing archive'
);

include($_SERVER['DOCUMENT_ROOT'] . '/includes/query.php');

$rows = select("SELECT * FROM drawings ORDER BY id DESC");
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="flex wrap mb10">
  <?php foreach ($rows as $record) { ?>
    <?php
    $title = $record['title'];
    $title = str_replace("'", '\&apos;', $title);
    $title = str_replace('"', "\&quot;", $title);
    ?>
    <a href="index.php?id=<?= $record['id']; ?>" class="mr1 mb1">
      <img src="<?= $record['thumb']; ?>" alt="<?= $title; ?>" class="thumb"/>
    </a>
  <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>

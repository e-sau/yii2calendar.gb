<h4>Ваши планы на сегодня</h4>

<?php foreach($items as $k => $item){ ?>
    <p><?= ($k + 1) . ". " . $item['title'] ?></p>
<?php } ?>
<div class="work">
    <div class="work-preview-container">
        <?php foreach ($posts as $a): ?>
            <a class="work-preview"  href="<?php echo $a['link']; ?>">
                <img src="<?php echo $a['thumbnail']; ?>" />
                <h3>
                    <?php echo $a['title']; ?>
                </h3>
            </a>
        <?php endforeach; ?>
    </div>
</div>

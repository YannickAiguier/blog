<?php
require 'header.tpl';

if ($result == false):
    // pas d'articles
    print("\nRien dans la base !!!");
else:
    foreach ($result as $row) {
        printf("<li>%s : %s</li>", $row['pseudo'], $row['text']);
    }
endif;

require 'footer.tpl';
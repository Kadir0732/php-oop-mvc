<?php
Router::router("/blog/{user}/yazilar/{yazi}","blog:writers","GET");
Router::router("/blog/{user}/{yazi}","blog:writers","GET");
Router::notFindPage("notFindPage");

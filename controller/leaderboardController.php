<?php

class leaderboardController
{
public function defaultAction()
{
    $template = new template('index');
    $template->viewPage('leaderboard',["leaderboard"],[]);
}
}
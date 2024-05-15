<?php

class template {
    protected $layoutPage;
    private $users;
    private $rank;

    public function __construct($layoutPage)
    {
        $this->layoutPage = $layoutPage;
    }

    public function viewPage($pageName,$pageSections, $variables)
    {
        extract($variables);
//        var_dump($variables);
        include VIEW_PATH . $this->layoutPage . '.html';
    }

    public function viewSection($pageName,$pageSections)
    {
        foreach ($pageSections as $section) {
            include VIEW_PATH . "$pageName".'/' . $section . '.html';
        }
    }




    /// sorry
    ///
         public function getUsers(){
            $dbh = databaseConnection::getInstance();
            $dbc = $dbh->getConnection();
            $query = "SELECT * FROM user";
            $stmt = $dbc->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll();
            $this->users= $users;
        }

}
<?php

namespace Controllers;
require_once('../libraries/autoload.php');

class Comment extends \Controllers\Controller
{
    protected $modelName = \Models\CommentManager::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert()
    {
        //If the field of post are empty, redirect with a notatin get
        if(empty($_POST['contentCom'])){
            \Http::redirect("index.php?controllers=afficheur&task=afficheNewCom&user=" . $_GET['user']. "&actor=" . $_GET['actor'] . "&comEmpty=y");
        }
        //Else, find if a comment already is present
        $resp = $this->model->findOneComment($_GET['user'], $_GET['actor']);
        //If no comment already, add
        if(empty($resp)) {
            $resp = $this->model->postComment($_GET['actor'], $_GET['user'], $_POST['contentCom']);
            //Else redirect with a notation get
        } else {
                \Http::redirect("index.php?controllers=afficheur&task=afficheNewCom&user=" . $_GET['user']. "&actor=" . $_GET['actor'] . "&comAlready=y");
            }
    }
}
<?php
require_once 'resources/session.php';
require_once 'resources/Database.php';

/** Defining Class for Pagination */
	Class methodPaginationClass{

    public $SetDisplaySearchLimit;

    function __construct() {
        $this->SetDisplaySearchLimit = 2;
    }

    function getAllPageLinks($count,$href) {
        $output = '';
        if(!isset($_GET["page"])) $_GET["page"] = 1;

        if($this->SetDisplaySearchLimit !== 0)
            $pages  = ceil($count/$this->SetDisplaySearchLimit);



        if($pages>1) {
            $output = $output .'<nav aria-label="pagination example">
                <ul class="pagination pagination-circle pg-blue mb-0">';
            if($_GET["page"] == 1)
                $output = $output . '<li style="cursor:not-allowed;color: #bccfd8;" class="page-item disabled"><a class="page-link">First</a></li>
                                      <li style="cursor:not-allowed;color: #bccfd8;" class="page-item disabled"> <a class="page-link" aria-label="Previous">
                                       <span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>
                                        </a>
                                    </li>';
                                        else
                               $output = $output . '<li class="page-item"><a onclick="paymentMethod(\'' . $href . (1) . '\')" class="page-link">First</a></li>
                                      <li class="page-item"> <a onclick="paymentMethod(\'' . $href . ($_GET["page"]-1) . '\')" class="page-link" aria-label="Previous">
                                       <span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>
                                        </a>
                                    </li>';


            if(($_GET["page"]-3)>0) {
                if($_GET["page"] == 1)
                    $output = $output . '<li id=1 class="page-item active"><a class="page-link">1</a></li>';
                else
                    $output = $output . '<li class="page-item"><a onclick="paymentMethod(\'' . $href . '1\')" class="page-link">1</a></li>';
            }
            if(($_GET["page"]-3)>1) {
                $output = $output . '<li class="page-item" disabled><a class="page-link">...</a></li>';
            }

            for($i=($_GET["page"]-2); $i<=($_GET["page"]+2); $i++)	{
                if($i<1) continue;
                if($i>$pages) break;
                if($_GET["page"] == $i)
                    $output = $output . ' <li id='.$i.' class="page-item active"><a class="page-link">'.$i.'</a></li>';
                else
                    $output = $output . '<li class="page-item"><a onclick="paymentMethod(\'' . $href . $i . '\')"  class="page-link">'.$i.'</a></li>';

            }

            if(($pages-($_GET["page"]+2))>1) {
                $output = $output . '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
            if(($pages-($_GET["page"]+2))>0) {
                if($_GET["page"] == $pages)
                  $output = $output . '<li id=' . ($pages) .' class="page-item active"><a class="page-link">' . ($pages) .'</a></li>';
                else
                $output = $output . '<li class="page-item"><a onclick="paymentMethod(\'' . $href .  ($pages) .'\')"  class="page-link">' . ($pages) .'</a></li>';
            }

            if($_GET["page"] < $pages)
                             $output = $output . '<li class="page-item"> <a onclick="paymentMethod(\'' . $href . ($_GET["page"]+1) . '\')" class="page-link" aria-label="Previous">
                                       <span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a onclick="paymentMethod(\'' . $href . ($pages) . '\')" class="page-link">Last</a></li>';
            else
            $output = $output . '<li style="cursor:not-allowed;color: #bccfd8;" class="page-item disabled">
            <a style="cursor:not-allowed;color: #bccfd8;" class="page-link disabled" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        <li style="cursor:not-allowed;color: #bccfd8;" class="page-item disabled"><a class="page-link">Last</a></li>';


            $output = $output .'</ul></nav>';
        }
        return $output;
    }

    function getPrevNext($count,$href) {
        $output = '';
        if(!isset($_GET["page"])) $_GET["page"] = 1;
        if($this->SetDisplaySearchLimit != 0)
            $pages  = ceil($count/$this->SetDisplaySearchLimit);
        if($pages>1) {
            $output = $output .'<nav aria-label="pagination example">
                <ul class="pagination pagination-circle pg-blue mb-0">';
            if($_GET["page"] == 1)
                 $output = $output . '<li style="cursor:not-allowed;color: #bccfd8;" class="page-item disabled"><a class="page-link">Prev</a></li>';
            else
            $output = $output . '<li class="page-item"><a onclick="paymentMethod(\'' . $href . ($_GET["page"]-1) . '\')" class="page-link">Prev</a></li>';
            if($_GET["page"] < $pages)
            $output = $output . '<li class="page-item"><a onclick="paymentMethod(\'' . $href . ($_GET["page"]+1) . '\')" class="page-link">Next</a></li>';
            else
                $output = $output . '<li style="cursor:not-allowed;color: #bccfd8;" class="page-item disabled"><a class="page-link">Next</a></li>';

            $output = $output .'</ul></nav>';
        }
        return $output;
    }

}

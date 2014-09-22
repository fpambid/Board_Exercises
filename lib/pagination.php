<?php

class Pagination
{
    const MAX_ITEM = 5;
    const PAGE_LINKS = 4;
    const NEXT_PAGE = 1;
    const PREVIOUS_PAGE = 1;

    public static $last;
    public static $pagenum = 1;
    public static $limit;
    public static $pagination = array();

    public static function getLastPage($row_length)
    {
        self::$last = ceil($row_length/self::MAX_ITEM);

        if(self::$last < 1) {
            self::$last = 1;
        } 

        return self::$last;
    }
        //Get the last page 

    public static function getCurrPage($row_length)
    {
        $last_page = self::getLastPage($row_length);

        if(isset($_GET['pn'])) {
            self::$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
        }

        if(self::$pagenum > $last_page) {
            self::$pagenum = $last_page;
        }

        return self::$pagenum;
    }
        //Get the current page

    public static function getLimit($row_length)
    {
        $currpage = self::getCurrPage($row_length);

        self::$limit = ($currpage - 1) * self::MAX_ITEM .',' .self::MAX_ITEM;

        return self::$limit;
    }
        //Get the maximum number of item per page

    public static function getControls($row_length)
    {
        $last = self::getLastPage($row_length);
        $pagenum = self::getCurrPage($row_length);
        $limit = self::getLimit($row_length);

        $page_url =& $url['pn'];
        $pageCtrls = '';

        if($last != 1) {
            if($pagenum > 1) {

                $page_url = $pagenum - self::PREVIOUS_PAGE;
                $pageCtrls .= '<a href="'. url('', $url) .'">Previous</a> &nbsp; &nbsp';

                for($i = $pagenum - self::PAGE_LINKS; $i < $pagenum; $i++) {
                    if($i > 0) { 
                        $pageCtrls .= '<a href="'. url('', $url) .'">'.$i.'</a> &nbsp';
                    }
                }
            }

            $pageCtrls .= ''.$pagenum.' &nbsp; ';

            for($i = $pagenum + self::NEXT_PAGE; $i <= $last; $i++) {

                $page_url = $i;
                $pageCtrls .= '<a href="'.url('', $url).'">'.$i.'</a> &nbsp;';

                if($i >= $pagenum + self::PAGE_LINKS) {
                    break;
                }
            }

            if($pagenum != $last) {
                $page_url = $pagenum + self::NEXT_PAGE;
                $pageCtrls .= '&nbsp; &nbsp; <a href="'.url('', $url).'">Next</a>';
            }
        }

        self::$pagination['pagenum'] = $pagenum;
        self::$pagination['max'] = $limit;
        self::$pagination['control'] = $pageCtrls;
        self::$pagination['last_page'] = $last;
   
        return self::$pagination;
    }
}
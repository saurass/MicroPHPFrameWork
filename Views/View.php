<?php

/**
 * Created by PhpStorm.
 * User: Saurass
 * Date: 02-03-2018
 * Time: 07:15
 */
class View
{
    public static function viewPage($viewname)
    {
        $path = str_replace('.', '/', $viewname);
        $path = $path . '.view.php';
        if (file_exists(__DIR__.'/Pages/'.$path)){
            $view_obj = new View();
            $content = $view_obj->parse_viewPage($path);
            $handle=fopen(__DIR__.'/compiler.php','w');
            fwrite($handle,$content);
            fclose($handle);
            include_once __DIR__.'/compiler.php';
        }else{
            die("File Not Found !!");
        }
    }

    private function parse_viewPage($path)
    {
        $page_content = file_get_contents(__DIR__.'/Pages/'.$path);
        $view_obj = new View();
        $parsed_page_content = $view_obj->parse_with_view_engine($page_content);
        return $parsed_page_content;
    }

    private function parse_with_view_engine($content)
    {
        include __DIR__ . '/ViewCustomDirectivesDefinitions.php';
        foreach ($directives as $directive) {
            $content=str_replace($directive, $directives_definition[$directive], $content);
        }
        //echo "<script>alert('".$content."')</script>";
        return $content;
    }
}
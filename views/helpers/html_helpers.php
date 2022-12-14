<?php
class html_helpers
{
    public static function url($options = null)
    {
        if ($options == '/') {
            return 'index.php';
        }

        global $cn, $app;
        if (!isset($options['ctl'])) {
            $options['ctl'] = $cn;
            //$options['ctl'] = $app['ctl'];
        }
        $act = '';
        if (isset($options['act'])) {
            $act = '&act=' . $options['act'];
            //$options['act'] = $app['act'];
        }
        $cate = '';
        if (isset($options['cate'])) {
            $cate = '&cate=' . $options['cate'];
            //$options['act'] = $app['act'];
        }
        $params = '';
        if (isset($options['params']) and $options['params']) {
            foreach ($options['params'] as $k => $v) {
                $params .= '&' . $k . '=' . $v;
            }
        }
        return 'index.php?ctl=' . $options['ctl'] . $act . $cate . $params;
    }

    public static function _media($buffer)
    {
        global $obMediaFiles;

        $content = $buffer;

        $cssFiles = "";
        if (isset($obMediaFiles['css']) && count($obMediaFiles['css'])) {
            foreach ($obMediaFiles['css'] as $css) {
                $cssFiles .= '<link href="' . $css . '" rel="stylesheet">';
            }
        }
        $content = str_replace("CSSABOVE", $cssFiles, $content);

        $jsFiles = "";
        if (isset($obMediaFiles['js']) && count($obMediaFiles['js'])) {
            foreach ($obMediaFiles['js'] as $js) {
                $jsFiles .= '<script src="' . $js . '"></script>';
            }
        }
        $content = str_replace("JSBOTTOM", $jsFiles, $content);

        return $content;
    }

    public static function cssHeader()
    {
        global $mediaFiles;
        $cssFiles = "";
        if (isset($mediaFiles['css']) && count($mediaFiles['css'])) {
            foreach ($mediaFiles['css'] as $css) {
                $cssFiles .= '<link href="' . $css . '" rel="stylesheet">';
            }
        }
        return $cssFiles;
    }
    public static function Tree($object, &$tree)
    {
        if (!isset($object['tree_path'])) {
            $object['tree_path'] = $object['path'];
        }
        $arr = explode(".", $object['path']);
        if (count($arr) == 1) {
            // $tree=array_merge($tree,array($arr[0]=>$object));
            $tree[$arr[0]] = $object;
            return $tree;
        }
        if (count($arr) != 1) {
            //  $a=implode(".", array_slice($arr, 1)).' ';
            //  echo '<br>(';
            //  print_r ($a);
            $current = $arr[0];
            $object['path'] = implode(".", array_slice($arr, 1));
            if (isset($tree[$current]['child'])) {
                return static::Tree($object, $tree[$current]['child']);
            } else {
                $tree[$current]['child'] = [];
                return static::Tree($object, $tree[$current]['child']);
            }
        }
    }
    public static function treeview($tree)
    {

        $treeView = '<ul>';
        foreach ($tree as $x => $val) {
            // if($num==count($tree)){
            //     $treeView.='<li>'.$tree[$x]['name'];
            //     if(isset($tree[$x]['child'])){
            //         treeview($tree[$x]['child'],$treeView);
            //     };
            // }else if($num==1){
            //     $treeView.=$tree[$x]['name'];
            //     if(isset($tree[$x]['child'])){
            //         treeview($tree[$x]['child'],$treeView);
            //     };
            //     $treeView.='</li>';
            // }else {
            //     $treeView.='</li><li>'.$tree[$x]['name'];
            // }
            $act = '<a class="btn btn-outline-info table-link" role="button" href=""><i class="fa fa-eye" aria-hidden="true"></i></a>';

            $treeView .= '<li id="' . $tree[$x]['tree_path'] . '">' . $tree[$x]['name'];
            if (isset($tree[$x]['child'])) {
                $treeView .= static::treeview($tree[$x]['child']);
            }
            $treeView .= '</li>';
        }
        return $treeView . '</ul>';
    }
    public static function getChild($tree){
        $child = $tree['path'];
        if(isset($tree['child'])) {
            foreach($tree['child'] as $v){
                $child.= ','.static::getChild($v);
            }
        }
        return $child;
    }
    public static function menuW3($tree){
        $treeView = '<ul class="nested">';
        foreach ($tree as $x => $val) {
            // if($num==count($tree)){
            //     $treeView.='<li>'.$tree[$x]['name'];
            //     if(isset($tree[$x]['child'])){
            //         treeview($tree[$x]['child'],$treeView);
            //     };
            // }else if($num==1){
            //     $treeView.=$tree[$x]['name'];
            //     if(isset($tree[$x]['child'])){
            //         treeview($tree[$x]['child'],$treeView);
            //     };
            //     $treeView.='</li>';
            // }else {
            //     $treeView.='</li><li>'.$tree[$x]['name'];
            // }

            // if (isset($tree[$x]['child'])) {
            //     $treeView .= '<li><a data-path="'.$tree[$x]['path'].'" class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $tree[$x]['name'] . '</a>' . static::menu($tree[$x]['child'],'submenu') . '</li>';
            // } else {
            //     $treeView .= '<li><a class="dropdown-item" href="#">' . $tree[$x]['name'] . '</a></li>';
            // }
            if (isset($tree[$x]['child'])) {
                $treeView .= '<li class="list-group-item"><span class="caret"><a href="' . static::url(['ctl' => $_GET['ctl'], 'params' => ['category_id' => static::getChild($tree[$x])]]) . '" class="menu-link">' . $tree[$x]['name'] . '&nbsp;&nbsp;&nbsp;&nbsp;</a></span>' . static::menuW3($tree[$x]['child']) . '</li>';
            } else {
                $treeView .= '<li class="list-group-item"><a href="' . static::url(['ctl' => $_GET['ctl'], 'params' => ['category_id' => $tree[$x]['path']]]) . '" class="menu-link">' . $tree[$x]['name'] . '</a></li>';

            }
        }
        return $treeView . '</ul>';
    }
    public static function menu($tree)
    {
        $treeView = '<ul class="submenu">';
        foreach ($tree as $x => $val) {
            // if($num==count($tree)){
            //     $treeView.='<li>'.$tree[$x]['name'];
            //     if(isset($tree[$x]['child'])){
            //         treeview($tree[$x]['child'],$treeView);
            //     };
            // }else if($num==1){
            //     $treeView.=$tree[$x]['name'];
            //     if(isset($tree[$x]['child'])){
            //         treeview($tree[$x]['child'],$treeView);
            //     };
            //     $treeView.='</li>';
            // }else {
            //     $treeView.='</li><li>'.$tree[$x]['name'];
            // }

            // if (isset($tree[$x]['child'])) {
            //     $treeView .= '<li><a data-path="'.$tree[$x]['path'].'" class="dropdown-item dropdown-toggle" href="#" id="multilevelDropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $tree[$x]['name'] . '</a>' . static::menu($tree[$x]['child'],'submenu') . '</li>';
            // } else {
            //     $treeView .= '<li><a class="dropdown-item" href="#">' . $tree[$x]['name'] . '</a></li>';
            // }
            if (isset($tree[$x]['child'])) {
                $treeView .= '<li class="dropdown-li has-dropdown" ><a  href="' . static::url(['ctl' => 'menu', 'params' => ['category_id' => static::getChild($tree[$x])]]) . '" class="menu-link">' . $tree[$x]['name'] . '&nbsp;&nbsp;&nbsp;&nbsp;<span class="arrow"></span></a>' . static::menu($tree[$x]['child']) . '</li>';
            } else {
                $treeView .= '<li class="dropdown-li"><a  href="' . static::url(['ctl' => 'menu', 'params' => ['category_id' => $tree[$x]['path']]]) . '" class="menu-link">' . $tree[$x]['name'] . '</a></li>';

            }
        }
        return $treeView . '</ul>';
    }
    public static function treeSelection($tree, $space = null, $treeView = null)
    {
        foreach ($tree as $x => $val) {
            $path = explode('.', $tree[$x]['tree_path']);
            $id = $path[count($path) - 1];
            $treeView .= '<option value="' . $id . '">' . $space . $tree[$x]['name'] . '</option>';
            if (isset($tree[$x]['child'])) {
                $treeView .= static::treeSelection($tree[$x]['child'], $space . '&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }
        return $treeView;
    }
    public static function jsFooter()
    {
        global $mediaFiles;

        $jsFiles = "";
        if (isset($mediaFiles['js']) && count($mediaFiles['js'])) {
            foreach ($mediaFiles['js'] as $js) {
                $jsFiles .= '<script src="' . $js . '"></script>';
            }
        }
        return $jsFiles;
    }

    public static function header($layout, $options = null)
    {
        include_once 'views/layout/' . $layout . 'header.php';
    }

    public static function footer($layout, $options = null)
    {
        include_once 'views/layout/' . $layout . 'footer.php';
    }
}

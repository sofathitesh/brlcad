<?php

/**
 * Plugin Name : XML PARSE
 * Author : Hitesh Sofat
 * Url : hiteshkumarsofat.wordpress.com
 */

header('Content-Type:text/html; charset=utf-8; charset=ISO-8859-1');
add_action('init', 'code_button');

function code_button()
{
    add_filter("mce_external_plugins", "code_add_button");
    add_filter("mce_buttons", "code_register_button");
}

function code_add_button($plugin_array)
{
    $plugin_array['mycodebutton'] = $dir = plugins_url('shortcode.js', __FILE__);
    return $plugin_array;
}

function code_register_button($buttons)
{
    array_push($buttons, 'codebutton');
    return $buttons;
}
add_action('admin_menu', 'register_my_custom_menu_page');

function register_my_custom_menu_page()
{
    add_menu_page('custom menu title', 'xml parser', 'manage_options', 'xmlparse', 'my_custom_menu_page', '', 6);
}

function my_custom_menu_page()
{
    $html="
        <form action='' method='post' enctype='multipart/form-data'>
            <table>
                <tr>
                    <td>Enter Language Name</td>
                    <td><input type='text' name='t1' required></td>
                </tr>
                <tr>
                    <td><input type='file' name='f'></td>
                </tr>
                <tr>
                    <td><input type='submit' name='s' value='Upload'>(Only xml file allowed)</td>
                </tr>
            </table>
        </form>";
    echo $html;
    if (isset($_POST['s'])) {
        parse();
    }
}

function language_convert($atts)
{
    $dir = "/home/hitesh/brlcad/doc/docbook/articles/*";
    $default_xsl_dir = "/home/hitesh/brlcad/doc/docbook/";
    $default_dir = "/home/hitesh/brlcad/doc/docbook/articles/";
    $dir = glob($dir, GLOB_ONLYDIR);
    $size = sizeof($dir);
    $c = 0;
    for ($i = 0; $i < $size; $i++) {
        $r = explode("/", $dir[$i]);
        $t[$c] = end($r);
        $c++;
    }
    $new_size = sizeof($t);
    echo "<form action='' method='post'><table style='width:30%'><tr><td><select name='s1'><option>Select the lanuage</option>";
    for ($tt = 0; $tt <= $new_size; $tt++) {
        if (strlen($t[$tt]) < 4) {
            echo "<option>".$t[$tt]."</option>";
    }
    }
    echo "</select></td><td><input type='submit' value='change'></td></tr></table></form>";
    if (isset($_POST['s1'])) {
        if ($_POST['s1'] == 'en') {
            $xml_def = new DOMDocument;
            $xml_def->load($default_dir.'/en/about.xml');
            $xsl_def = new DOMDocument;
            $xsl_def->load($default_xsl_dir.'/resources/brlcad/brlcad-presentation-xhtml-stylesheet.xsl');
            $proc_def = new XSLTProcessor;
            $proc_def->importStyleSheet($xsl_def); // attach the xsl rules
            $extra_data = $proc_def->transformToXML($xml_def);
            $remove_extra_data = str_replace("Christopher", "", $extra_data);
            $remove_extra_data2 = str_replace("Sean", "", $remove_extra_data);
            echo $remove_extra_data3 = str_replace("Morrison", "", $remove_extra_data2);
        }
        else {
            $xml = new DOMDocument;
            $xml->load($default_dir.$_POST['s1'].'/about_'.$_POST['s1'].'.xml');
            $xsl_def = new DOMDocument;
            $xsl_def->load($default_xsl_dir.'/resources/brlcad/brlcad-presentation-xhtml-stylesheet.xsl');
            $proc_def = new XSLTProcessor;
            $proc_def->importStyleSheet($xsl_def); // attach the xsl rules
            $extra_data = $proc_def->transformToXML($xml);
            $remove_extra_data = str_replace("Christopher", "", $extra_data);
            $remove_extra_data2 = str_replace("Sean", "", $remove_extra_data);
            $remove_extra_data3 = str_replace("Morrison", "", $remove_extra_data2);
            $remove_extra_data4 = str_replace("Karen", "", $remove_extra_data3);
            $remove_extra_data5 = str_replace("Mgebrova", "", $remove_extra_data4);
           echo  $remove_extra_data6 = str_replace("Ilya", "", $remove_extra_data5);

        }
    }
    else {
        $xml_def = new DOMDocument;
        $xml_def->load($default_dir.'/en/about.xml');
        $xsl_def = new DOMDocument;
        $xsl_def->load($default_xsl_dir.'/resources/brlcad/brlcad-presentation-xhtml-stylesheet.xsl');
        $proc_def = new XSLTProcessor;
        $proc_def->importStyleSheet($xsl_def); // attach the xsl rules
        $extra_data = $proc_def->transformToXML($xml_def);
        $remove_extra_data = str_replace("Christopher", "", $extra_data);
        $remove_extra_data2 = str_replace("Sean", "", $remove_extra_data);
        echo $remove_extra_data3 = str_replace("Morrison", "", $remove_extra_data2);
    }
}
add_shortcode('search', 'language_convert');
?>                                                                                                                             

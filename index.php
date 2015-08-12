<?php

require_once('lib/inc/functions.php');
$page = new MSDLabPage;
$page->do_header();

if(!empty($_POST)){
    $template = file_get_contents('lib/template/bluechip_placeholder.html');
    foreach($_POST AS $k => $v){
        $patterns[] = '~'.$k.'~i';
        $replacements[] = $v;
    }
    $patterns[] = '~__YEAR__~i';
    $replacements[] = date("Y");
    $patterns[] = '~__JSON_SITE_URL__~i';
    $replacements[] = mysql_real_escape_string($_POST['__SITE_URL__']);
    $patterns[] = '~__JSON_SITE_TITLE__~i';
    $replacements[] = mysql_real_escape_string($_POST['__SITE_TITLE__']);
    
    $placeholder = preg_replace($patterns,$replacements,$template);
    ts_data($placeholder);
} else {
    ?>
    <form class="form" enctype="multipart/form-data" method="post">
        <h2 class="form-heading">Create Placeholder Page</h2>
        <?php
            $form_elements = array(
            '__SITE_TITLE__' => 'Site Title',
            '__SITE_DESCRIPTION__' => 'Site Description',
            '__SITE_URL__' => 'Site Url',
            '__LOGO_URL__' => 'Logo Url',
            '__COMING_SOON_MESSAGE__' => 'Coming Soon Message',
            '__STREET_ADDRESS__' => 'Street Address',
            '__CITY__' => 'City',
            '__STATE__' => 'State',
            '__ZIP__' => 'Zip',
            '__PHONE__' => 'Phone',
            '__FACEBOOK_URL__' => 'Facebook Url',
            '__LINKEDIN_URL__' => 'Linkedin Url',
            '__TWITTER_URL__' => 'Twitter Url',
            );
            foreach($form_elements AS $k=>$v){
                print '
                <label class="sr-only" for="'.$k.'">'.$v.'</label>
                <input type="text" placeholder="'.$v.'" class="form-control" name="'.$k.'" id="'.$k.'">
                ';
            }
        ?>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Create</button>
      </form>
    <?php
}
$page->do_footer();

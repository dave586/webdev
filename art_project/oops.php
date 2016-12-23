<?php


include_once 'components/includes.php';


function messageGen(){
$output='';
    $code=0;
if(isset($_GET["code"])){$code=$_GET["code"];}else{};



if($code==1){
$output= '<div class="ui icon message">
        <i class="warning sign icon"></i>
        <div class="content">
            <div class="header">well the '.'"site map"'.' is not implemented</div>
            <p>A site map is basically a model of a website internal contents that helps both users and search engines navigate the site. For users it could be a HTML file contains a list of all the important/useful pages on a site. For search engines it is also known as a sitemap.xml file (that is made up of xml code), that supports a search engine crawlers in index pages on a site. I felt it is important to mention this, however it was not build due to the requirements of this website.  </p>
        </div>
    </div>';



}else if($code==2){
    $output= '<div class="ui icon message">
        <i class="warning sign icon"></i>
        <div class="content">
            <div class="header">about why the '.'"Terms and Conditions"'.' is not implemented</div>
            <p>A Terms and Conditions agreement is the agreement where the site owners(in this case me) tells the users about rules, restrictions,copyrights, and other legal information they have to follow in order to use and access the site. I felt it is best practice to mention about this, due to the requirements when this site was still a project, terms and conditions was not needed.   </p>
        </div>
    </div>';



}else if($code==3){

    $output= '<div class="ui icon message">
        <i class="warning sign icon"></i>
        <div class="content">
            <div class="header">about why the '.'"Blog"'.' is not implemented </div>
            <p>There could be a possible blog, but it was not outlined in the requirements when this site was still an assignment. Thus it is not implemented.</p>
        </div>
    </div>';



}else if($code==4){


    $output= '<div class="ui icon message">
        <i class="warning sign icon"></i>
        <div class="content">
            <div class="header">about the the '.'"Account"'.' </div>
            <p>It was not outlined in the requirements when this site was still an assignment. Thus it is not implemented.</p>
        </div>
    </div>';





}else{

    $output= '<div class="ui icon message">
        <i class="warning sign icon"></i>
        <div class="content">
            <div class="header">well hello </div>
            <p>this page mainly tells the user why some of the functions were not implemented</p>
        </div>
    </div>';




};




echo $output;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
echo generateHead("OOPS");
?>

<body>
<?php
echo generateHeader();
?>
<main>
    <h2 class="ui horizontal divider"></h2>
<h1 class="ui header center aligned">
   OOPS
</h1>


<div class="ui raised segment">



    <div class="ui icon message">
        <i class="comment outline icon"></i>
        <div class="content">
            <div class="header">well it seems this page isn't implemented, due to the nature of this website (just to show off my amazing skills) it might not ever be implemented </div>
            <p>however the following is why</p>
        </div>
    </div>
    <?php messageGen();?>

</div>

</main>
<?php
echo generateFooter();
?>
</body>

</html>
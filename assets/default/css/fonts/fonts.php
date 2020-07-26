

<?php header("Content-type: text/css; charset: UTF-8"); ?>
<?php $site_font = $_GET['font']; ?>

body{
    font-family: '<?=$site_font?>', sans-serif !important;
    font-size: 14px;
    background:#f5f5f5;
    overflow-x: hidden;
    position: relative;
}


.section-title h1, .section-title h2, .section-title h3, .section-title h4 ,.section-title h5{
    font-size: 18px;
    font-family: '<?=$site_font?>', sans-serif;
    font-weight: 600;
    position: relative;  
    border-bottom: 2px solid #333;
}

.cbp-l-loadMore-link.site-btn{
    font-family: '<?=$site_font?>', sans-serif !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border: 0 !important;
    border-radius: 50px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    padding: 1px 29px !important;
    line-height: 35px !important;
}

h1, h2, h3, h4, h5, h6{
    font-family: '<?=$site_font?>', sans-serif;
}

header nav ul li a {
    font-family: '<?=$site_font?>', sans-serif;
}

.habout{
    font-family: '<?=$site_font?>', sans-serif;
    margin-top: 10px;
    line-height: 22px;
    font-size: 14px;
}

p.post_details {
    font-size: 16px;
    font-family: '<?=$site_font?>', sans-serif;
    color: #333 !important;
    line-height:27px;
}

.arlo_tm_leftpart_wrap .menu_list_wrap ul li{margin:0px;}
.arlo_tm_leftpart_wrap .menu_list_wrap ul li:last-child{margin-bottom: 0px;}
.arlo_tm_leftpart_wrap .menu_list_wrap ul li a{
    text-decoration: none;
    color: #fff;
    font-family: '<?=$site_font?>', sans-serif;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    position: relative;
    display: inline-block;
    padding-bottom: 19px;
    
    -webkit-transition: all .3s ease;
       -moz-transition: all .3s ease;
        -ms-transition: all .3s ease;
         -o-transition: all .3s ease;
            transition: all .3s ease;
}
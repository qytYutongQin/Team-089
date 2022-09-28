<?php function fameup_color_css() { ?>

<style type="text/css">

:root {
  --secondary-color: #121418;
  --head-color: #212121;
  --stext-color: #000;
  --text-color: #5b5b5b;
  --wtext-color: #fff;
  --bg-color: #fff;
  --box-color: #fff;
  --wrap-color: #eee;
}
/*=#0c59db*/
::selection {
	color: white;
	background: #c69c53;
}

.bs-latest-news.two .bn_title h2:before {
    background-color: var(--head-color);
}

.bs-default.five .bs-head-detail {
    background: var(--secondary-color);
}
/*=#0c59db*/
/* --wrap-color: #eff2f7; */


.sidenav.offcanvas {
	background: #fff;
	color: var(--secondary-color);
}
.sidenav .btn_close,
.sidenav .navbar-nav a.nav-link {
	color: #000;
}
.sidenav .btn_close:hover,
.sidenav .navbar-nav a.nav-link:hover {
	color: #c69c53;
}
.sidenav .dropdown-menu {
	background: var(--secondary-color);
}
.sidenav .dropdown-item {
	color: #fff;
}
.sidenav .dropdown-item:hover, .sidenav .dropdown-item:focus {
	background: #c69c53;
	color: #fff;
}
.bs-blog-thumb.toggle {
    background-color: transparent;
}
.toggle-container.two{
	background-color: var(--bg-color);
}

/*==================== default header ====================*/
.bs-head-detail {
	background: var(--bg-color);
	border-bottom-color: rgba(185, 185, 185, 0.5);
}
.bs-head-detail .info-left li a , .bs-head-detail li a i, .bs-head-detail .info-right li a {
	color: #fff;
}
.bs-head-detail .top-date {
	color: var(--head-color);
}
.bs-head-detail .time {
	background: #c69c53;
	color: #fff;
}
.bs-latest-news .bn_title h2 {
	background: var(--head-color);
	color: var(--wtext-color);
}
.bs-latest-news .bs-latest-news-slider a {
	color: var(--text-color);
}
.bs-latest-news  h6.headline {
    color: var(--bg-color);
   
}
.bs-latest-news.two  {
	background: var(--box-color);
	color: var(--text-color);
}
.bs-latest-news.two .bn_title h2:before {
    background-color: var(--head-color);   
}  
.bs-default .navbar-wp .navbar-nav > li > a {
    color: var(--head-color);
}
.navbar-wp .navbar-nav > li > a {
    color: var(--head-color);
}
.bs-default .navbar-wp .navbar-nav > li > a:hover, 
.bs-default .navbar-wp .navbar-nav > li > a:focus, 
.bs-default .navbar-wp .navbar-nav > .active > a, 
.bs-default .navbar-wp .navbar-nav > .active > a:hover, 
.bs-default .navbar-wp .navbar-nav > .active > a:focus {
    color: #c69c53;
}
.bs-default .bs-header-main .inner{
	background-color: var(--bg-color);
}

.navbar-wp {
	background: var(--bg-color);
	border-color: rgba(185, 185, 185, 0.5);
}
.navbar-wp .dropdown-menu {
	background: var(--bg-color);
}
.navbar-wp .dropdown-menu > li > a {
	background: var(--bg-color);
	color: var(--text-color);
}
.navbar-wp .dropdown-menu > li > a:hover,
.navbar-wp .dropdown-menu > li > a:focus  {
	background: #c69c53;
	color: white;
}
.navbar-wp .dropdown-menu.searchinner .btn {
	background: #c69c53 !important;
	color: #fff !important;
}
.navbar-wp .dropdown-menu.searchinner .btn:hover {
	background-color: #121418;
	color: #fff;
}
/* ---bs-default two-- */

.bs-headtwo .navbar-wp .navbar-nav > li > a {
    color: var(--head-color);
}

/* ---bs-default three-- */
.bs-headthree .bs-header-main .inner {
    background-color: var(--bg-color);
}
.bs-headthree .navbar-wp .navbar-nav > li > a {
    color: var(--head-color);
}
.bs-headthree .bs-head-detail {
	background: var(--secondary-color);
	
}
.bs-headthree .bs-latest-news .bs-latest-news-slider a {
	color: var(--head-color);
}

/* ---bs-default four-- */

.bs-headfour .bs-head-detail {
    background-color: var(--secondary-color);
}
.bs-headfour .bs-head-detail .top-date {
    color: var(--bg-color);
}
.bs-headfour .navbar-wp .navbar-nav > li > a {
    color: var(--head-color);
}

/* ---bs-default five-- */
.bs-headfive .bs-head-detail {
    background: var(--secondary-color);
}
.bs-headfive .navbar-wp .navbar-nav > li > a {
    color: var(--bg-color);
}
.bs-headfive .navbar-wp {
    background: rgba(0, 0, 0, 0.5);
}
.bs-headfive .desk-header i {
	color: var(--bg-color);
}
.bs-head-detail .bs-latest-news {
    background: unset;
}
.bs-head-detail .bs-latest-news .bs-latest-news-slider a {
	color: #fff;
}
/* ---bs-default six-- */
.bs-headsix .bs-head-detail {
    background: var(--wrap-color);  
}
.bs-headsix .bs-header-main .inner{
	background-color: var(--bg-color);
}
.bs-headsix868 [role=button] {
    cursor: pointer;
    padding: 15px 0;
}
.btn.btn-subscribe {
	color: var(--text-color);
    border-color: #c69c53;
}
.btn.btn-subscribe:hover {
	background: var(--secondary-color);
    color: #fff;
    border-color: var(--secondary-color);
}
.bs-default .desk-header .msearch:hover { 
    color: var(--head-color);
}
.wp-block-search__input:hover, .wp-block-search__inside-wrapper .wp-block-search__input:focus {
	border-color: #c69c53;
}
.wp-block-latest-comments__comment-excerpt p{
	color: var(--head-color);
}
.post-share-icons a:hover{
	color: var(--head-color);
}
/*==================== Offcanvas-header ====================*/
.offcanvas-body h1, .offcanvas-body h2, .offcanvas-body h3, .offcanvas-body h4, .offcanvas-body h5, .offcanvas-body h6 {
	color: #212121;
}
/*==================== Body & Global ====================*/
.wrapper {
    background: var(--wrap-color);
}
body {
	color: #5b5b5b;
}
input:not([type]), input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], textarea {
	color: #9b9ea8;
	border-color: #eef3fb;
}
.form-control:hover, textarea:hover, input:not([type]):hover, input[type="email"]:hover, input[type="number"]:hover, input[type="password"]:hover, input[type="tel"]:hover, input[type="url"]:hover, input[type="text"]:hover, input:not([type]):focus, input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="tel"]:focus, input[type="url"]:focus, input[type="text"]:focus {
	border-color: #c69c53;
}
input[type="submit"], button {
	background: #c69c53;
	border-color: #c69c53;
	color: #fff;
}
input[type="submit"]:hover, button:hover,input[type="submit"]:focus, button:focus {
	background: var(--secondary-color);
	border-color: var(--secondary-color);
	color: #fff;
}
a {
	color: #c69c53;
}
a:hover, a:focus {
	color: var(--secondary-color);
}
.wp-block-calendar tbody td{
	color: var(--text-color);
}
.bs-error-404 h1 i {
	color: #c69c53;
}
.grey-bg {
	background: #f4f7fc;
}
.bs .swiper-button-prev, 
.bs .swiper-button-next {
	background: var(--secondary-color);
	color: #fff;
}
.bs .swiper-button-prev:hover,
 .bs .swiper-button-next:hover  {
	background: #c69c53;
	color: #fff;
}
.homemain .bs-blog-thumb.lg {
	background-color: var(--box-color);
}
.thumbs-slider2.bs .swiper-button-prev,
 .thumbs-slider2.bs .swiper-button-next {
    background: rgba(0,0,0,0.3);
    color: #fff;
}

.homemain.three.bs .swiper-button-prev,
 .homemain.three.bs .swiper-button-next {
    background: var(--bg-color);
    color: #c69c53;
	box-shadow: 0 0 17px 8px rgb(212 212 212 / 50%);
}
.homemain.three.bs .swiper-button-prev:hover,
 .homemain.three.bs .swiper-button-next:hover {
    background: #c69c53;
    color: var(--bg-color);
  
}
.homemain.three.bs .swiper-button-prev:focus,
 .homemain.three.bs .swiper-button-next:focus {
    background: #c69c53;
    color: var(--bg-color);
}
.bs-social li a {
	background: var(--bg-color);
	color: var(--text-color);
	 border-color: #E0E0E0;
}
.bs-social li a i {
	color: var(--text-color);
}
.bs-social li a:hover, .bs-social li a:focus {
	background: #c69c53;
	color: #fff;
	border-color: #c69c53;
}
.bs-social li a:hover i, .bs-social li a:focus i { 
	color: #fff; 
}
.bs-widget.promo {
	background-color: #eee;
}
.bs-widget.promo:hover .text::before{
	border-top-color: #c69c53;
    border-right-color: #c69c53;
}
.bs-widget.promo:hover .text::after{
	border-bottom-color: #c69c53;
    border-left-color: #c69c53;
}
.bs-widget.promo .inner-content {
    background: rgba(0, 0, 0, 0.1);
}
.bs-widget.promo:hover .inner-content {
    background: rgba(255, 255, 255, 0.8);
}
.bs-widget.promo h5 a { 
	color: var(--text-color);
    background: var(--bg-color);
}
.bs-widget.promo:hover h5 a, .bs-widget.promo h5 a:focus { 
	background: #c69c53;
	color: #fff;
}
.bs-widget .bs-widget-tags a{
	color: var(--text-color);
    background: var(--bg-color);
    border-color: #d7d7d7;
}
.tabarea-area .nav-tabs .nav-link {
	background: var(--bg-color);
	color: var(--text-color);
	border-color: #eee;
}
.tabarea-area .nav-tabs .nav-link:hover,.tabarea-area .nav-tabs .nav-link:focus, 
.tabarea-area .nav-tabs .nav-link.active {
	background: #c69c53;
	color: #fff;
	border-color: #c69c53;
}
/*==================== widget latest ====================*/
.media.bs-latest .title a {
    color: var(--head-color);
}
.media.bs-latest .title a:hover {
    color: #c69c53;
}
.bs-category a {
	color: #c69c53;
	background-color: var(--bg-color);
}
/*==================== widget Title ====================*/
.missed {
	background: var(--bg-color);
}
/*==================== widget Title ====================*/
.bs-widget-title {
	color: var(--head-color);
    border-color: #d7d7d7;
}
.bs-blog-category a:after {
    background-color: #c69c53;
}
.bs-widget-title:after, .bs-widget-title:before {
    border-color: #d7d7d7;
}
.bs-widget-title.two {
    border-color: #d7d7d7;
}
.bs-widget-title.two .title {
	background: #c69c53;
	color: #fff;
}

blockquote::before {
    color: #c69c53;
}

/*==================== featured tab widget ====================*/
.featured-tab-widget .nav-link.active, .featured-tab-widget .nav-link:hover, .featured-tab-widget .nav-link:focus {
    color: #c69c53;
}
.featured-tab-widget .nav-link {
    color: var(--secondary-color);
}
/*==================== Blog ====================*/
.small-post  {
	background: var(--box-color);
}
.small-post h5.title a {
	color: var(--head-color);
}
.small-post h5.title a:hover, .small-post h5.title a:focus {
	color: #c69c53;
}
/*==================== Blog ====================*/
.bs-blog-post {
	background: var(--box-color);
}
.bs-blog-post .small {
    color: var(--text-color);
}
.bs-blog-post .single .nav-links a, .bs-blog-post .single .single-nav-links a {
    color: var(--head-color);
}
.bs-blog-post .single .nav-links a:hover, .bs-blog-post .single .single-nav-links a:hover {
    color: #c69c53;
}
.bs-blog-post.two .small {
    background: var(--box-color);
    color: var(--text-color);
}
.bs-blog-post.three .title a {
	color: #fff;
}
.bs-blog-post.three .bs-blog-meta a {
    color: #fff;
}
.bs-blog-post.four .small {
    background-color: var(--box-color);
}
.bs-blog-post .bs-header .bs-blog-date {
    color: var(--text-color);
}
.bs-widget .recentarea-slider .media.bs-blog-post  {
	border-color: #d7d7d7;
}
.bs-widget .bs-author h4{
	color: var(--head-color);
}
.bs-widget .bs-author {
	color: var(--text-color);
}
.media.bs-blog-post {
	background: unset;
	border-color: #d7d7d7;
}
.media.bs-blog-post a {
	color: var(--text-color);
}
.media.bs-blog-post a:hover, .media.bs-blog-post a:focus {
	color: #c69c53;
}

.bs-blog-thumb .bs-blog-inner.two::after {
     background-color: transparent; 
}
.bs-blog-thumb .bs-blog-inner h4, .bs-blog-thumb .bs-blog-inner h4 a{
	color: var(--head-color);
}
.bs-blog-thumb .bs-blog-inner h4:hover, .bs-blog-thumb .bs-blog-inner h4 a:hover, .bs-blog-thumb .bs-blog-inner h4 a:focus{
	color: #c69c53;
}
.bs-blog-thumb .bs-blog-inner.two h4, .bs-blog-thumb .bs-blog-inner.two h4 a {
    color: var(--bg-color);
}
.bs-blog-inner.two .bs-blog-category a {
    color: var(--wrap-color);
}
.bs-blog-category:before {
    background: #c69c53;
}
.bs-blog-category a {
	color: #c69c53;
}
.bs-blog-category a:hover, .bs-blog-category a:focus {
	color: var(--text-color);
}
.bs-blog-post h4.title, .bs-blog-post h4.title a,.bs-blog-post h1.title, .bs-blog-post h1.title a {
	color: var(--head-color);
}
.bs-blog-post h4.title a:hover, .bs-blog-post h4.title a:focus, .bs-blog-post h1.title a:hover, .bs-blog-post h1.title a:focus {
	color: #c69c53;
}
.bs-author:before, .bs-blog-date:before, .comments-link:before, .cat-links:before, .tag-links:before {
    color: #c69c53;
}
.bs-blog-meta, .bs-blog-meta a{
	color: var(--text-color);
}
.bs-blog-thumb.toggle .bs-blog-inner .bs-blog-category a{
	color: var(--wrap-color);
}
.bs-blog-thumb.toggle .bs-blog-inner h4 a{
 color: var(--bg-color);
}
.bs-blog-thumb.toggle  .bs-blog-meta a {
    color: var(--bg-color);
}
.bs-blog-meta a:hover, .bs-blog-meta a:focus{
	color: #c69c53;
}
.bshre .post-share-icons a {
	background-color: var(--box-color);
}
.bshre .post-share-icons a {
	color: var(--text-color);
}
.post-share-icons a:hover {
	border-color: #c69c53;
}
.bs-info-author-block {
	background: var(--box-color);
}
.bs-info-author-block .bs-author-pic img,.comments-area img.avatar {
    border-bottom-color: #c69c53;
    border-left-color: #c69c53;
    border-top-color: #e5e5e5;
    border-right-color: #e5e5e5;
}
.bs-info-author-block h4 a {
   color: var(--head-color);
}
.bs-info-author-block h4 a:hover, .bs-info-author-block h4 a:focus {
   color: #c69c53;
}
.comments-area a {
	color: var(--head-color); 
}
.comments-area a {
	color: var(--head-color); 
}
.comments-area .reply a {
	color: #fff;
    background: #c69c53;
    border-color: #c69c53;
}
.comments-area .reply a:hover, .comments-area .reply a:focus {
	color: #fff;
    background: var(--secondary-color);
    border-color: var(--secondary-color);
}

.bs-widget .bs-author img.rounded-circle {
    border-bottom-color: #c69c53;
    border-left-color: #c69c53;
    border-top-color: #e5e5e5;
    border-right-color: #e5e5e5;
}
.widget_block h2 {
	color: var(--head-color);
	border-color: #d7d7d7;
}
.wp-block-tag-cloud a {
	color: var(--text-color);
    background: var(--box-color);
    border-color: #d7d7d7;
}
.wp-block-tag-cloud a:hover, .wp-block-tag-cloud a:focus {
	color: #fff;
	background: #c69c53;
	border-color: #c69c53;
}

.bs-blog-meta span{ color: #c69c53; }
/*==================== Sidebar ====================*/
.bs-sidebar .bs-widget {
	background: var(--box-color);
	border-color: #d7d7d7;
}
.bs-sidebar .bs-widget .bs-widget-title:after, .bs-sidebar .bs-widget .bs-widget-title:before {
	border-color: #d7d7d7;
}
.bs-sidebar .bs-widget h6 {
	color: var(--head-color);
	border-color: #d7d7d7;
}
.bs-sidebar .bs-widget .title {
	color: var(--head-color);
}
.bs-sidebar .bs-widget ul li {
	border-color: #eee;
}
.bs-sidebar .bs-widget ul li a {
	color: var(--text-color);
}
.bs-sidebar .bs-widget ul li a:hover, .bs-sidebar .bs-widget ul li a:focus {
	color: #c69c53;
}
.bs-sidebar .bs-widget .bs-widget-tags a, .bs-sidebar .bs-widget .tagcloud a {
	color: var(--text-color);
    background: var(--bg-color);
	border-color: #d7d7d7;
}
.bs-sidebar .bs-widget .bs-widget-tags a:hover, .bs-sidebar .bs-widget .tagcloud a:hover, .bs-sidebar .bs-widget .bs-widget-tags a:focus, .bs-sidebar .bs-widget .tagcloud a:focus {
	color: #fff;
	background: #c69c53;
	border-color: #c69c53;
}
.bs-sidebar .bs-widget.widget_search .btn {
	color: #fff;
	background: #c69c53;
	border-color: #c69c53;
}
.bs-sidebar .bs-widget.widget_search .btn:hover, .bs-sidebar .bs-widget.widget_search .btn:focus  {
	color: #fff;
	background: var(--secondary-color);
	border-color: var(--secondary-color);
}
.bs-widget .calendar_wrap table thead th, .bs-widget .calendar_wrap  table, .bs-widget .calendar_wrap td {
	border-color: rgba(51, 51, 51, 0.1);
	color: var(--text-color);
}
.bs-widget .calendar_wrap table caption {
	background: #c69c53;
	border-color: #c69c53;
	color: #fff;
}
/*==================== general ====================*/
h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
	color: #212121;
}
.btn, .btn-theme, .more-link { 
	color: var(--text-color);
	border-color: #c69c53;
}
.btn-theme:hover, .btn-theme:focus, .more-link:hover, .more-link:focus {
	background: var(--secondary-color);
	color: #fff;
	border-color: var(--secondary-color);
}
.btn-blog:hover, .btn-blog:focus {
	background: #c69c53;
	color: #fff;
	border-color: #c69c53;
}
button, [type=button], [type=reset], [type=submit] {
    background: transparent !important;
    color: var(--text-color) !important;
    border-color: #c69c53 !important;
}
button:hover, [type=button]:hover, [type=reset]:hover, [type=submit]:hover
,button:focus, [type=button]:focus, [type=reset]:focus, [type=submit]:focus {
    background: var(--secondary-color) !important;
    color: #fff !important;
    border-color: var(--secondary-color) !important;
}
/*==================== pagination color ====================*/
.pagination > li > a, .pagination > li > span {
	background: #fff;
	color: #999;
}
.pagination > .active > a, .pagination > .active > a:hover, .pagination > li > a:hover, .pagination > li > a:focus, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
	border-color: #c69c53;
	background: #c69c53;
	color: #fff;
}
.page-item.active .page-link {
  border-color: #c69c53;
	background: #c69c53;
	color: #fff;
}
.pagination .page-numbers{
	background: #fff;
}
.navigation.pagination .nav-links .page-numbers.current, .navigation.pagination .nav-links a:hover, a.error-btn { background-color: #c69c53; color:#fff; }
/*=== navbar drop down hover color ===*/
.navbar-base .navbar-nav > .open > a, .navbar-base .navbar-nav > .open > a:hover, .navbar-base .navbar-nav > .open > a:focus {
	color: #fff;
}

.navigation.pagination > .active > a, .navigation.pagination > .active > a:hover, .navigation.pagination > li > a:hover, .navigation.pagination > li > a:focus, .navigation.pagination > .active > a, .navigation.pagination > .active > span, .navigation.pagination > .active > a:hover, .navigation.pagination > .active > span:hover, .navigation.pagination > .active > a:focus, .navigation.pagination > .active > span:focus {
    border-color: #c69c53;
    background: #c69c53;
    color: #fff;
}
/*==================== typo ====================*/
.bs-breadcrumb-section .overlay {
	background: var(--box-color);
}
.bs-breadcrumb-section .breadcrumb a  {
	color: var(--head-color);
}
.bs-breadcrumb-section .breadcrumb a:hover,
.bs-breadcrumb-section .breadcrumb a:focus,
.bs-breadcrumb-section .breadcrumb .active a {
	color: #c69c53;
}
.bs-breadcrumb-title h1 {
	color: var(--head-color);
}
.bs-page-breadcrumb > li a {
	color: var(--head-color);
}
.bs-page-breadcrumb > li a:hover, .bs-page-breadcrumb > li a:focus {
	color: #c69c53;
}
.bs-page-breadcrumb > li + li:before {
	color: var(--head-color);
}
.bs-contact .bs-widget-address {
	background: #fff;
}
.bs-contact .bs-widget-address li span.icon-addr i {
	color: #c69c53;
}
/*==================== footer background ====================*/
.footer-first {
    background: var(--bg-color);
}
footer .overlay {
	background: var(--secondary-color);;
}
footer .bs-widget h6{
	color: #000;
}
footer .bs-widget ul li {
	color: #bbb;
}
footer .text-input button.sub-link  a{
	color: var(--bg-color);
}
footer .bs-widget ul li a {
	color: #bbb;
}
footer .checkbox a {
    color: var(--secondary-color);
}
footer .bs-widget ul li a:hover, footer .bs-widget ul li a:focus {
	color: #c69c53;
}
footer .bs-widget .calendar_wrap table thead th, footer .bs-widget .calendar_wrap table tbody td,footer .bs-widget #calendar_wrap td, footer .bs-widget #calendar_wrap th, footer .bs-widget .calendar_wrap table caption {
    color: #f2f7fd;
	border-color: #eee;
}
footer .bs-footer-copyright {
	background: #000;
}
footer .bs-footer-copyright, footer .bs-footer-copyright p, footer .bs-footer-copyright a {
	color: #bbb;
}
footer .bs-footer-copyright a:hover, footer .bs-footer-copyright a:focus {
	color: #c69c53;
}
footer .bs-widget p {
	color: #bbb;
}
footer .bs-widget.widget_search .btn {
	color: #fff;
	background: #c69c53;
	border-color: #c69c53;
}
footer .bs-widget.widget_search .btn:hover, footer .bs-widget.widget_search .btn:focus {
	background: var(--secondary-color);
	border-color: var(--secondary-color);
}
/* footer .bs-widget .bs-widget-tags a, footer .bs-widget .tagcloud a {
	background: rgba(255,255,255,0.1);
    color: #000;
} */
footer .bs-widget .bs-widget-tags a:hover, footer .bs-widget .tagcloud a:hover, footer .bs-widget .bs-widget-tags a:focus, footer .bs-widget .tagcloud a:focus {
	color: #fff;
	background: #c69c53;
}
.bs_upscr {
	background: #c69c53;
	border-color: #c69c53;
	color: #fff !important;
}
.bs_upscr:hover, .bs_upscr:focus {
	color: #fff;
}
/*form-control*/
footer .callout h2 {
    color: var(--head-color);
}
.bs-section.insta .title {
    color: var(--head-color);
}
.insta-img:before {
    background: #000;	
}
.insta-img .icon i{
	color: var(--bg-color);
}
.insta-img:hover .icon::before{
	border-top-color: #c69c53;
    border-right-color: #c69c53;
}
 .insta-img:hover .icon::after{
	border-bottom-color: #c69c53;
    border-left-color: #c69c53;
}

.form-group label {
    color: #515151;
}

.form-control {
	border-color: #eef3fb;
}
.form-control:focus {
	border-color: #c69c53;
}
.form-group label::before {
    background-color: #dddddd;
}
.form-group label::after {
	background-color: #c69c53;
}

.woocommerce ul.products li.product .woocommerce-loop-product__title {
	color: var(--secondary-color);
}
.woocommerce-page .products h3 {
	color: #333;
}
.woocommerce div.product .woocommerce-tabs .panel h2 {
	color: #333;
}
.related.products h2 {
	color: #333;
}
.woocommerce nav.woocommerce-pagination ul li a {
	color: #333;
}
.woocommerce nav .woocommerce-pagination ul li span {
	color: #333;
}
.woocommerce nav.woocommerce-pagination ul li a {
	border-color: #ddd;
}
.woocommerce nav .woocommerce-pagination ul li span {
	border-color: #ddd;
}

/*----woocommerce----*/ 
.woocommerce-cart table.cart td.actions .coupon .input-text {
	border-color: #ebebeb;
}
/*-theme-background-*/ 
.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce #respond input#submit, .woocommerce input.button.alt, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce a.button, .woocommerce button.button, .woocommerce-page .products a.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled, .woocommerce input.button.alt[disabled]:disabled:hover {
	background: #c69c53;
}
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
	background-color: #c69c53 !important; 
}
.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span {
	background: #ebe9eb;
	color: #999;
}
/*-theme-color-*/ 
.woocommerce #respond input#submit, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page .products .added_to_cart, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active {
	color: #c69c53;
}
/*-theme-border-color-*/ 
.woocommerce-cart table.cart td.actions .coupon .input-text:hover, .woocommerce-cart table.cart td.actions .coupon .input-text:focus, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce nav .woocommerce-pagination ul li a:focus, .woocommerce nav .woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current {
	border-color: #c69c53;
}

/*-theme-secondary-background-*/ 
.woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page .products a.button:hover, .woocommerce .cart .button:hover, .woocommerce .cart input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce input.button:hover, .woocommerce input.button:focus {
	background: var(--secondary-color);
	color: #fff;
}
/*-theme-secondary-color-*/ 
.woocommerce div.product .woocommerce-tabs ul.tabs li a {
	color: #161c28;
}
/*-theme-color-white-*/ 
.woocommerce-page .woocommerce .woocommerce-info a, .woocommerce-page .woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-message, .woocommerce-page .woocommerce-message a, .woocommerce-page .woocommerce-message a:hover, .woocommerce-page .woocommerce-message a:focus, .woocommerce .woocommerce-message::before, .woocommerce-page .woocommerce-error, .woocommerce-page .woocommerce-error a, .woocommerce-page .woocommerce .woocommerce-error:before, .woocommerce-page .woocommerce-info, .woocommerce-page .woocommerce-info a, .woocommerce-page .woocommerce-info:before, .woocommerce-page .woocommerce .woocommerce-info, .woocommerce-cart .wc-proceed-to-checkout a .checkout-button, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce a.button, .woocommerce button.button, .woocommerce #respond input#submit, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce nav .woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page .products a.button, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce input.button:hover, .woocommerce input.button:focus {
	color: #fff;
}

.woocommerce .products span.onsale, .woocommerce span.onsale {
	background: #c69c53;
}

.woocommerce-page .products a .price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price {
	color: #000;
}
.woocommerce-page .products a .price ins {
	color: #e96656;
}
.woocommerce-page .products .star-rating, .woocommerce-page .star-rating span, .woocommerce-page .stars span a {
	color: #ffc107;
}

/*woocommerce-messages*/
.woocommerce-page .woocommerce-message {
	background: #2ac56c;
}
.woocommerce-page .woocommerce-message a {
	background-color: #c69c53;
}
.woocommerce-page .woocommerce-message a:hover, .woocommerce-page .woocommerce-message a:focus {
	background-color: #388e3c;
}
.woocommerce-page .woocommerce-error {
	background: #ff5252;
}
.woocommerce-page .woocommerce-error a {
	background-color: #F47565;
}
.woocommerce-page .woocommerce-info {
	background: #4593e3;
}
.woocommerce-page .woocommerce-info a {
	background-color: #5fb8dd;
}
.woocommerce-page .woocommerce .woocommerce-info {
	background: rgb(58, 176, 226);
}

/*woocommerce-Price-Slider*/ 
.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
	background: #c69c53;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background: #c69c53;
}
.woocommerce-page .woocommerce-ordering select {
	color: #A0A0A0;
}
/*woocommerce-price-filter*/
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {
	background: #1a2128;
}
/*woocommerce-form*/
.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
	border-color: #ccc;
	color: #999;
}
.woocommerce form .form-row label { 
	color: #222;
}
footer .bs-widget h1, footer .bs-widget h2, footer .bs-widget h3, footer .bs-widget h4, footer .bs-widget h5, footer .bs-widget h6{
color: #bbb;
}
footer .bs-widget blockquote, footer .bs-widget blockquote p{
color:  var(--text-color);
}
blockquote {
    border-left: 5px solid #c69c53;
	background: var(--box-color);
}
footer .bs-widget .small-post-content p, footer .bs-widget .small-post-content .bs-blog-meta a{
color: #212121;
}
footer .bs-widget .wp-block-table ,footer .bs-widget .wp-block-calendar table caption {
    color:#bbb;
}
@media (max-width: 991.98px){
/* .collapse.navbar-collapse {
    background: #fff;
} */

.bs-headfive .collapse.navbar-collapse {
    background: transparent;
}
.navbar-toggler-icon {
    background-color: #fff;
}
.bs-headfive .navbar-wp .navbar-nav > li > a.nav-link, .navbar-wp .dropdown-menu > li > a {
    background: transparent;
    color: #fff;
}
}

@media (max-width: 767.98px) {
	.navbar-wp .navbar-nav > li > a.nav-link,.navbar-wp .dropdown-menu > li > a {
		background: transparent;
    	color: var(--head-color);
	}
	input[type="submit"], button {
	
		color: #000;
	}
}


::-webkit-scrollbar-thumb:hover, .bs-widget .recentarea-slider .bs-post-area:before
{
	 background: #c69c53;
}

.img-shadow {
    box-shadow: -30px 30px 1px 0 #c69c53;
}
</style>
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this -> Html -> charset(); ?>
		<title> <?php echo $title_for_layout; ?> </title>
		<?php
		echo $this -> Html -> meta('icon');

		echo $this -> Html -> css('style.cyanspark');
		echo $this -> Html -> css('kendostyles/kendo.common.min');
		echo $this -> Html-> css('kendostyles/kendo.blueopal.min');
		
		echo $this -> Html -> script('cyanspark/cufon-yui');
		echo $this -> Html -> script('cyanspark/arial');
		echo $this -> Html -> script('cyanspark/cuf_run');
		echo $this -> Html -> script('kendojs/jquery.min');
		echo $this -> Html -> script('kendojs/kendo.web.min');
		echo $this -> Html -> script('flot/jquery.flot');

		echo $this -> fetch('meta');
		echo $this -> fetch('css');
		echo $this -> fetch('script');
		?>
		
	</head>
	<body>
		<div class="main">
			<div class="menu_nav">
				<div class="menu_nav_resize">
					<ul>
						<li class="active">
							<a href="#">Home</a>
						</li>
						<li>
							<a href="#">Support</a>
						</li>
						<li>
							<a href="#">About Us</a>
						</li>
						<li>
							<a href="#">Blog</a>
						</li>
						<li>
							<a href="#">Contact Us</a>
						</li>
					</ul>
				</div>
				<div class="clr"></div>
			</div>
			<div class="header">
				<div class="header_resize">
					<div class="logo">
						<h1><a href="#">Welcome | CyanSpark</a></h1>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="content_resize">
					<div class="navmenu">
						<ul id="menu">
							<li>Empresa</li>
							<li>Productos
								<ul>
									<li>Televisores
										<ul>
											<li>Plasma</li>
											<li>LCD</li>
											<li>LED</li>
										</ul>
									</li>
									<li>Sonido
										<ul>
											<li>Minicadena</li>
											<li>Micro</li>
										</ul>
									</li>
									<li>Proyectores</li>
								</ul>
							</li>
							<li id="li3">Contacto</li>
						</ul>
					</div>	
					<div class="mainbar">
						<div class="article">
							<?php echo $this->Session->flash(); ?>
							<?php echo $this->fetch('content'); ?>
						</div>

						<div class="article">
							<h2><span>Lorem Ipsum</span> Dolor Sit</h2>
							<p>
								Posted by <a href="#">Owner</a> | Filed under <a href="#">templates</a>, <a href="#">internet</a>
							</p>
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo.</a> Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam.
							</p>
							<img src="img/cyanspark/img3.jpg" width="287" height="97" alt="" class="fl" /><img src="img/cyanspark/img4.jpg" width="287" height="97" alt="" />
							<p>
								<a href="#">Read more</a> | March 15, 2015
							</p>
						</div>
					</div>
					<div class="sidebar">
						<!-- <div class="searchform">
							<form id="formsearch" name="formsearch" method="post" action="#">
								<input name="button_search" src="img/cyanspark/search_btn.gif" class="button_search" type="image" />
								<span>
									<input name="editbox_search" class="editbox_search" id="editbox_search" maxlength="80" value="Search" type="text" />
								</span>
							</form>
							<div class="clr"></div>
						</div> -->
						<div class="gadget">
							<h2 class="star"><span>Sidebar</span> Menu</h2>
							<ul class="sb_menu">
								<li>
									<a href="#">Home</a>
								</li>
								<li>
									<a href="#">TemplateInfo</a>
								</li>
								<li>
									<a href="#">Style Demo</a>
								</li>
								<li>
									<a href="#">Blog</a>
								</li>
								<li>
									<a href="#">Archives</a>
								</li>
								<li>
									<a href="#">Website Templates</a>
								</li>
							</ul>
						</div>
						<div class="gadget">
							<h2 class="star"><span>Sponsors</span></h2>
							<ul class="ex_menu">
								<li>
									<a href="#">DreamTemplate</a>
									<br />
									Over 6,000+ Premium Web Templates
								</li>
								<li>
									<a href="#">TemplateSOLD</a>
									<br />
									Premium WordPress &amp; Joomla Themes
								</li>
								<li>
									<a href="#">ImHosted.com</a>
									<br />
									Affordable Web Hosting Provider
								</li>
								<li>
									<a href="#">DreamStock</a>
									<br />
									Download Amazing Stock Photos
								</li>
								<li>
									<a href="#">Evrsoft</a>
									<br />
									Website Builder Software &amp; Tools
								</li>
								<li>
									<a href="#">MyVectorStore</a>
									<br />
									Royalty Free Stock Icons
								</li>
							</ul>
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div class="fbg">
				
				

				<!-- <div class="fbg_resize">
					<div class="col c1">
						<h2>Image Galley</h2>
						<img src="img/cyanspark/pix1.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix2.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix3.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix4.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix5.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix6.jpg" width="58" height="58" alt="" />
					</div>
					<div class="col c2">
						<h2>Lorem Ipsum</h2>
						<p>
							Lorem ipsum dolor
							<br />
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.
						</p>
					</div>
					<div class="col c3">
						<h2>About</h2>
						<img src="img/cyanspark/white.jpg" width="66" height="66" alt="" />
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo. llorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum. <a href="#">Learn more...</a>
						</p>
					</div>
					<div class="clr"></div>
				</div> -->
			</div>
			<div class="footer">
				<div class="footer_resize">
					<p class="lf">
						&copy; Copyright MyWebSite. Designed by Blue <a href="http://www.bluewebtemplates.com/">Website Templates</a>
					</p>
					<ul class="fmenu">
						<li class="active">
							<a href="#">Home</a>
						</li>
						<li>
							<a href="#">Support</a>
						</li>
						<li>
							<a href="#">Blog</a>
						</li>
						<li>
							<a href="#">About Us</a>
						</li>
						<li>
							<a href="#">Contacts</a>
						</li>
					</ul>
					<div class="clr"></div>
				</div>
			</div>
		</div>
	</body>
	<script>
		$("document").ready(function(){
			$("#menu").kendoMenu()
		})
	</script>
</html>

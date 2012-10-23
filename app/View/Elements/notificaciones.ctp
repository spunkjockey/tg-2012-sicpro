<?php //Debugger::dump($notificaciones); ?>
    <?php 
    if(isset($notificaciones) && !empty($notificaciones) ) {
	    foreach ($notificaciones as $noti): ?>	
		    <div class="twit">
		    	<ul class="ex_menu">
					<li>
						<!--<a href="#"><?php echo $noti['Notificacion']['idnoti']; ?></a>-->
						<!--<br />-->
						
						<?php echo $noti['Notificacion']['nombrecomun'] . ' ha ' . 
									$noti['Notificacion']['accion'] . ' un '; ?> 
									<a href="#"> <?php echo $noti['Notificacion']['tabla']; ?> </a>
						<br />
						<div style="text-align: right">
						<?php
		            	echo date('d/m/Y H:i:s',strtotime($noti['Notificacion']['creacion']));
						
						/*echo $this->Time->timeAgoInWords(strtotime($noti['Notificacion']['creacion']), array(
						    'accuracy' => array('month' => 'month'),
						    'end' => '1 year'
						));*/
		            	?>
		            	</div>
					</li>
				</ul>
		        <!--<p><?php echo $noti['Notificacion']['id']; ?></p>
		        <p><?php echo $noti['Notificacion']['tabla']; ?></p>
		        <p><?php echo $noti['Notificacion']['accion']; ?></p>
		        <!--<p id="fecha"><?php echo $noti['Notificacion']['creacion']; ?></p>-->
		        
		        	
		    </div>
		<?php endforeach; 
	}
	?>



<style scoped>

ul.ex_menu li { padding:4px 10px 8px 0;}
ul.ex_menu li {text-align: left;}
/*
ul.ex_menu { margin:0; padding:0; list-style:none; color:#959595;}
ul.ex_menu li { margin:0; background:url(../img/cyanspark/li.gif) no-repeat 0 12px;}


ul.ex_menu li a { color:#5f5f5f; text-decoration:none;}
ul.ex_menu li a:hover { color:#3a90ca; font-weight:bold;}
ul.ex_menu li a:hover { text-decoration:none;}
*/
    .k-listview 
    {
    	padding: 0;
    	border: 0;
    }
    .twit 
    {
    	width: 230px;
    	height: 70px;
    	margin: 0;
    	padding: 10px;
    	border-top: 1px solid rgba(255,255,255,0.1);
    	border-right: 1px solid rgba(0,0,0,0.1);
    	border-bottom: 1px solid rgba(0,0,0,0.1);
    	border-left: 1px solid rgba(255,255,255,0.1);

    }
    .twit img 
    {
    	border: 3px solid rgba(0,0,0,0.1);
    	-webkit-border-radius: 27px;
        -moz-border-radius: 27px;
        border-radius: 27px;
        float: left;
    }
    .twit a:hover img 
    {
    	border: 3px solid rgba(150,150,150,0.7);
    }
 
    .twit p
    {
    	float: left;
    	margin: 0;
    	padding: 0 0 0 10px;
    	width: 230px;
    }
    .twit:after
    {
    	content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }
</style>


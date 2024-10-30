<?php
/**
 * Plugin Name: Knowledge Graph 
 * Plugin URI: https://wordpress.org/plugins/knowledge-graph/
 * Description: Simple Knowledge graph, make your site more viewable by google. simple and easy to use.
<<<<<<< .mine
 * Version: 5.0
||||||| .r2087343
 * Version: 2.0
=======
 * Version: 6.0
>>>>>>> .r2583218
 * Author: Ankush Patial
 * Author URI: https://wordpress.org/plugins/knowledge-graph/
 */

//mysql table is created
function create_table_knowledge_graph() {
	global $wpdb;
		$table_knowledgegraph = $wpdb->prefix . 'knowledgegraph';
			$req = "CREATE TABLE IF NOT EXISTS $table_knowledgegraph (
			id_knowledgegraph int(11) NOT NULL AUTO_INCREMENT,
			knowledgegraph_actif text DEFAULT NULL,
			knowledgegraph_logo text DEFAULT NULL,
			knowledgegraph_tel text DEFAULT NULL,
			knowledgegraph_type_tel text DEFAULT NULL,
			knowledgegraph_type text DEFAULT NULL,
			knowledgegraph_nom text DEFAULT NULL,
			knowledgegraph_facebook text DEFAULT NULL,
			knowledgegraph_twitter text DEFAULT NULL,
			knowledgegraph_googleplus text DEFAULT NULL,
			knowledgegraph_instagram text DEFAULT NULL,
			knowledgegraph_linkedin text DEFAULT NULL,
			UNIQUE KEY id (id_knowledgegraph)
			);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $req );
}
//It inserts the information into the table
function insert_table_knowledgegraph() {
global $wpdb;
$table_knowledgegraph = $wpdb->prefix . 'knowledgegraph';
$wpdb->insert( 
$table_knowledgegraph, 
array(
'id_knowledgegraph'=>' ',
'knowledgegraph_actif'=>'ON',
'knowledgegraph_logo'=>'#',
'knowledgegraph_tel'=>'#',
'knowledgegraph_type_tel'=>'#',
'knowledgegraph_type'=>'Organization',
'knowledgegraph_nom'=>'#',
'knowledgegraph_facebook'=>'http://',
'knowledgegraph_twitter'=>'http://',
'knowledgegraph_googleplus'=>'http://',
'knowledgegraph_instagram'=>'http://',
'knowledgegraph_linkedin'=>'http://'
), 
array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')
);
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_table_knowledge_graph' );
register_activation_hook( __FILE__, 'insert_table_knowledgegraph' );


//Call css
add_action( 'admin_enqueue_scripts', 'style_knowledgegraph_jm_crea' );
function style_knowledgegraph_jm_crea() {
wp_register_style('css_knowledgegraph_jm_crea', plugins_url( 'css/style.css', __FILE__ ));
wp_enqueue_style('css_knowledgegraph_jm_crea');	
}


//Displaying the form
function knowledgegraph_jmcrea_form() {

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
global $wpdb;
$table_knowledgegraph = $wpdb->prefix . "knowledgegraph";
$social_graph = $wpdb->get_row("SELECT * FROM $table_knowledgegraph WHERE id_knowledgegraph='1'");

echo "<h1>Knowledge Graph </h1>
<h2>Add your links to social networks directly in Google results.</h2>";

//pass the setting
if (isset($_POST['maj'])) {
$knowledgegraph_actif = stripslashes($_POST['knowledgegraph_actif']);
$knowledgegraph_logo = stripslashes($_POST['knowledgegraph_logo']);
$knowledgegraph_tel = stripslashes($_POST['knowledgegraph_tel']);
$knowledgegraph_type_tel = stripslashes($_POST['knowledgegraph_type_tel']);
$knowledgegraph_nom = stripslashes($_POST['knowledgegraph_nom']);
$knowledgegraph_type = stripslashes($_POST['knowledgegraph_type']);
$knowledgegraph_facebook = stripslashes($_POST['knowledgegraph_facebook']);
$knowledgegraph_twitter = stripslashes($_POST['knowledgegraph_twitter']);
$knowledgegraph_googleplus = stripslashes($_POST['knowledgegraph_googleplus']);
$knowledgegraph_instagram = stripslashes($_POST['knowledgegraph_instagram']);
$knowledgegraph_linkedin = stripslashes($_POST['knowledgegraph_linkedin']);

global $wpdb;
$table_knowledgegraph = $wpdb->prefix . "knowledgegraph";
$wpdb->query($wpdb->prepare(
"UPDATE $table_knowledgegraph SET knowledgegraph_actif='$knowledgegraph_actif',
knowledgegraph_logo='$knowledgegraph_logo',knowledgegraph_tel='$knowledgegraph_tel',
knowledgegraph_type_tel='$knowledgegraph_type_tel',
knowledgegraph_nom='$knowledgegraph_nom',
knowledgegraph_type='$knowledgegraph_type',
knowledgegraph_facebook='$knowledgegraph_facebook',
knowledgegraph_twitter='$knowledgegraph_twitter',
knowledgegraph_googleplus='$knowledgegraph_googleplus',
knowledgegraph_instagram='$knowledgegraph_instagram',
knowledgegraph_linkedin='$knowledgegraph_linkedin'  
WHERE id_knowledgegraph='1'",APP_POST_TYPE));
echo '<script>document.location.href="admin.php?page=knowledgegraph&tab=Settings&action=maj-ok"</script>';

}
if (isset($_GET['action'])&&($_GET['action'] == 'maj-ok')) {
echo '<div class="updated"><p>Knowledge Google Saved successfully !.</p></div>';		
}

echo '<div class="wrap"><h2 class="nav-tab-wrapper">';

if ( (isset($_GET['tab']))&&($_GET['tab'] == 'Settings') ) {
echo '<a class="nav-tab nav-tab-active" href="' . admin_url() . 'admin.php?page=knowledgegraph&tab=Settings">Settings</a>';
}
else {
echo '<a class="nav-tab" href="' . admin_url() . 'admin.php?page=knowledgegraph&tab=Settings">Settings</a>';	
}
if ( (isset($_GET['tab']))&&($_GET['tab'] == 'Upgrade_to_pro') ) {
echo '<a class="nav-tab nav-tab-active" href="' . admin_url() . 'admin.php?page=knowledgegraph&tab=Upgrade_to_pro">Update plugin</a>';
}
else {
echo '<a class="nav-tab" href="' . admin_url() . 'admin.php?page=knowledgegraph&tab=Upgrade_to_pro">Upgrade To Pro</a>';	
}
echo '</h2></div>';


/* TABS Settings */
if ( (isset($_GET['tab']))&&($_GET['tab'] == 'Settings') ) {
echo "
<div id='cadre_blanc_knowledgegraph'>
<form id='form1' name='form1' method='post' action=''>
<table border='0' cellspacing='8' cellpadding='0'>
<tr>
<td colspan='3'><h2>Settings</h2></td>
</tr>
<tr>
<td>Activate or deactivate plugin:</td>
<td>";
if ($social_graph->knowledgegraph_actif == 'ON') {
echo "
<input type='radio' name='knowledgegraph_actif' id='radio' value='ON' checked='checked' /> ON 
<input type='radio' name='knowledgegraph_actif' id='radio2' value='OFF' /> OFF ";
}
else {
echo "
<input type='radio' name='knowledgegraph_actif' id='radio' value='ON' /> ON 
<input type='radio' name='knowledgegraph_actif' id='radio2' value='OFF' checked='checked' /> OFF ";	
}
echo "
</td>
</tr>
<tr>
<td>Logo URL :</td>
<td><input name='knowledgegraph_logo' type='text' id='knowledgegraph_logo' value='" . $social_graph->knowledgegraph_logo . "'></td>
</tr>
<tr>
<td>Site Type:</td>
<td>
<select name='knowledgegraph_type' id='knowledgegraph_type'>";
if ($social_graph->knowledgegraph_type == 'Organization') {
echo "<option value='Organization'>Organization</option>";
echo "<option value='Person'>Person</option>	";
}
else {
echo "<option value='Person'>Person</option>	";
echo "<option value='Organization'>Organization</option>";
}
echo "
</select>
</td>
</tr>
<tr>
<td>Phone Number <code>Ex : +917271232345</code>:</td>
<td><input name='knowledgegraph_tel' type='text' id='knowledgegraph_tel' value='" . $social_graph->knowledgegraph_tel. "'></td>
</tr>
<tr>
<td>Contact Type:</td>
<td>
<select name='knowledgegraph_type_tel' id='knowledgegraph_type_tel'>
<option value='" . $social_graph->knowledgegraph_type_tel . "'>" . $social_graph->knowledgegraph_type_tel . "</option>
<option value='customer support'>customer support</option>
<option value='technical support'>technical support</option>
<option value='billing support'>billing support</option>
<option value='bill payment'>bill payment</option>
<option value='sales'>sales</option>
<option value='reservations'>reservations</option>
<option value='credit card support'>credit card support</option>
<option value='emergency'>emergency</option>
<option value='baggage tracking'>baggage tracking</option>
<option value='roadside assistance'>roadside assistance</option>
<option value='package tracking'>package tracking</option>
</select>
</td>
</tr>
<tr>
<td>Organization name:</td>
<td><input type='text' name='knowledgegraph_nom' id='knowledgegraph_nom' value='" . $social_graph->knowledgegraph_nom . "'></td>
</tr>

<tr>
<td>URL Facebook :</td>
<td><input type='text' name='knowledgegraph_facebook' id='knowledgegraph_facebook' value='" . $social_graph->knowledgegraph_facebook . "'></td>
</tr>
<tr>
<td>URL Twitter :</td>
<td><input type='text' name='knowledgegraph_twitter' id='knowledgegraph_twitter' value='" . $social_graph->knowledgegraph_twitter . "'></td>
</tr>
<tr>
<td>URL Google + : </td>
<td><input type='text' name='knowledgegraph_googleplus' id='knowledgegraph_googleplus' value='" . $social_graph->knowledgegraph_googleplus. "'></td>
</tr>
<tr>
<td>URL Instagram :</td>
<td><input type='text' name='knowledgegraph_instagram' id='knowledgegraph_instagram' value='" . $social_graph->knowledgegraph_instagram . "'></td>
</tr>
<tr>
<td>URL Linkedin :</td>
<td><input type='text' name='knowledgegraph_linkedin' id='knowledgegraph_linkedin' value='" . $social_graph->knowledgegraph_linkedin . "'></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan='3' align='right'><input type='submit' name='maj' id='maj' value='Submit The Changes' class='button button-primary' /></td>
</tr>
<tr>
<td colspan='3' align='right'>&nbsp;</td>
</tr>
</table>
</form>
</div>";
}

/* Table plugin*/
if ( (isset($_GET['tab']))&&($_GET['tab'] == 'Upgrade_to_pro') ) {
echo '
<div id="Know_list_plugin">
<h3>Download The Artish pro Knowledge Graph Version</h3>
<img src="' . plugins_url( 'knowledge-graph-plugin/image1.jpg', __FILE__ ) . '" alt="Social Share by Anku" />
<p>Download Knowledge Graph Pro Plugin For Artist and Music Arts </p>
<div align="center"><a href="#" target="_blank"><button class="button button-primary">Download</button></a></div>
</div>


<div id="Know_list_plugin">
<h3>Download The Event pro Knowledge Graph Version</h3>
<img src="' . plugins_url( 'knowledge-graph-plugin/image2.jpg', __FILE__ ) . '" alt="knowledge Graph By Anku" />
<p>Download Knowledge Graph Pro Plugin For Events </p>
<div align="center"><a href="#" target="_blank"><button class="button button-primary">Download</button></a></div>
</div>';

}
elseif (!isset($_GET['tab'])) {
echo '<script>document.location.href="tools.php?page=knowledgegraph&tab=Settings"</script>';
}

}


function afficher_knowledgegraph() {
global $wpdb;
$table_knowledgegraph = $wpdb->prefix . "knowledgegraph";
$social_graph = $wpdb->get_row("SELECT * FROM $table_knowledgegraph WHERE id_knowledgegraph='1'");

if ($social_graph->knowledgegraph_actif == 'ON') {
echo "\n<!-- KNOWLEDGE GRAPH BY ANKU -->";
//Logo
if ($social_graph->knowledgegraph_logo) {
echo '
<script type="application/ld+json">
{
 "@context": "http://schema.org",
  "@type": "' . $social_graph->knowledgegraph_type . '",
  "url" : "' . get_site_url() . '",
  "logo": "' .  $social_graph->knowledgegraph_logo . '",
  "contactPoint" : [
    { "@type" : "ContactPoint",
      "telephone" : "'.$social_graph->knowledgegraph_tel.'",
      "contactType" : "'.$social_graph->knowledgegraph_type_tel.'"
    } ],
  "sameAs" : [
    "' . $social_graph->knowledgegraph_facebook . '",
    "' . $social_graph->knowledgegraph_twitter . '",
    "' . $social_graph->knowledgegraph_googleplus . '",
	"' . $social_graph->knowledgegraph_instagram . '",
	"' . $social_graph->knowledgegraph_linkedin . '"
  ]}
</script>';
}
echo "\n\n";	
}

}
add_action('wp_head', 'afficher_knowledgegraph');

//On créé le menu
function menu_knowledgegraph_jmcrea() {
add_submenu_page( 'tools.php', 'Knowledge Graph', 'Knowledge Graph', 'manage_options', 'knowledgegraph', 'knowledgegraph_jmcrea_form' ); 
}
add_action('admin_menu', 'menu_knowledgegraph_jmcrea');


function head_meta_by_ankush() {
echo("<meta name='knowledge Graph By Anku' content='1.3' />\n");
}
add_action('wp_head', 'head_meta_by_ankush');
?>

<?php
if( !defined( 'MEDIAWIKI' ) ) {
        die( -1 );
}

class FilterRatingsTemplate extends QuickTemplate {
	public function execute() {
		$articles = $this->data['articles'];
		$filters = $this->data['filters'];
?>

<form method="GET">
<p>
Project Name: <input type="text" name="project" value="<?php echo $filters['r_project']?>" /> 
Importance: <input type="text" name="importance" value="<?php echo $filters['r_importance']?>" /> 
Quality: <input type="text" name="quality" value="<?php echo $filters['r_quality']?>" /> 
<input type="submit" />
</p>
</form>

<div id="">
<?php if( count($articles) > 0 ) { ?>
	<table>
	<tr>
		<th>Article</th>
		<th>Importance</th>
		<th>Quality</th>
	</tr>	
	<?php foreach( $articles as $article ) { ?>
	<tr>
	<td><?php echo $article['r_article']; ?></td>	
	<td><?php echo $article['r_importance']; ?></td>	
	<td><?php echo $article['r_quality']; ?></td>	
	</tr>
	<?php } ?>
	</table>
<?php } else { ?> 
<p>No results found</p>
<?php } ?>
</div>


<?php
        } // execute()
} // class

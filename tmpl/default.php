<?php 
/**
 * @package Module Random Article for Joomla! 2.5+
 * @version $Id$
 * @author Artur Alves
 * @copyright (C) 2010- Artur Alves
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="random-article-wrapper <?php echo $params->get('moduleclass_sfx'); ?>">

	<?php
	// Shows an error if the user didn't select any category
	if($articles <= 0) {
		if($articles == -2)
			echo JText::sprintf('MOD_RANDOM_ARTICLE_ERROR_1');
	}
	else {
		$i = 0;
		foreach($articles as $article) { ?>
		
			<div class="random-article">
				<?php if($params->get('title')) : ?>
					<div class="title">
						<?php if($params->get('linktitle')) : ?>
							<h2><a href="<?php echo $urls[$i]; ?>"><?php echo $article->title; ?></a></h2>
						<?php else: ?>
							<h2><?php echo $article->title; ?></h2>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php if($params->get('introtext')) : ?>
					<?php if($params->get('introtextlimit') == 0) : ?>
						<div class="introtext"> <?php echo $article->introtext; ?> </div>
					<?php else: ?>
						<div class="introtext">
							<?php
								$limitCount = intval($params->get('introtextlimitcount'));
								if($limitCount < 0)
									$limitCount = 0;
								
								// Limits the $introtext by word count
								if($params->get('introtextlimit') == 1) {
									$introtext = explode(" ", $article->introtext, $limitCount + 1);
									array_pop($introtext);
									$introtext = implode(" ", $introtext);
									echo $introtext;
								}
								
								// Limits the $introtext by character count
								elseif($params->get('introtextlimit') == 2) {
									// Old function to be used if the new function doesn't work. 
									//$introtext = substr($article->introtext, 0, $limitCount);
									
									// New function to ignore HTML tags when limiting the introtext.						
									$introtext = modRandomArticleHelper::substr_HTML($limitCount, $article->introtext);
									
									echo $introtext;
								}										
							?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if($params->get('readmore')) : ?>
					<div class="readmore"><a href="<?php echo $urls[$i]; ?>"> <?php echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE'); ?> </a></div>
				<?php endif; ?>
					
				<?php if($params->get('fulltext')) : ?>
					<div class="fulltext"> <?php echo $article->fulltext; ?> </div>
				<?php endif; ?>
			</div>
			<?php 
			$i++;	
		} 
	}
	?>	
</div>
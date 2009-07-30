<?php

	Class extension_typogrify extends Extension {

		public function about(){
			return array(
				'name' => 'Typogrify Text Formatters',
				'version' => '1.1',
				'release-date' => '2009-07-30',
				'author' => array('name' => 'Tony Arnold',
					              'website' => 'http://www.tonyarnold.com', 
					              'email' => 'tony@tonyarnold.com'),
				'description' => 'Format entries using Typogrify formatter, and edit them using the markItUp! WYSIWYM editor.'
			);
		}

		public function getSubscribedDelegates(){
			return array(
				array('page'        =>	'/backend/',
				      'delegate'	=>	'ModifyTextareaFieldPublishWidget',
				      'callback'	=>	'modifyTextarea'),
				      
				array('page'		=>	'/backend/',
					  'delegate'	=>	'ModifyTextboxFieldPublishWidget',
					  'callback'	=>	'modifyTextarea'),
			);
		}

		public function modifyTextarea($context){
			if( $context['field']->get('formatter') != 'ta_typogrifymarkdown' &&
			    $context['field']->get('formatter') != 'ta_typogrifymarkdownextra' &&
				$context['field']->get('formatter') != 'ta_typogrifytextile' &&
				$context['field']->get('formatter') != 'ta_typogrify'
			) return;
			
			if(!defined('__TYPOGRIFY_SCRIPTS_IN_HEAD__') || !__TYPOGRIFY_SCRIPTS_IN_HEAD__){
				define_safe('__TYPOGRIFY_SCRIPTS_IN_HEAD__', true);
				$context['parent']->Page->addScriptToHead(URL . '/extensions/typogrify/lib/markitup/jquery.markitup.js', 200);
				$context['parent']->Page->addStylesheetToHead(URL . '/extensions/typogrify/lib/markitup/skins/symphony/style.css', 'screen', 990);
				$context['parent']->Page->addStylesheetToHead(URL . '/extensions/typogrify/assets/typogrify.css', 'screen', 990);
				$addedMarkItUp = true;
			}
				
			if($context['field']->get('formatter') == 'ta_typogrifymarkdown') {
				if(!defined('__TYPOGRIFY_MARKDOWN_SCRIPTS_IN_HEAD__') || !__TYPOGRIFY_MARKDOWN_SCRIPTS_IN_HEAD__){
					define_safe('__TYPOGRIFY_MARKDOWN_SCRIPTS_IN_HEAD__', true);
					$context['parent']->Page->addScriptToHead(URL . '/extensions/typogrify/assets/applyMarkdown.js', 210);
					$context['parent']->Page->addStylesheetToHead(URL . '/extensions/typogrify/lib/markitup/sets/markdown/style.css', 'screen', 991);
					$addedMarkdownJS = true;
				}
			} else if($context['field']->get('formatter') == 'ta_typogrifymarkdownextra') {
				if(!defined('__TYPOGRIFY_MARKDOWNEXTRA_SCRIPTS_IN_HEAD__') || !__TYPOGRIFY_MARKDOWNEXTRA_SCRIPTS_IN_HEAD__){
					define_safe('__TYPOGRIFY_MARKDOWNEXTRA_SCRIPTS_IN_HEAD__', true);
					$context['parent']->Page->addScriptToHead(URL . '/extensions/typogrify/assets/applyMarkdownExtra.js', 210);
					$context['parent']->Page->addStylesheetToHead(URL . '/extensions/typogrify/lib/markitup/sets/markdown/style.css', 'screen', 991);
					$addedMarkdownExtraJS = true;
				}
			} else if($context['field']->get('formatter') == 'ta_typogrifytextile') {
				if(!defined('__TYPOGRIFY_TEXTILE_SCRIPTS_IN_HEAD__') || !__TYPOGRIFY_TEXTILE_SCRIPTS_IN_HEAD__){
					define_safe('__TYPOGRIFY_TEXTILE_SCRIPTS_IN_HEAD__', true);
					$context['parent']->Page->addScriptToHead(URL . '/extensions/typogrify/assets/applyTextile.js', 210);
					$context['parent']->Page->addStylesheetToHead(URL . '/extensions/typogrify/lib/markitup/sets/textile/style.css', 'screen', 991);
					$addedTexttileJS = true;
				}
			} else {
				if(!defined('__TYPOGRIFY_HTML_SCRIPTS_IN_HEAD__') || !__TYPOGRIFY_HTML_SCRIPTS_IN_HEAD__){
					define_safe('__TYPOGRIFY_HTML_SCRIPTS_IN_HEAD__', true);
					$context['parent']->Page->addScriptToHead(URL . '/extensions/typogrify/assets/applyHTML.js', 210);
					$context['parent']->Page->addStylesheetToHead(URL . '/extensions/typogrify/lib/markitup/sets/default/style.css', 'screen', 991);
					$addedHTMLJS = true;
				}
			}
		}
	}

?>
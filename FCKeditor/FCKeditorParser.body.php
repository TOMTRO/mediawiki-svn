<?php

class FCKeditorParser extends Parser
{
    public static $fkc_mw_makeImage_options;
    protected $fck_mw_strtr_span;
    protected $fck_mw_strtr_span_counter=1;
    protected $fck_mw_taghook;
    protected $fck_internal_parse_text;

    private $FCKeditorMagicWords = array(
    '__NOTOC__',
    '__FORCETOC__',
    '__NOEDITSECTION__',
    '__START__',
    '__NOTITLECONVERT__',
    '__NOCONTENTCONVERT__',
    '__END__',
    '__TOC__',
    '__NOTC__',
    '__NOCC__',
    "__FORCETOC__",
    "__NEWSECTIONLINK__",
    "__NOGALLERY__",
    );

    function __construct() {
        global $wgParser;
        parent::Parser();

        foreach ($wgParser->getTags() as $h) {
            if (!in_array($h, array("pre"))) {
                $this->setHook($h, array($this, "fck_genericTagHook"));
            }
        }
    }

    /**
     * Add special string (that would be changed by Parser) to array and return simple unique string 
     * that will remain unchanged during whole parsing operation.
     * At the end we'll replace all this unique strings with original content
     *
     * @param string $text
     * @return string
     */
    private function fck_addToStrtr($text) {
        $key = 'Fckmw'.$this->fck_mw_strtr_span_counter.'fckmw';
        $this->fck_mw_strtr_span_counter++;
        $this->fck_mw_strtr_span[$key] = $text;
        return $key;
    }

    /**
	* Callback function for custom tags: feed, ref, references etc.
	*
	* @param string $str Input
	* @param array $argv Arguments
	* @return string
	*/
    function fck_genericTagHook( $str, $argv, $parser ) {
        if (empty($argv)) {
            $ret = "<span class=\"fck_mw_".$this->fck_mw_taghook."\" _fck_mw_customtag=\"true\" _fck_mw_tagname=\"".$this->fck_mw_taghook."\">";
        }
        else {
            $ret = "<span class=\"fck_mw_".$this->fck_mw_taghook."\" _fck_mw_customtag=\"true\" _fck_mw_tagname=\"".$this->fck_mw_taghook."\"";
            foreach ($argv as $key=>$value) {
                $ret .= " ".$key."=\"".$value."\"";
            }
            $ret .=">";
        }
        if (is_null($str)) {
            $ret = substr($ret, 0, -1) . " />";
        }
        else {
            $ret .= htmlspecialchars($str);
            $ret .= "</span>";
        }

        $replacement = $this->fck_addToStrtr($ret);
        return $replacement;
    }

    /**
	* Callback function for wiki tags: nowiki, includeonly, noinclude
	*
	* @param string $tagName tag name, eg. nowiki, math
	* @param string $str Input
	* @param array $argv Arguments
	* @return string
	*/
    function fck_wikiTag( $tagName, $str, $argv = array()) {
        if (empty($argv)) {
            $ret = "<span class=\"fck_mw_".$tagName."\">";
        }
        else {
            $ret = "<span class=\"fck_mw_".$tagName."\"";
            foreach ($argv as $key=>$value) {
                $ret .= " ".$key."=\"".$value."\"";
            }
            $ret .=">";
        }
        if (is_null($str)) {
            $ret = substr($ret, 0, -1) . " />";
        }
        else {
            $ret .= htmlspecialchars($str);
            $ret .= "</span>";
        }

        $replacement = $this->fck_addToStrtr($ret);

        return $replacement;
    }

    /**
	 * Strips and renders nowiki, pre, math, hiero
	 * If $render is set, performs necessary rendering operations on plugins
	 * Returns the text, and fills an array with data needed in unstrip()
	 *
	 * @param StripState $state
	 *
	 * @param bool $stripcomments when set, HTML comments <!-- like this -->
	 *  will be stripped in addition to other tags. This is important
	 *  for section editing, where these comments cause confusion when
	 *  counting the sections in the wikisource
	 *
	 * @param array dontstrip contains tags which should not be stripped;
	 *  used to prevent stipping of <gallery> when saving (fixes bug 2700)
	 *
	 * @private
	 */
    function strip( $text, $state, $stripcomments = false , $dontstrip = array () ) {
        global $wgContLang;

        wfProfileIn( __METHOD__ );
        $render = ($this->mOutputType == OT_HTML);

        $uniq_prefix = $this->mUniqPrefix;
        $commentState = new ReplacementArray;
        $nowikiItems = array();
        $generalItems = array();

        $elements = array_merge(
        array( 'nowiki', 'gallery' ),
        array_keys( $this->mTagHooks ) );
        global $wgRawHtml;
        if( $wgRawHtml ) {
            $elements[] = 'html';
        }
        if( $this->mOptions->getUseTeX() ) {
            $elements[] = 'math';
        }

        # Removing $dontstrip tags from $elements list (currently only 'gallery', fixing bug 2700)
        foreach ( $elements AS $k => $v ) {
            if ( !in_array ( $v , $dontstrip ) ) continue;
            unset ( $elements[$k] );
        }

        $matches = array();
        $text = Parser::extractTagsAndParams( $elements, $text, $matches, $uniq_prefix );

        foreach( $matches as $marker => $data ) {
            list( $element, $content, $params, $tag ) = $data;
            if( $render ) {
                $tagName = strtolower( $element );
                wfProfileIn( __METHOD__."-render-$tagName" );
                switch( $tagName ) {
                    case '!--':
                        // Comment
                        if( substr( $tag, -3 ) == '-->' ) {
                            $output = $tag;
                        } else {
                            // Unclosed comment in input.
                            // Close it so later stripping can remove it
                            $output = "$tag-->";
                        }
                        break;
                    case 'html':
                        if( $wgRawHtml ) {
                            $output = $content;
                            break;
                        }
                        // Shouldn't happen otherwise. :)
                    case 'nowiki':
                        $output = $this->fck_wikiTag('nowiki', $content, $params); //required by FCKeditor
                        break;
                    case 'math':
                        $output = $wgContLang->armourMath( MathRenderer::renderMath( $content ) );
                        break;
                    case 'gallery':
                        $output = $this->renderImageGallery( $content, $params );
                        break;
                    default:
                        if( isset( $this->mTagHooks[$tagName] ) ) {
                            $this->fck_mw_taghook = $tagName; //required by FCKeditor
                            $output = call_user_func_array( $this->mTagHooks[$tagName],
                            array( $content, $params, $this ) );
                        } else {
                            throw new MWException( "Invalid call hook $element" );
                        }
                }
                wfProfileOut( __METHOD__."-render-$tagName" );
            } else {
                // Just stripping tags; keep the source
                $output = $tag;
            }

            // Unstrip the output, to support recursive strip() calls
            $output = $state->unstripBoth( $output );

            if( !$stripcomments && $element == '!--' ) {
                $commentState->setPair( $marker, $output );
            } elseif ( $element == 'html' || $element == 'nowiki' ) {
                $nowikiItems[$marker] = $output;
            } else {
                $generalItems[$marker] = $output;
            }
        }
        # Add the new items to the state
        # We do this after the loop instead of during it to avoid slowing
        # down the recursive unstrip
        $state->nowiki->mergeArray( $nowikiItems );
        $state->general->mergeArray( $generalItems );

        # Unstrip comments unless explicitly told otherwise.
        # (The comments are always stripped prior to this point, so as to
        # not invoke any extension tags / parser hooks contained within
        # a comment.)
        if ( !$stripcomments ) {
            // Put them all back and forget them
            $text = $commentState->replace( $text );
        }

        wfProfileOut( __METHOD__ );
        return $text;
    }

    /** Replace HTML comments with unique text using fck_addToStrtr function
	 *
	 * @private
	 * @param string $text
	 * @return string
	 */
    private function fck_replaceHTMLcomments( $text ) {
        wfProfileIn( __METHOD__ );
        while (($start = strpos($text, '<!--')) !== false) {
            $end = strpos($text, '-->', $start + 4);
            if ($end === false) {
                # Unterminated comment; bail out
                break;
            }

            $end += 3;

            # Trim space and newline if the comment is both
            # preceded and followed by a newline
            $spaceStart = max($start - 1, 0);
            $spaceLen = $end - $spaceStart;
            while (substr($text, $spaceStart, 1) === ' ' && $spaceStart > 0) {
                $spaceStart--;
                $spaceLen++;
            }
            while (substr($text, $spaceStart + $spaceLen, 1) === ' ')
            $spaceLen++;
            if (substr($text, $spaceStart, 1) === "\n" and substr($text, $spaceStart + $spaceLen, 1) === "\n") {
                # Remove the comment, leading and trailing
                # spaces, and leave only one newline.
                $replacement = $this->fck_addToStrtr(substr($text, $spaceStart, $spaceLen+1));
                $text = substr_replace($text, $replacement."\n", $spaceStart, $spaceLen + 1);
            }
            else {
                # Remove just the comment.
                $replacement = $this->fck_addToStrtr(substr($text, $start, $end - $start));
                $text = substr_replace($text, $replacement, $start, $end - $start);
            }
        }
        wfProfileOut( __METHOD__ );
        
        return $text;
    }

    function replaceInternalLinks( $text ) {
        return parent::replaceInternalLinks($text);
    }

    function makeImage( $nt, $options ) {
        FCKeditorParser::$fkc_mw_makeImage_options = $options;
        return parent::makeImage( $nt, $options );
    }

    /**
     * Replace templates with unique text to preserve them from parsing
     *
     * @todo if {{template}} is inside string that also must be returned unparsed, 
     * e.g. <noinclude>{{template}}</noinclude>
     * {{template}} replaced with Fckmw[n]fckmw which is wrong...
     * 
     * @param string $text
     * @return string
     */
    private function fck_replaceTemplates( $text ) {
        
        $callback = array('{' =>
        array(
        'end'=>'}',
        'cb' => array(
        2=>array('FCKeditorParser', 'fck_leaveTemplatesAlone'),
        3=>array('FCKeditorParser', 'fck_leaveTemplatesAlone'),
        ),
        'min' =>2,
        'max' =>3,
        )
        );

        $text = $this->replace_callback($text, $callback);

        $tags = array();
        $offset=0;
        $textTmp = $text;
        while (false !== ($pos = strpos($textTmp, "<!--FCK_SKIP_START-->")))
        {
            $tags[abs($pos + $offset)] = 1;
            $textTmp = substr($textTmp, $pos+21);
            $offset += $pos + 21;
        }

        $offset=0;
        $textTmp = $text;
        while (false !== ($pos = strpos($textTmp, "<!--FCK_SKIP_END-->")))
        {
            $tags[abs($pos + $offset)] = -1;
            $textTmp = substr($textTmp, $pos+19);
            $offset += $pos + 19;
        }

        if (!empty($tags)) {
            ksort($tags);

            $strtr = array("<!--FCK_SKIP_START-->" => "", "<!--FCK_SKIP_END-->" => "");

            $sum=0;
            $lastSum=0;
            $finalString = "";
            $stringToParse = "";
            $startingPos = 0;
            $inner = "";
            $strtr_span = array();
            foreach ($tags as $pos=>$type) {
                $sum += $type;
                if ($sum == 1 && $lastSum == 0) {
                    $stringToParse .= strtr(substr($text, $startingPos, $pos - $startingPos), $strtr);
                    $startingPos = $pos;
                }
                else if ($sum == 0) {
                    $stringToParse .= 'Fckmw'.$this->fck_mw_strtr_span_counter.'fckmw';
                    $inner = htmlspecialchars(strtr(substr($text, $startingPos, $pos - $startingPos + 19), $strtr));
                    $this->fck_mw_strtr_span['href="Fckmw'.$this->fck_mw_strtr_span_counter.'fckmw"'] = 'href="'.$inner.'"';
                    $this->fck_mw_strtr_span['Fckmw'.$this->fck_mw_strtr_span_counter.'fckmw'] = '<span class="fck_mw_template">'.$inner.'</span>';
                    $startingPos = $pos + 19;
                    $this->fck_mw_strtr_span_counter++;
                }
                $lastSum = $sum;
            }
            $stringToParse .= substr($text, $startingPos);
            $text = &$stringToParse;
        }        
        
        return $text;
    }

    function internalParse ( $text ) {

        $this->fck_internal_parse_text =& $text;

        //these three tags should remain unchanged
        $text = StringUtils::delimiterReplaceCallback( '<includeonly>', '</includeonly>', array($this, 'fck_includeonly'), $text );
        $text = StringUtils::delimiterReplaceCallback( '<noinclude>', '</noinclude>', array($this, 'fck_noinclude'), $text );
        $text = StringUtils::delimiterReplaceCallback( '<onlyinclude>', '</onlyinclude>', array($this, 'fck_onlyinclude'), $text );

        //html comments shouldn't be stripped
        $text = $this->fck_replaceHTMLcomments( $text );
        //as well as templates
        $text = $this->fck_replaceTemplates( $text );                
        
        $finalString = parent::internalParse($text);

        return $finalString;
    }
    function fck_includeonly( $matches ) {
        return $this->fck_wikiTag('includeonly', $matches[1]);
    }
    function fck_noinclude( $matches ) {
        return $this->fck_wikiTag('noinclude', $matches[1]);
    }
    function fck_onlyinclude( $matches ) {
        return $this->fck_wikiTag('onlyinclude', $matches[1]);
    }
    function fck_leaveTemplatesAlone( $matches ) {
        return "<!--FCK_SKIP_START-->".$matches['text']."<!--FCK_SKIP_END-->";
    }
    function formatHeadings( $text, $isMain=true ) {
        return $text;
    }
    function replaceFreeExternalLinks( $text ) { return $text; }
    function stripNoGallery($text) {}
    function stripToc( $text ) {
        //$prefix = '<span class="fck_mw_magic">';
        //$suffix = '</span>';
        $prefix = '';
        $suffix = '';

        $strtr = array();
        foreach ($this->FCKeditorMagicWords as $word) {
            $strtr[$word] = $prefix . $word . $suffix;
        }

        return strtr( $text, $strtr );
    }

    function parse( $text, &$title, $options, $linestart = true, $clearState = true, $revid = null ) {
        $parserOutput = parent::parse($text, $title, $options, $linestart , $clearState , $revid );

        $categories = $parserOutput->getCategories();
        if ($categories) {
            $appendString = "";
            foreach ($categories as $cat=>$val) {
                $appendString .= "<a href=\"Category:" . $cat ."\">Category:" . $cat ."</a> ";
            }
            $parserOutput->setText($parserOutput->getText() . $appendString);
        }
        
        if (!empty($this->fck_mw_strtr_span)) {
            $parserOutput->setText(strtr($parserOutput->getText(), $this->fck_mw_strtr_span));
        }

        return $parserOutput;
    }

    /*
    function replaceVariables( $text, $args = array(), $argsOnly = false ) {
    return preg_replace("/\{\{([^}]+)\}\}(\}*)/", '<span class="fck_template">{{$1}}$2</span>', $text);
    }
    */
}

<?php
/**
 * @file
 * @ingroup SMW
 */

/**
 * SMWExporter is a class for converting internal page-based data (SMWSemanticData) into
 * a format for easy serialisation in OWL or RDF.
 *
 * @author Markus Krötzsch
 * @ingroup SMW
 */
class SMWExporter {
	static protected $m_exporturl = false;
	static protected $m_ent_wiki = false;
	static protected $m_ent_property = false;
	static protected $m_ent_wikiurl = false;

	/**
	 * Make sure that necessary base URIs are initialised properly.
	 */
	static public function initBaseURIs() {
		if ( SMWExporter::$m_exporturl !== false ) return;
		global $wgContLang, $wgServer, $wgArticlePath;

		global $smwgNamespace; // complete namespace for URIs (with protocol, usually http://)
		if ( '' == $smwgNamespace ) {
			$resolver = SpecialPage::getTitleFor( 'URIResolver' );
			$smwgNamespace = $resolver->getFullURL() . '/';
		} elseif ( $smwgNamespace[0] == '.' ) {
			$resolver = SpecialPage::getTitleFor( 'URIResolver' );
			$smwgNamespace = "http://" . substr( $smwgNamespace, 1 ) . $resolver->getLocalURL() . '/';
		}

		// The article name must be the last part of wiki URLs for proper OWL/RDF export:
		SMWExporter::$m_ent_wikiurl  = $wgServer . str_replace( '$1', '', $wgArticlePath );
		SMWExporter::$m_ent_wiki     = $smwgNamespace;
		SMWExporter::$m_ent_property = SMWExporter::$m_ent_wiki . SMWExporter::encodeURI( urlencode( str_replace( ' ', '_', $wgContLang->getNsText( SMW_NS_PROPERTY ) . ':' ) ) );
		$title = SpecialPage::getTitleFor( 'ExportRDF' );
		SMWExporter::$m_exporturl    = '&wikiurl;' . $title->getPrefixedURL();
	}

	/**
	 * Create exportable data from a given semantic data record.
	 */
	static public function makeExportData( /*SMWSemanticData*/ $semdata ) {
		SMWExporter::initBaseURIs();
		$subject = $semdata->getSubject();
		if ( $subject->getNamespace() == SMW_NS_PROPERTY ) {
			$types = $semdata->getPropertyValues( new SMWDIProperty( '_TYPE' ) );
		} else {
			$types = array();
		}
		$result = SMWExporter::makeExportDataForSubject( $subject, end( $types ) );
		foreach ( $semdata->getProperties() as $property ) {
			SMWExporter::addPropertyValues( $property, $semdata->getPropertyValues( $property ), $result );
		}
		return $result;
	}
	
	/**
	 * Make an SMWExpData object for the given page, and include the basic
	 * properties about this subject that are not directly represented by
	 * SMW property values. The optional parameter $typevalueforproperty
	 * can be used to pass a particular SMWTypesValue object that is used
	 * for determining the OWL type for property pages.
	 *
	 * @param SMWDIWikiPage $subject
	 * @param mixed $typesvalueforproperty either an SMWTypesValue or null
	 */
	static public function makeExportDataForSubject( SMWDIWikiPage $subject, $typesvalueforproperty = null ) {		
		$result = self::getDataItemExpData( $subject );
		$subj_title = Title::makeTitle( $subject->getNamespace(), $subject->getDBkey() );
		switch ( $subject->getNamespace() ) {
			case NS_CATEGORY: case SMW_NS_CONCEPT:
				$maintype_pe = SMWExporter::getSpecialElement( 'owl', 'Class' );
				$label = $subj_title->getText();
			break;
			case SMW_NS_PROPERTY:
				if ( $typesvalueforproperty == null ) {
					$types = smwfGetStore()->getPropertyValues( $subject, new SMWDIProperty( '_TYPE' ) );
					$typesvalueforproperty = end( $types );
				}
				$maintype_pe = SMWExporter::getSpecialElement( 'owl', SMWExporter::getOWLPropertyType( $typesvalueforproperty ) );
				$label = $subj_title->getText();
			break;
			default:
				$label = $subj_title->getPrefixedText();
				$maintype_pe = SMWExporter::getSpecialElement( 'swivt', 'Subject' );
		}
		$ed = new SMWExpData( new SMWExpLiteral( $label ) );
		$result->addPropertyObjectValue( SMWExporter::getSpecialElement( 'rdfs', 'label' ), $ed );
		$ed = new SMWExpData( new SMWExpResource( '&wikiurl;' . $subj_title->getPrefixedURL() ) );
		$result->addPropertyObjectValue( SMWExporter::getSpecialElement( 'swivt', 'page' ), $ed );
		$ed = new SMWExpData( new SMWExpResource( SMWExporter::$m_exporturl . '/' . $subj_title->getPrefixedURL() ) );
		$result->addPropertyObjectValue( SMWExporter::getSpecialElement( 'rdfs', 'isDefinedBy' ), $ed );
		$result->addPropertyObjectValue( SMWExporter::getSpecialElement( 'rdf', 'type' ), new SMWExpData( $maintype_pe ) );
		$ed = new SMWExpData( new SMWExpLiteral( $subject->getNamespace(), null, 'http://www.w3.org/2001/XMLSchema#integer' ) );
		$result->addPropertyObjectValue( SMWExporter::getSpecialElement( 'swivt', 'wikiNamespace' ), $ed );
		return $result;
	}
	
	/**
	 * Extend a given SMWExpData element by adding export data for the
	 * specified property data itme. This method is called when
	 * constructing export data structures from SMWSemanticData objects.
	 *
	 * @param $property SMWDIProperty
	 * @param $dataItems array of SMWDataItem objects for the given property
	 * @param $data SMWExpData to add the data to
	 */
	static public function addPropertyValues( SMWDIProperty $property, $dataItems, SMWExpData &$expData ) {
		if ( $property->isUserDefined() ) {
			$pe = SMWExporter::getResourceElement( $property );
			foreach ( $dataItems as $dataItem ) {
				$ed = self::getDataItemExpData( $dataItem );
				if ( $ed !== null ) {
					$expData->addPropertyObjectValue( $pe, $ed );
				}
			}
		} else { // pre-defined property, only exported if known
			$subject = $expData->getSubject()->getDatavalue();
			if ( $subject == null ) return; // subject datavalue (wikipage) required for treating special properties properly
			switch ( $subject->getNamespace() ) {
				case NS_CATEGORY: case SMW_NS_CONCEPT:
					$category_pe = SMWExporter::getSpecialElement( 'rdfs', 'subClassOf' );
					$subprop_pe  = null;
					$equality_pe = SMWExporter::getSpecialElement( 'owl', 'equivalentClass' );
				break;
				case SMW_NS_PROPERTY:
					$category_pe = SMWExporter::getSpecialElement( 'rdf', 'type' );
					$subprop_pe  = SMWExporter::getSpecialElement( 'rdfs', 'subPropertyOf' );
					$equality_pe = SMWExporter::getSpecialElement( 'owl', 'equivalentProperty' );
				break;
				default:
					$category_pe = SMWExporter::getSpecialElement( 'rdf', 'type' );
					$subprop_pe  = null;
					$equality_pe = SMWExporter::getSpecialElement( 'owl', 'sameAs' );
			}
			$pe = null;
			$cat_only = false; // basic namespace checking for equivalent categories
			switch ( $property->getKey() ) {
				///TODO: distinguish instanceof and subclassof in the _INST case
				case '_INST': $pe = $category_pe; break;
				case '_CONC': $pe = $equality_pe; break;
				case '_URI':  $pe = $equality_pe; break;
				case '_SUBP': $pe = $subprop_pe;  break;
				case '_MDAT':
					$pe = SMWExporter::getSpecialElement( 'swivt', 'wikiPageModificationDate' );
				break;
				case '_REDI': /// TODO: currently no check for avoiding OWL DL illegal redirects is done
					if ( $subject->getNamespace() == SMW_NS_PROPERTY ) {
						$pe = null; // checking the typing here is too cumbersome, smart stores will smush the properties anyway, and the others will not handle them equivalently
					} else {
						$pe = $equality_pe;
						$cat_only = ( $subject->getNamespace() == NS_CATEGORY );
					}
				break;
			}
			if ( $pe === null ) return; // unknown special property, not exported 
			foreach ( $dataItems as $dataItem ) {
				if ( $cat_only ) {
					if ( !( $dataItem instanceof SMWDIWikiPage ) || ( $dataItem->getNamespace() != NS_CATEGORY ) ) {
						continue;
					}
				}
				$ed = self::getDataItemExpData( $dataItem );
				if ( $ed !== null ) {
					if ( ( $property->getKey() == '_CONC' ) && ( $ed->getSubject()->getName() == '' ) ) {
						// equivalent to anonymous class -> simplify description
						foreach ( $ed->getProperties() as $subp ) {
							if ( $subp->getName() != SMWExporter::getSpecialElement( 'rdf', 'type' )->getName() ) {
								foreach ( $ed->getValues( $subp ) as $subval ) {
									$expData->addPropertyObjectValue( $subp, $subval );
								}
							}
						}
					} else {
						$expData->addPropertyObjectValue( $pe, $ed );
					}
				}
			}
		}
	}

	/**
	 * Create an SMWExpElement for some internal resource, given by an
	 * SMWDIWikiPage or SMWDIProperty object.
	 * This is the one place in the code where URIs of wiki pages and
	 * properties are defined.
	 *
	 * @param $resource SMWDataItem must be SMWDIWikiPage or SMWDIProperty
	 * @return SMWExpResource
	 */
	static public function getResourceElement( SMWDataItem $resource ) {
		global $wgContLang;
		if ( $resource instanceof SMWDIWikiPage ) {
			$diWikiPage = $resource;
		} elseif ( $resource instanceof SMWDIProperty ) {
			$diWikiPage = $resource->getDiWikiPage();
			if ( $diWikiPage === null ) { /// TODO Maybe treat special properties here, too
				return null;
			}
		} else {
			throw new InvalidArgumentException( 'SMWExporter::getResourceElement() expects an object of type SMWDIWikiPage or SMWDIProperty' );
		}
		$importDis = smwfGetStore()->getPropertyValues( $diWikiPage, new SMWDIProperty( '_IMPO' ) );
		if ( count( $importDis ) > 0 ) {
			$namespace = current( $importDis )->getNS();
			$namespaceid = current( $importDis )->getNSID();
			$localname = current( $importDis )->getLocalName();
		} else {
			$localname = '';
			if ( $diWikiPage->getNamespace() == SMW_NS_PROPERTY ) {
				$namespace = '&property;';
				$namespaceid = 'property';
				$localname = SMWExporter::encodeURI( rawurlencode( $diWikiPage->getDBkey() ) );
			}
			if ( ( $localname == '' ) ||
			     ( in_array( $localname[0], array( '-', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ) ) ) ) {
				$namespace = '&wiki;';
				$namespaceid = 'wiki';
				$nsText = str_replace( ' ', '_', $wgContLang->getNSText( $diWikiPage->getNamespace() ) );
				$localname = SMWExporter::encodeURI( wfUrlencode( $nsText . ':' . $diWikiPage->getDBkey() ) );
			}
		}

		return new SMWExpResource( $localname, $diWikiPage, $namespace, $namespaceid );
	}

	/**
	 * Determine what kind of OWL property some SMW property should be exported as.
	 * The input is an SMWTypesValue object, a typeid string, or empty (use default)
	 * @todo An improved mechanism for selecting property types here is needed.
	 */
	static public function getOWLPropertyType( $type = '' ) {
		if ( $type instanceof SMWTypesValue ) {
			$type = $type->getDBkey();
		} elseif ( $type == false ) {
			$type = '';
		} // else keep $type
		switch ( $type ) {
			case '_anu': return 'AnnotationProperty';
			case '': case '_wpg': case '_wpp': case '_wpc': case '_wpf':
			case '_uri': case '_ema': case '_tel': case '_rec': case '__typ':
			case '__red': case '__spf': case '__spu':
				return 'ObjectProperty';
			default: return 'DatatypeProperty';
		}
	}

	/**
	 * Create an SMWExportElement for some special element that belongs to a known vocabulary.
	 * The parameter given must be a supported namespace id (e.g. "rdfs") and a local name (e.g. "label").
	 * Returns NULL if $namespace is not known.
	 */
	static public function getSpecialElement( $namespace, $localname ) {
		$namespaces = array(
			'swivt' => '&swivt;',
			'rdfs'  => '&rdfs;',
			'rdf'   => '&rdf;',
			'owl'   => '&owl;',
		);
		if ( array_key_exists( $namespace, $namespaces ) ) {
			return new SMWExpResource( $localname, null, $namespaces[$namespace], $namespace );
		} else {
			return null;
		}
	}

	/**
	 * This function escapes symbols that might be problematic in XML in a uniform
	 * and injective way. It is used to encode URIs.
	 */
	static public function encodeURI( $uri ) {
		$uri = str_replace( '-', '-2D', $uri );
		// $uri = str_replace( '_', '-5F', $uri); //not necessary
		$uri = str_replace( array( ':', '"', '#', '&', "'", '+', '!', '%' ),
		                    array( '-3A', '-22', '-23', '-26', '-27', '-2B', '-21', '-' ),
		                    $uri );
		return $uri;
	}

	/**
	 * This function unescapes URIs generated with SMWExporter::encodeURI. This
	 * allows services that receive a URI to extract e.g. the according wiki page.
	 */
	static public function decodeURI( $uri ) {
		$uri = str_replace( array( '-3A', '-22', '-23', '-26', '-27', '-2B', '-21', '-' ),
		                    array( ':', '"', '#', '&', "'", '+', '!', '%' ),
		                   $uri );
		$uri = str_replace( '%2D', '-', $uri );
		return $uri;
	}

	/**
	 * This function expands standard XML entities used in some generated
	 * URIs. Given a string with such entities, it returns a string with
	 * all entities properly replaced.
	 */
	static public function expandURI( $uri ) {
		SMWExporter::initBaseURIs();
		$uri = str_replace( array( '&wiki;', '&wikiurl;', '&property;', '&owl;', '&rdf;', '&rdfs;', '&swivt;', '&export;' ),
		                    array( SMWExporter::$m_ent_wiki, SMWExporter::$m_ent_wikiurl, SMWExporter::$m_ent_property, 'http://www.w3.org/2002/07/owl#', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#', 'http://www.w3.org/2000/01/rdf-schema#', 'http://semantic-mediawiki.org/swivt/1.0#',
		                    SMWExporter::$m_exporturl ),
		                    $uri );
		return $uri;
	}

	/**
	 * Create an SMWExpData container that encodes the ontology header for an
	 * SMW exported OWL file.
	 * 
	 * @param string $ontologyuri specifying the URI of the ontology, possibly
	 * empty
	 */
	static public function getOntologyExpData( $ontologyuri ) {
		$data = new SMWExpData( new SMWExpResource( $ontologyuri ) );
		$ed = new SMWExpData( SMWExporter::getSpecialElement( 'owl', 'Ontology' ) );
		$data->addPropertyObjectValue( SMWExporter::getSpecialElement( 'rdf', 'type' ), $ed );
		$ed = new SMWExpData( new SMWExpLiteral( date( DATE_W3C ), null, 'http://www.w3.org/2001/XMLSchema#dateTime' ) );
		$data->addPropertyObjectValue( SMWExporter::getSpecialElement( 'swivt', 'creationDate' ), $ed );
		$ed = new SMWExpData( new SMWExpResource( 'http://semantic-mediawiki.org/swivt/1.0' ) );
		$data->addPropertyObjectValue( SMWExporter::getSpecialElement( 'owl', 'imports' ), $ed );
		return $data;
	}

	/**
	 * Create an SWMExpData container that encodes the data of the given
	 * dataitem object.
	 * 
	 * @param $dataItem SMWDataItem
	 * @return SMWExpData
	 */
	static public function getDataItemExpData( SMWDataItem $dataItem ) {
		switch ( $dataItem->getDIType() ) {
			case SMWDataItem::TYPE_NUMBER:	
				$lit = new SMWExpLiteral( $dataItem->getNumber(), $dataItem, 'http://www.w3.org/2001/XMLSchema#double' );
				return new SMWExpData( $lit );
			break;
			case SMWDataItem::TYPE_STRING: case SMWDataItem::TYPE_BLOB:
				$lit = new SMWExpLiteral( smwfHTMLtoUTF8( $dataItem->getString() ), $dataItem, 'http://www.w3.org/2001/XMLSchema#string' );
				return new SMWExpData( $lit );
			break;
			case SMWDataItem::TYPE_BOOLEAN:
				$xsdvalue =  $dataItem->getBoolean() ? 'true' : 'false';
				$lit = new SMWExpLiteral( $xsdvalue, $dataItem, 'http://www.w3.org/2001/XMLSchema#boolean' );
				return new SMWExpData( $lit );
			break;
			case SMWDataItem::TYPE_URI:
				/// TODO This escaping seems very odd. The serialisation should handle such things.
				$res = new SMWExpResource( str_replace( '&', '&amp;', $dataItem->getURI() ), $dataItem );
				return new SMWExpData( $res );
			break;
			case SMWDataItem::TYPE_TIME:
				$gregorianTime = $dataItem->getForCalendarModel( SMWDITime::CM_GREGORIAN );
				if ( $gregorianTime->getYear() > 0 ) {
					$xsdvalue = str_pad( $gregorianTime->getYear(), 4, "0", STR_PAD_LEFT );
				} else {
					$xsdvalue = '-' . str_pad( 1 - $gregorianTime->getYear(), 4, "0", STR_PAD_LEFT );
				}
				$xsdtype = 'http://www.w3.org/2001/XMLSchema#gYear';
				if ( $gregorianTime->getPrecision() >= SMWDITime::PREC_YM ) {
					$xsdtype = 'http://www.w3.org/2001/XMLSchema#gYearMonth';
					$xsdvalue .= '-' . str_pad( $gregorianTime->getMonth(), 2, "0", STR_PAD_LEFT );
					if ( $gregorianTime->getPrecision() >= SMWDITime::PREC_YMD ) {
						$xsdtype = 'http://www.w3.org/2001/XMLSchema#date';
						$xsdvalue .= '-' . str_pad( $gregorianTime->getDay(), 2, "0", STR_PAD_LEFT );
						if ( $gregorianTime->getPrecision() == SMWDITime::PREC_YMDT ) {
							$xsdtype = 'http://www.w3.org/2001/XMLSchema#dateTime';
							$xsdvalue .= 'T' .
							     sprintf( "%02d", $gregorianTime->getHour() ) . ':' .
							     sprintf( "%02d", $gregorianTime->getMinute()) . ':' .
							     sprintf( "%02d", $gregorianTime->getSecond() );
						}
					}
				}
				$xsdvalue .= 'Z';
				$lit = new SMWExpLiteral( $xsdvalue, $gregorianTime, $xsdtype );
				return new SMWExpData( $lit );
			break;
			case SMWDataItem::TYPE_GEO:
				/// TODO
				return null;
			break;
			case SMWDataItem::TYPE_CONTAINER:
				/// TODO
				return null;
			break;
			case SMWDataItem::TYPE_WIKIPAGE:
				if ( $dataItem->getNamespace() == NS_MEDIA ) { // special handling for linking media files directly (object only)
					$title = Title::makeTitle( $dataItem->getNamespace(), $dataItem->getDBkey() ) ;
					$file = wfFindFile( $title );
					if ( $file !== false ) {
						return new SMWExpData( new SMWExpResource( $file->getFullURL() ) );
					} else { // Medialink to non-existing file :-/
						return new SMWExpData( SMWExporter::getResourceElement( $dataItem ) );
					}
				} else {
					return new SMWExpData( SMWExporter::getResourceElement( $dataItem ) );
				}
			break;
			case SMWDataItem::TYPE_CONCEPT:
				/// TODO
			break;
			case SMWDataItem::TYPE_PROPERTY:
				return new SMWExpData( SMWExporter::getResourceElement( $dataItem->getDiWikiPage() ) );
			break;
		}
	}

}

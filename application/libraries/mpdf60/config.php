<?php

$this->mirrorMargins = 0;
$this->forcePortraitMargins = false;
$this->displayDefaultOrientation = false;
$this->printers_info = false;
$this->bleedMargin = 5;
$this->crossMarkMargin = 5;
$this->cropMarkMargin = 8;
$this->cropMarkLength = 18;
$this->nonPrintMargin = 8;
$this->defaultPagebreakType = 'slice';
$this->margBuffer = 2;

$this->pagenumPrefix='';
$this->pagenumSuffix='';
$this->nbpgPrefix='';
$this->nbpgSuffix='';
$this->defaultPageNumStyle = '1';
$this->maxTTFFilesize = 2000;

$this->percentSubset = 30;

$this->useAdobeCJK = false;
$this->repackageTTF = false;

$this->allow_charset_conversion = true;
$this->biDirectional=false;

$this->autoScriptToLang = false;
$this->baseScript = 1;
$this->autoVietnamese = true;
$this->autoArabic = true;

$this->autoLangToFont = false;

$this->useSubstitutions = false;
$this->falseBoldWeight = 5;
$this->allow_output_buffering = false;

$this->enableImports = false;

$this->collapseBlockMargins = true;
$this->progressBar = 0;
$this->progbar_heading = 'mPDF file progress';
$this->progbar_altHTML = '';

$this->dpi = 96;

$this->allow_html_optional_endtags = true;

$this->ignore_invalid_utf8 = false;
$this->text_input_as_HTML = false;
$this->useGraphs = false;

$this->incrementFPR1 = 10;
$this->incrementFPR2 = 20;
$this->incrementFPR3 = 30;
$this->incrementFPR4 = 50;

$this->restrictColorSpace = 0;

$this->PDFX = false;
$this->PDFXauto = false;

$this->PDFA = false;
$this->PDFAauto = false;
$this->ICCProfile = '';

$this->showStats = false;
$this->debug = false;
$this->debugfonts = false;
$this->showImageErrors = false;
$this->table_error_report = false;
$this->table_error_report_param = '';

$this->title2annots = false;
$this->annotSize = 0.5;
$this->annotMargin;
$this->annotOpacity = 0.5;

$this->anchor2Bookmark = 0;
$this->bookmarkStyles = array();

$this->h2bookmarks = array();

$this->h2toc = array();
$this->indexUseSubentries = true;

$this->CSSselectMedia='print';

$this->forcePortraitHeaders = false;
$this->defaultheaderfontsize = 8;
$this->defaultheaderfontstyle = 'BI';
$this->defaultheaderline = 1;
$this->defaultfooterfontsize = 8;
$this->defaultfooterfontstyle = 'BI';
$this->defaultfooterline = 1;
$this->header_line_spacing = 0.25;
$this->footer_line_spacing = 0.25;
$this->setAutoTopMargin = false;
$this->setAutoBottomMargin = false;
$this->autoMarginPadding = 2;

$this->simpleTables = false;
$this->packTableData = false;

$this->ignore_table_percents = false;
$this->ignore_table_widths = false;
$this->keep_table_proportions = true;
$this->shrink_tables_to_fit = 1.4;

$this->tableMinSizePriority = false;
$this->use_kwt = false;
$this->iterationCounter = false;
$this->splitTableBorderWidth = 0;

$this->decimal_align = array('DP'=>'.', 'DC'=>',', 'DM'=>"\xc2\xb7", 'DA'=>"\xd9\xab", 'DD'=>'-');


// IMAGES
$this->interpolateImages = false;
$this->img_dpi = 96;

$this->useKerning = false;
$this->justifyB4br = false;

$this->tabSpaces = 8;
$this->jSWord = 0.4;
$this->jSmaxChar = 2;

$this->jSmaxCharLast = 1;
$this->jSmaxWordLast = 2;
$this->useFixedNormalLineHeight = false;

$this->useFixedTextBaseline = false;

$this->normalLineheight = 1.33;
$this->adjustFontDescLineheight = 1.14;
$this->smCapsScale = 0.75;
$this->smCapsStretch = 110;

$this->useDictionaryLBR = true;
$this->useTibetanLBR = true;

$this->allowCJKorphans = true;
$this->allowCJKoverflow = false;
$this->CJKforceend = false;

$this->SHYlang = "en";
$this->SHYleftmin = 2;
$this->SHYrightmin = 2;
$this->SHYcharmin = 2;
$this->SHYcharmax = 10;

$this->keepColumns = false;
$this->max_colH_correction = 1.15;
$this->ColGap=5;

$this->list_auto_mode = 'browser';
$this->list_indent_default = '40px';
$this->list_indent_default_mpdf = '0em';
$this->list_indent_first_level = 0;

$this->list_number_suffix = '.';
$this->list_marker_offset = '5.5pt';
$this->list_symbol_size = '3.6pt';

$this->useActiveForms = false;

$this->watermarkImgBehind = false;
$this->showWatermarkText = 0;
$this->showWatermarkImage = 0;
$this->watermarkText = '';
$this->watermarkImage = '';
$this->watermark_font = '';
$this->watermarkTextAlpha = 0.2;
$this->watermarkImageAlpha = 0.2;
$this->watermarkImgAlphaBlend = 'Normal';
$this->autoPadding = false;


$this->defaultCSS = array(
	'BODY' => array(
		'FONT-FAMILY' => 'serif',
		'FONT-SIZE' => '13pt',
		'TEXT-INDENT' => '0pt',
		'LINE-HEIGHT' => 'normal',
		'MARGIN-COLLAPSE' => 'collapse',
		'HYPHENS' => 'manual',
		'FONT-KERNING' => 'auto',
	),
	'P' => array(
		'MARGIN' => '1.12em 0',
	),
	'H1' => array(
		'FONT-SIZE' => '2em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '0.67em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H2' => array(
		'FONT-SIZE' => '1.5em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '0.75em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H3' => array(
		'FONT-SIZE' => '1.17em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '0.83em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H4' => array(
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '1.12em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H5' => array(
		'FONT-SIZE' => '0.83em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '1.5em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H6' => array(
		'FONT-SIZE' => '0.75em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '1.67em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'HR' => array(
		'COLOR' => '#888888',
		'TEXT-ALIGN' => 'center',
		'WIDTH' => '100%',
		'HEIGHT' => '0.2mm',
		'MARGIN-TOP' => '0.83em',
		'MARGIN-BOTTOM' => '0.83em',
	),
	'PRE' => array(
		'MARGIN' => '0.83em 0',
		'FONT-FAMILY' => 'monospace',
	),
	'S' => array(
		'TEXT-DECORATION' => 'line-through',
	),
	'STRIKE' => array(
		'TEXT-DECORATION' => 'line-through',
	),
	'DEL' => array(
		'TEXT-DECORATION' => 'line-through',
	),
	'SUB' => array(
		'VERTICAL-ALIGN' => 'sub',
		'FONT-SIZE' => '55%',
	),
	'SUP' => array(
		'VERTICAL-ALIGN' => 'super',
		'FONT-SIZE' => '55%',
	),
	'U' => array(
		'TEXT-DECORATION' => 'underline',
	),
	'INS' => array(
		'TEXT-DECORATION' => 'underline',
	),
	'B' => array(
		'FONT-WEIGHT' => 'bold',
	),
	'STRONG' => array(
		'FONT-WEIGHT' => 'bold',
	),
	'I' => array(
		'FONT-STYLE' => 'italic',
	),
	'CITE' => array(
		'FONT-STYLE' => 'italic',
	),
	'Q' => array(
		'FONT-STYLE' => 'italic',
	),
	'EM' => array(
		'FONT-STYLE' => 'italic',
	),
	'VAR' => array(
		'FONT-STYLE' => 'italic',
	),
	'SAMP' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'CODE' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'KBD' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'TT' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'SMALL' => array(
		'FONT-SIZE' => '83%',
	),
	'BIG' => array(
		'FONT-SIZE' => '117%',
	),
	'ACRONYM' => array(
		'FONT-SIZE' => '77%',
		'FONT-WEIGHT' => 'bold',
	),
	'ADDRESS' => array(
		'FONT-STYLE' => 'italic',
	),
	'BLOCKQUOTE' => array(
		'MARGIN-LEFT' => '40px',
		'MARGIN-RIGHT' => '40px',
		'MARGIN-TOP' => '1.12em',
		'MARGIN-BOTTOM' => '1.12em',
	),
	'A' => array(
		'COLOR' => '#0000FF',
		'TEXT-DECORATION' => 'underline',
	),
	'UL' => array(
		'PADDING' => '0 auto',
		'MARGIN-TOP' => '0.83em',
		'MARGIN-BOTTOM' => '0.83em',
	),
	'OL' => array(
		'PADDING' => '0 auto',
		'MARGIN-TOP' => '0.83em',
		'MARGIN-BOTTOM' => '0.83em',
	),
	'DL' => array(
		'MARGIN' => '1.67em 0',
	),
	'DT' => array(
	),
	'DD' => array(
		'PADDING-LEFT' => '40px',
	),
	'TABLE' => array(
		'MARGIN' => '0',
		'BORDER-COLLAPSE' => 'separate',
		'BORDER-SPACING' => '2px',
		'EMPTY-CELLS' => 'show',
		'LINE-HEIGHT' => '1.2',
		'VERTICAL-ALIGN' => 'middle',
		'HYPHENS' => 'manual',
		'FONT-KERNING' => 'auto',
	),
	'THEAD' => array(
	),
	'TBODY' => array(
	),
	'TFOOT' => array(
	),
	'TH' => array(
		'FONT-WEIGHT' => 'bold',
		'TEXT-ALIGN' => 'center',
		'PADDING-LEFT' => '0.1em',
		'PADDING-RIGHT' => '0.1em',
		'PADDING-TOP' => '0.1em',
		'PADDING-BOTTOM' => '0.1em',
	),
	'TD' => array(
		'PADDING-LEFT' => '0.1em',
		'PADDING-RIGHT' => '0.1em',
		'PADDING-TOP' => '0.1em',
		'PADDING-BOTTOM' => '0.1em',
	),
	'CAPTION' => array(
		'TEXT-ALIGN' => 'center',
	),
	'IMG' => array(
		'MARGIN' => '0',
		'VERTICAL-ALIGN' => 'baseline',
		'IMAGE-RENDERING' => 'auto',
	),
	'INPUT' => array(
		'FONT-FAMILY' => 'sans-serif',
		'VERTICAL-ALIGN' => 'middle',
		'FONT-SIZE' => '0.9em',
	),
	'SELECT' => array(
		'FONT-FAMILY' => 'sans-serif',
		'FONT-SIZE' => '0.9em',
		'VERTICAL-ALIGN' => 'middle',
	),
	'TEXTAREA' => array(
		'FONT-FAMILY' => 'monospace',
		'FONT-SIZE' => '0.9em',
		'VERTICAL-ALIGN' => 'text-bottom',
	),
	'MARK' => array(	/* mPDF 5.5.09 */
		'BACKGROUND-COLOR' => 'yellow',
	),
);

$this->pdf_version = '1.4';
$this->SHYlanguages = array('en','de','es','fi','fr','it','nl','pl','ru','sv');
$this->default_lineheight_correction=1.2;

$this->fontsizes = array('XX-SMALL'=>0.7, 'X-SMALL'=>0.77, 'SMALL'=>0.86, 'MEDIUM'=>1, 'LARGE'=>1.2, 'X-LARGE'=>1.5, 'XX-LARGE'=>2);

	$this->pregRTLchars = "\x{0590}-\x{06FF}\x{0700}-\x{085F}\x{FB00}-\x{FDFD}\x{FE70}-\x{FEFF}";		// 085F to include Mandaic
	$this->pregCJKchars = "\x{1100}-\x{11FF}\x{2E80}-\x{A4CF}\x{A800}-\x{D7AF}\x{F900}-\x{FAFF}\x{FE30}-\x{FE6F}\x{FF00}-\x{FFEF}\x{20000}-\x{2FA1F}";
	$this->CJKleading = "\$\(\*\[\{\x{00a3}\x{00a5}\x{00ab}\x{00b7}\x{2018}\x{201c}\x{2035}\x{3005}\x{3007}\x{3008}\x{300a}\x{300c}\x{300e}\x{3010}\x{3014}\x{3016}\x{3018}\x{301d}\x{fe34}\x{fe35}\x{fe37}\x{fe39}\x{fe3b}\x{fe3d}\x{fe3f}\x{fe41}\x{fe43}\x{fe57}\x{fe59}\x{fe5b}\x{fe5d}\x{ff04}\x{ff08}\x{ff0e}\x{ff3b}\x{ff5b}\x{ff5f}\x{ff62}\x{ffe1}\x{ffe5}\x{ffe6}";
	$this->CJKfollowing = "!%\),\.:;>\?\]\}\x{00a2}\x{00a8}\x{00b0}\x{00b7}\x{00bb}\x{02c7}\x{02c9}\x{2010}\x{2013}-\x{2016}\x{2019}\x{201d}-\x{201f}\x{2020}-\x{2022}\x{2025}-\x{2027}\x{2030}\x{2032}\x{2033}\x{203a}\x{203c}\x{2047}-\x{2049}\x{2103}\x{2236}\x{2574}\x{3001}-\x{3003}\x{3005}\x{3006}\x{3009}\x{300b}\x{300d}\x{300f}\x{3011}\x{3015}\x{3017}\x{3019}\x{301c}\x{301e}\x{301f}\x{303b}\x{3041}\x{3043}\x{3045}\x{3047}\x{3049}\x{3063}\x{3083}\x{3085}\x{3087}\x{308e}\x{3095}\x{3096}\x{309b}-\x{309e}\x{30a0}\x{30a1}\x{30a3}\x{30a5}\x{30a7}\x{30a9}\x{30c3}\x{30e3}\x{30e5}\x{30e7}\x{30ee}\x{30f5}\x{30f6}\x{30fb}-\x{30fd}\x{30fe}\x{31f0}-\x{31ff}\x{fe30}\x{fe31}-\x{fe34}\x{fe36}\x{fe38}\x{fe3a}\x{fe3c}\x{fe3e}\x{fe40}\x{fe42}\x{fe44}\x{fe4f}\x{fe50}-\x{fe58}\x{fe5a}\x{fe5c}-\x{fe5e}\x{ff01}\x{ff02}\x{ff05}\x{ff07}\x{ff09}\x{ff0c}\x{ff0e}\x{ff1a}\x{ff1b}\x{ff1f}\x{ff3d}\x{ff40}\x{ff5c}-\x{ff5e}\x{ff60}\x{ff61}\x{ff63}-\x{ff65}\x{ff9e}\x{ff9f}\x{ffe0}";
	$this->CJKoverflow = "\.,\x{ff61}\x{ff64}\x{3001}\x{3002}\x{fe50}-\x{fe52}\x{ff0c}\x{ff0e}";
	$this->pregCURSchars = "\x{0590}-\x{083E}\x{0900}-\x{0DFF}\x{FB00}-\x{FDFD}\x{FE70}-\x{FEFF}";


$this->allowedCSStags = 'DIV|P|H1|H2|H3|H4|H5|H6|FORM|IMG|A|BODY|TABLE|HR|THEAD|TFOOT|TBODY|TH|TR|TD|UL|OL|LI|PRE|BLOCKQUOTE|ADDRESS|DL|DT|DD';
$this->allowedCSStags .= '|ARTICLE|ASIDE|FIGURE|FIGCAPTION|FOOTER|HEADER|HGROUP|NAV|SECTION|MAIN|MARK|DETAILS|SUMMARY|METER|PROGRESS|TIME';
$this->allowedCSStags .= '|SPAN|TT|I|B|BIG|SMALL|EM|STRONG|DFN|CODE|SAMP|KBD|VAR|CITE|ABBR|ACRONYM|STRIKE|S|U|DEL|INS|Q|FONT';
$this->allowedCSStags .= '|SELECT|INPUT|TEXTAREA|CAPTION|FIELDSET|LEGEND';
$this->allowedCSStags .= '|TEXTCIRCLE|DOTTAB|BDO|BDI';

$this->outerblocktags = array('DIV','FORM','CENTER','DL','FIELDSET','ARTICLE','ASIDE','FIGURE','FIGCAPTION', 'FOOTER','HEADER','HGROUP','MAIN','NAV','SECTION','DETAILS','SUMMARY','UL','OL','LI');
$this->innerblocktags = array('P','BLOCKQUOTE','ADDRESS','PRE','H1','H2','H3','H4','H5','H6','DT','DD','CAPTION');

?>

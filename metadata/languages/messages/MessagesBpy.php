<?php
/** Bishnupriya Manipuri (বিষ্ণুপ্রিয়া মণিপুরী)
 *
 * @package MediaWiki
 * @subpackage Language
 * @Author Uttam Singha, Dec 2006
 */
$rtl = false;
$namespaceNames = array(
	NS_MEDIA        => 'মিডিয়া',
	NS_SPECIAL        => 'বিশেষ',
	NS_MAIN           => '',
	NS_TALK           => 'য়্যারী',
	NS_USER           => 'আতাকুরা',
	NS_USER_TALK      => 'আতাকুরার_য়্যারী',
	# NS_PROJECT set by $wgMetaNamespace
	NS_PROJECT_TALK   => '$1_য়্যারী',
	NS_IMAGE          => 'ছবি',
	NS_IMAGE_TALK     => 'ছবি_য়্যারী',
	NS_MEDIAWIKI => 'মিডিয়াউইকি',
	NS_MEDIAWIKI_TALK => 'মিডিয়াউইকির_য়্যারী',
	NS_TEMPLATE => 'মডেল',
	NS_TEMPLATE_TALK => 'মডেলর_য়্যারী',
	NS_HELP => 'পাংলাক',
	NS_HELP_TALK => 'পাংলাকর_য়্যারী',
	NS_CATEGORY => 'থাক',
	NS_CATEGORY_TALK => 'থাকর_য়্যারী',
);

$messages = array(
# Dates

'sunday' => 'লামুইসিং',
'monday' => 'নিংথৌকাপা',
'tuesday' => 'লেইপাকপা',
'wednesday' => 'ইনসাইনসা',
'thursday' => 'সাকলসেন',
'friday' => 'ইরেই',
'saturday' => 'থাংচা',
'january' => 'জানুয়ারী',
'february' => 'ফেব্রুয়ারী',
'march' => 'মার্চ',
'april' => 'এপ্রিল',
'may_long' => 'মে',
'june' => 'জুন',
'july' => 'জুলাই',
'august' => 'আগস্ট',
'september' => 'সেপ্টেম্বর',
'october' => 'অক্টোবর',
'november' => 'নভেম্বর',
'december' => 'ডিসেম্বর',
'jan' => 'জানু',
'feb' => 'ফেব্রু',
'mar' => 'মার্চ',
'apr' => 'এপ্রিল',
'may' => 'মে',
'jun' => 'জুন',
'jul' => 'জুলাই',
'aug' => 'আগস্ট',
'sep' => 'সেপ্টে',
'oct' => 'অক্টো',
'nov' => 'নভে',
'dec' => 'ডিসে',

# Bits of text used by many pages:
#

'about' => 'বারে',
'aboutpage' => '{{ns:project}}:বারে',
'aboutsite' => '{{SITENAME}}র বারে',
'accmailtext' => '"$1"-র খন্তাচাবি(password) $2-রাঙ দিয়াপেঠৱাদেনা ইল।',
'accmailtitle' => 'খন্তাচাবি(password) দিয়াপেঠৱা দিলাং।',
'accountcreated' => 'একাউন্টহান হঙকরানি ইল',
'accountcreatedtext' => 'আতাকুরা $1 -র কা একাউন্টহান হঙকরানি ইল।',
'acct_creation_throttle_hit' => 'ঙাক্করেদিবাং, তি এবাকাপেয়া $1হান অ্যাকাউন্ট হংকরেবেলাসত৷ অতাত্ত বপ হঙকরানির য়্যাথাং নেই।৷',
'actioncomplete' => 'কামহান লমিল।',
'addedwatch' => 'তালাবির তালিকাহাত থনা ইল',
'addedwatchtext' => '"$1" পাতা এহান তর [[Special:Watchlist|আহির-আরুম তালিকা]]-ত তিলকরানি ইল। পিসেদে এরে পাতা এহান বারো পাতা এহানর লগে সাকেই আসে য়্যারী পাতাত অইতই হারি জাতর পতানি এহানাত তিলকরানি অইতই। অতাবাদেউ [[Special:Recentchanges|হাদি এহানর পতানিহানি]]-ত পাতা এহানরে \'\'\'গাঢ়করা\'\'\' মেয়েকে দেহা দেনা অইতই যাতে তি নুঙিকরে পাতা এহান চিনে পারবেতা। <p>পিসেদে তি পাতা এহানরে থেইকরানি মনেইলে "আহির-আরুমেত্ত থেইকরেদে" ট্যাবগত ক্লিক করিস৷',
'allarticles' => 'নিবন্ধহাবি',
'allinnamespace' => 'পাতাহানি হাবি ($1 নাঙরজাগা)',
'allmessages' => 'সিস্টেমর পৌহানি',
'allmessagescurrent' => 'হাদি এহানর ৱাহি',
'allmessagesmodified' => 'পতাসি অতা হুদ্দা দেহাদে',
'allmessagesname' => 'নাং',
'allmessagestext' => 'তলে মিডিয়াউইকি: নাঙরজাগাত পানা একরের সিস্টেম পৌহানির তালিকাহান দেনা ইল।',
'allowemail' => 'আরতা(ব্যবহার করেকুরা)ই ইমেইল করানির য়্যাথাং দে।',
'allpages' => 'হাবি পাতাহানি',
'allpagesbadtitle' => 'The given page title was invalid or had an inter-language or inter-wiki prefix. It may contain one more characters which cannot be used in titles.',
'allpagesfrom' => 'যেহাত্ত অকরিসি অহাত্ত পাতাহানি দেহাদেঃ',
'allpagesnext' => 'থাঙনাত',
'allpagesprefix' => 'মেয়েক এগন অকরিসি ৱাহির পাতাহানি দেহাদেঃ',
'allpagesprev' => 'আলথকে',
'allpagessubmit' => 'হাত',
'alphaindexline' => '$1 ত $2',
'already_bureaucrat' => 'আতাকুরা এগ এচুদিনে ব্যুরোক্র্যাটগ ইয়াপরিলগাহে',
'already_sysop' => 'আতাকুরা এগ এচুদিনে ডান্ডি(প্রশাসক)গ ইয়াপরিলগাহে',
'alreadyloggedin' => '<strong>আতাকুরা $1, তি আগেত্তর ভিতরে হমিয়া আসতগহে!</strong><br />',
'alreadyrolled' => 'Cannot rollback last edit of [[$1]]
by [[User:$2|$2]] ([[User talk:$2|Talk]]); someone else has edited or rolled back the page already.

Last edit was by [[User:$3|$3]] ([[User talk:$3|Talk]]).',
'ancientpages' => 'পুরানা পাতাহানি',
'and' => 'বারো',
'anoneditwarning' => '\'\'\'সিঙুইসঃ\'\'\' তি লগইন নাকরিসত। পতানির ইতিহাসহাত তর IP addressহান সিজিল ইতই।',
'anontalk' => 'অচিনা এগর য়্যারির পাতা',
'anontalkpagetext' => '<div id="anontalktext"><hr style="clear: both; margin-top:8px" /> \'\'এহান অচিনা অতার য়্যারির পাতাহান। এরে আইপি ঠিকানা (IP Address) এহানাত্ত লগ-ইন নাকরিয়া পতানিত মেইক্ষু অসিল। আক্কুস ক্ষেন্তামে আইপি ঠিকানা হামেসা বদল অর, বিশেষ করিয়া ডায়াল-আপ ইন্টারনেট, প্রক্সি সার্ভার মাহি ক্ষেত্র এতা সিলরতা, বারো আগত্ত বপ ব্যবহারকারেকুরার ক্ষেত্রত প্রযোজ্য ইতে পারে। অহানে তি নিশ্চকে এরে আইপি এহাত্ত উইকিপিডিয়াত হমিয়া কোন য়্যারী দেখর, অহান তরে নিঙকরিয়া নাউ ইতে পারে। অহানে হাবিত্ত হবা অর, তি যদি [[{{ns:Special}}:Userlogin|লগ-ইন করর, বা নৱা একাউন্ট খুলর]] অহানবুলতেউ লগ-ইন করলে কুঙগউ তর আইপি ঠিকানাহান, বারো অহানর মাতুঙে তর অবস্থানহান সুপকরেউ হার না পেইবা।\'\'<br /> [<small><span class="plainlinks">[http://www.dnsstuff.com/tools/ipall.ch?domain={{PAGENAMEE}} আইপি ঠিকানাহার পৌ] &middot; [http://www.dnsstuff.com/tools/tracert.ch?ip={{PAGENAMEE}} ট্রেসরাউট] &middot; [http://www.dnsstuff.com/tools/whois.ch?ip={{PAGENAMEE}} WHOIS] &middot; [http://www.dnsstuff.com/tools/whois.ch?server=whois.abuse.net&ip={{PAGENAMEE}} ৱাকাত] &middot; [http://www.dnsstuff.com/tools/city.ch?ip={{PAGENAMEE}} শহর] &middot; [http://www.dnsstuff.com/tools/ptr.ch?ip={{PAGENAMEE}} উল্টা ডিএনএস]</span></small>] [<small>\'\'\'আঞ্চলিক ইন্টারনেট নিবন্ধনর তালিকা\'\'\': <span class="plainlinks">[http://ws.arin.net/whois/?queryinput={{PAGENAMEE}} আমেরিকা] &middot; [http://www.ripe.net/fcgi-bin/whois?searchtext={{PAGENAMEE}} ইউরোপ] &middot; [http://www.afrinic.net/cgi-bin/whois?query={{PAGENAMEE}} আফ্রিকা] &middot; [http://www.apnic.net/apnic-bin/whois.pl?searchtext={{PAGENAMEE}} এশিয়া-প্যাসিফিক] &middot; [http://www.lacnic.net/cgi-bin/lacnic/whois?lg=EN&query={{PAGENAMEE}} লাতিন আমেরিকা ও ক্যারিবিয় এলাকা]</span></small>] </div>',
'anonymous' => '{{SITENAME}}র বেনাঙর আতাকুরা(গি)',
'articleexists' => 'ইতে পারে এরে শিরোনাঙর নিবন্ধহান হঙপরসেগা, নাইলে তি দিয়াসত শিরোনাং এহান দেনার য়্যাথাং নেই। কৃপা করিয়া আরাক শিরোনাং আহান দেনার হৎনা কর।',
'articlepage' => 'নিবন্ধ চেইক',
'articletitles' => 'যে পাতাহানি \'\'$1\'\' ন অকরাগ, অতার তালিকা',
'autoredircomment' => '[[$1]]-ত যানার বারো-র্নিদেশ করানি ইল',
'badaccess' => 'য়্যাথাঙে লালসে',
'badarticleerror' => 'এরে পাতা এহান কাম এহান করানি সম্ভব নেই।',
'badfilename' => 'ফাইলগর নাঙহান পতিয়া $1" করানি ইল।',
'badipaddress' => 'আইপি ঠিকানাহান গ্রহনযোগ্যনাইসে',
'badretype' => 'খন্তাচাবি (password) দ্বিয়গি না মিলের।',
'badtitle' => 'শিরোনাঙহান গ্রহনযোগ্য নাইসে।',
'badtitletext' => 'The requested page title was invalid, empty, or an incorrectly linked inter-language or inter-wiki title. It may contain one more characters which cannot be used in titles.',
'blanknamespace' => '(গুরি)',
'blockedtext' => 'তর আতাকুরা নাঙহান নাইলেউ আইপি ঠিকানাহানরে $1 থেপকরানি অসে। এহানর কারণহান অসেতাইঃ:<br />\'\'$2\'\'<p>তি $1 নাইলেউ [[Project:প্রশাসকলকেই|প্রশাসকর]] মা যে কোন আগর লগে বিষয় এহান্ন য়্যারি পরি দে পারর। বিশেষ মাতিলতাঃ তর ই-মেইল ঠিকানাহান যদি [[Special:Preferences|তর পছন তালিকাত]] বরিয়া নাথার, অতা ইলে তি উইকিপিডিয়াত হের আতাকুরারে ই-মেইল করানি নুৱারবে। তর আইপি ঠিকানাহান ইলতাই $3। কৃপা করিয়া যে কোন যোগাযোগর সময়ত এরে ঠিকানা এহান যেসাদেউ বরিস।',
'blockedtitle' => 'আতাকুরাগরে থেপ করানি অসে',
'blockip' => 'আতাকুরাগরে থেপকর',
'blockipsuccesssub' => 'থেপকরানিহান চুমিল',
'blockipsuccesstext' => '[[{{ns:Special}}:Contributions/$1|$1]] রে থেপকরিয়া থসি <br />থেপকরানিহান খাল করানি থকিলে,[[{{ns:Special}}:Ipblocklist| থেপকরিয়া থসি আইপি ঠিকানার তালিকাহান]] চা।',
'blocklink' => 'থেপ কর',
'blocklistline' => '$1 তারিখে $2, $3 ($4) রে থেপকরানি অসে।',
'blocklogentry' => '"[[$1]]"-রে $2 মেয়াদর কা থেপকরানি অসে।',
'blocklogpage' => 'থেপকরানির log',
'bold_sample' => 'গাঢ়পা ৱাহি',
'bold_tip' => 'গাঢ়পা ৱাহি',
'booksources' => 'লেরিকর উৎসহান',
'boteditletter' => 'ব',
'brokenredirects' => 'বারো-নির্দেশ কামনাকরের',
'bugreports'  => 'লাল বিবরণী',
'bugreportspage' => '{{ns:project}}:লাল_বিবরণী',
'bydate' => 'তারিখর সিজিলন',
'byname' => 'নাঙর সিজিলন',
'bysize' => 'আকারহানর সিজিলন',
'cachederror' => 'এরে পাতা এহান বা লাতলগ পুছানি নাকরল। (নিঙকরুরিতাঃ আগেদে কুঙগ আগই পুছে বেলাসিসাত)',
'cancel' => 'বাতিল করেদে',
'cantrollback' => 'আগেকার সঙস্করনহাত আলথকে যানা নুৱারলু, লমিলগা সম্পদনাকরেকুরা অগ পাতা অহানর আকখুলা লেখকগ।',
'captcha-createaccount' => 'স্বয়ংক্রিয় স্প্যামর বিরুদ্ধে সুরক্ষার কা তরতা একাউন্ট খোলানির আগে তলর ছবিগর ভিতরর ৱাহিহানরে টাইপ করানি থকিতই: <br />([[Special:Captcha/help|এহান কিহান?]])',
'categories' => 'বিষয়রথাকহানি',
'categoriespagetext' => 'ইমারঠারর উইকিপিডিয়াত এবাকার বিষয়রথাক:',
'category_header' => '"$1" বিষয়রথাকে আসে নিবন্ধহানি',
'categoryarticlecount' => 'এরে বিষয়রথাকে $1হান নিবন্ধ আসে।',
'categorypage' => 'বিষয়থাকর পাতাহানি চা',
'categorytree-category' => 'বিষয়রথাক',
'changed' => 'পতেসে',
'changepassword' => 'খন্তাচাবি(password) পতা',
'changes' => 'পতানিহানি',
'cite' => 'উদ্ধৃত করেদে',
'cite_article_link' => 'নিবন্ধ এহানরে উদ্ধৃত করেদে',
'clearyourcache' => '\'\'\'খিয়াল থ:\'\'\' তর পছনহানি রক্ষা করানির থাঙনাত পতাহানি চানার কা তর ব্রাউজারর ক্যাশ লালুয়া যানা লাগতে পারে। \'\'\'মোজিলা/ফায়ারফক্স/সাফারি:\'\'\' শিফট কী চিপিয়া থয়া রিলোড-এ ক্লিক কর, নাইলে \'\'কন্ট্রোল-শিফট-R\'\'(এপল ম্যাক-এ \'\'কমান্ড-শিফট-R\'\') আকপাকে চিপা; \'\'\'ইন্টারনেট এক্সপ্লোরার:\'\'\' \'\'কন্ট্রোল\'\' চিপিয়া থয়া রিফ্রেশ-এ ক্লিক কর, নাইলে \'\'কন্ট্রোল-F5\'\' চিপা; \'\'\'কংকারার:\'\'\' হুদ্দা রিলোড ক্লিক করলে বা F5 চিপিলে চলতই; \'\'\'অপেরা\'\'\' আতাকুরাই \'\'Tools&rarr;Preferences\'\'-এ গিয়া কাশ সম্পূর্ণ ঙক্ষি করানি লাগতে পারে।',
'columns' => 'দুরগিঃ',
'compareselectedversions' => 'বাসাইল সংস্করণহানি তুলনা কর',
'confirm' => 'লেপকরানি',
'confirm_purge' => 'পাতা এহানর ক্যাশহান ঙক্ষি করানি মনারতা? 

$1',
'confirm_purge_button' => 'চুমিসে',
'confirmdelete' => 'পুসানিহান লেপকর',
'confirmedittext' => 'যেহানউ সম্পাদনা করানির আগে তর ই-মেইল ঠিকানাহন যেসাদেউ লেপকরানি লাগতই। কৃপাকরিয়া তর ই-মেইল ঠিকানাহান [[special:Preferences|আতাকুরার পছনতালিকা]]ত চুমকরে বরা।',
'confirmedittitle' => 'সম্পাদনা করানির কা ই-মেইল লেপকানি থকিতই',
'confirmemail' => 'ই-মেইল ঠিকানাহান লেপকর',
'confirmemail_invalid' => 'লেপকরেকুরা কোডগ চুম নাইসে। সম্ভবতঃ এগ পুরানা ইয়া পরসেগা।',
'confirmemail_loggedin' => 'তর ই-মেইল ঠিকানাহার লেপকরানিহান চুমিল।',
'confirmemail_send' => 'লেপকরেকুরা কোডগ দিয়াপেঠাদে',
'confirmemail_sendfailed' => 'লেপকরেকুরা ই-মেইলহান দিয়াপেঠাদে নুৱাররাং। ইমেইল ঠিকানাহান চুমকরে ইকরিসত্তানাকিতা আরাক আকমু খিয়াল করিয়া চা। আলথকে আহিলঃ $1',
'confirmemail_sent' => 'লেপকরেকুরা ই-মেইলহান দিয়াপেঠা দিলাং।',
'confirmemail_success' => 'তর ই-মেইল ঠিকানাহার লেপ্পাহান চুমিল। তি এবাকা হমানি(log in) পারর।',
'contribslink' => 'অবদান',
'currentevents' => 'হাদি এহানর ঘটনা',
'currentevents-url' => 'হাদি এহানর ঘটনাহানি',
'currentrev' => 'হাদিএহানর পতানি',
'currentrevisionlink' => 'হাদি এহানর পতানি',
'delete' => 'পুসানি',
'delete_and_move' => 'পুসানি বারো থেইকরানি',
'delete_and_move_confirm' => 'হায়, পাতা এহান পুস',
'deletethispage' => 'পাতা এহান পুসে বেলিক',
'diff' => 'ফারাক',
'edit' => 'পতানি',
'edithelp' => 'পতানি পাংলাক',
'edithelppage' => '{{ns:project}}:কিসাদে_পাতা_আহান_পতানি',
'editold' => 'পতিক',
'editsection' => 'পতিক',
'editthispage' => 'পাতা এহান পতিক',
'error' => 'লালুইসে',
'errorpagetitle' => 'লাল',
'faq'     => 'প্রশ্নরজুয়াপ',
'faqpage'   => '{{ns:project}}:প্রশ্নরজুয়াপ',
'go'    => 'হাত',
'help'      => 'পাংলাক',
'helppage'    => '{{ns:project}}:পাংলাক',
'hide' => 'আরুম',
'hidetoc' => 'মেথেল আরুম কর',
'hist' => 'ইতিহাসহান',
'histfirst' => 'হাব্বিত্ত পুরানা',
'histlast' => 'হাব্বিত্ত নুৱা',
'histlegend' => 'ফারাক (Diff) বাছানি: যে সংস্করণহানি তুলনা করানি চার, অহান লেপকরিয়া এন্টার বা তলর খুথামগত যাতা।<br />
নির্দেশিকা: (এব) = এবাকার সংস্করণহানর লগে ফারাক,(আ) =  জানে আগে-আগে গেলগা সংস্করণহানর লগে ফারাক, হ = হুরু-মুরু (নামাতলেউ একরব অসারে) সম্পাদনাহান।',
'history_short' => 'ইতিহাসহান',
'ilsubmit' => 'বিসারা',
'imagelinks' => 'জুরিসিতা',
'imagelist' => 'ছবির তালিকা',
'imagepage' =>  'ছবির পাতাহান চেইক',
'jumptonavigation' => 'দিশা ধরানি',
'lastmodifiedat'  => 'পাতা এহানর লমিলগা পতানিহান $2, $1.',
'mainpage'    => 'পয়লা পাতা',
'minoredit' => 'এহান হুরু-মুরু সম্পাদনাহানহে।',
'minoreditletter' => 'হ',
'move' => 'থেইকরানি',
'mycontris' => 'মর অবদান',
'mypage'    => 'মর পাতাহান',
'mytalk'    => 'মর য়্যারি-পরি',
'navigation' => 'দিশা-ধরুনী',
'nbytes'    => '$1 বাইট',
'newmessageslink' => 'নুৱা পৌ',
'newpage' => 'নুৱা পাতা',
'newpageletter' => 'নু',
'nstab-main' => 'নিবন্ধ',
'nstab-mediawiki' => 'পৌ',
'nstab-project' => 'প্রকল্প পাতা',
'nstab-special' => 'বিশেষ',
'nstab-user' => 'আতাকুরার পাতা',
'ok'      => 'চুমিসে',
'otherlanguages' => 'আরআর ঠারে',
'permalink' => 'আকুবালা মিলাপ',
'portal' => 'শিংলুপ',
'portal-url' => '{{ns:project}}:শিংলুপ',
'printableversion' => 'ছাপানি একরব সংস্করণ',
'projectpage' => 'প্রকল্পর পাতাহান',
'protectedinterface' => '[[Image:Padlock.svg|right|60px|]]পাতা এহানর মেথেল উইকি সফটওয়্যারর ইন্টারফেসর পৌহান দের, অহানে এহানরে ইতু করিয়া থনা অসে এবিউসেত্ত ঙাক্করানির কাজে।',
'protectthispage' => 'পাতা এহান ইতু করিক',
'qbedit' => 'পতানি',
'qbfind'    => 'বিসারিয়া চা',
'qbbrowse'    => 'বুলিয়া চা',
'qbpageoptions' => 'পাতা এহানর সারুক',
'qbpageinfo'  => 'পাতা এহানর পৌ',
'qbmyoptions' => 'মর পছন',
'qbspecialpages' => 'বিশেষ পাতাহানি',
'randompage' => 'খাংদা পাতা',
'recentchanges' => 'হাদিএহান পতাসিতা',
'recentchangeslinked' => 'সাকেই আসে পতা',
'redirectedfrom' => '($1 -ত্ত পাকদিয়া আহিল)',
'returnto'    => 'আলথকে যাগা $1.',
'retrievedfrom' => '\'$1\' -ত্ত আনানি অসে',
'restriction-edit' => 'পতানিহান_চিয়ৌকর',
'saturday' => 'থাংচা',
'savefile' => 'ফাইল ইতু',
'saveprefs' => 'ইতু',
'search'    => 'বিসারিয়া চা',
'searcharticle'    => 'হাত',
'searchbutton' => 'বিসারানি',
'showtoc' => 'ফংকর',
'sitesubtitle' => 'খুলাসা বিশ্বকোষ উইকিপিডিয়াত্ত',
'sitesupport' => 'দান দেনা',
'sitetitle' => 'উইকিপিডিয়া',
'specialloguserlabel' => 'আতাকুরাগ:',
'specialpage' => 'বিশেষ পাতাহান',
'specialpages' => 'বিশেষ পাতাহানি',
'tagline' => 'মুক্ত বিশ্বকোষ উইকিপিডিয়াত্ত',
'talk' => 'য়্যারী',
'talkpage' => 'পাতা এহান্ন য়্যারি দিক',
'toc' => 'মেথেল',
'toolbox' => 'আতিয়ার',
'unwatch' => 'তালাবি নেই',
'unwatchthispage' => 'তালাবি এরাদেনা',
'upload' => 'আপলোড ফাইল',
'uploadbtn' => 'আপলোড',
'unprotectthispage' => 'পাতা এহানর ইতু এরাদিক',
'userlogin' => 'হমানি / নৱা একাউন্ট খুলানি',
'userlogout' => 'নিকুলানি',
'userpage' => 'আতাকুরার পাতাহান চেইক',
'viewcount' => 'পাতা এহান $1 মাউ চানা ইল।',
'viewtalkpage' => 'য়্যারীর পাতাহান চেইক',
'watch' => 'তালাবি',
'watchlist' => 'মর তালাবি',
'watchthis' => 'পাতাএহান খিয়ালে থ',
'watchthispage' => 'পাতাএহান খিয়ালে থ',
'watchthisupload' => 'পাতাএহান খিয়ালে থ',
'whatlinkshere' => 'যে পাতাহানিত্ত এহানাত মিলাপ আসে',
'welcomecreation' => '== সম্ভাষা, $1! ==

তর একাউন্টহান মুকিল। তর {{SITENAME}} পছনহান পতানি না পাহুরিস।',
'yourdiff' => 'ফারাকহানি',
'yourdomainname' => 'তর ডোমেইনগ',
'youremail' => 'ই-মেইল *:',
'yourlanguage' => 'ঠারহান:',
'yourname' => 'আতাকুরার নাংহান (Username)',
'yournick' => 'দাহানির নাংহান:',
'yourpassword' => 'খন্তাচাবিগ (password)',
'yourpasswordagain' => 'খন্তাচাবিগ (password) আরাকমু ইকর',
'yourrealname' => 'আৱৈপা নাংহান *:',
'yourtext' => 'তর ইকরা বিষয়হানি',

);

?>

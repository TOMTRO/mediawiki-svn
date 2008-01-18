<?php
/**
 * Internationalisation file for extension ParserDiffTest.
 *
 * @addtogroup Extensions
*/

$messages = array();

$messages['en'] = array(
	'parserdifftest' => 'Parser diff test',
	'pdtest_no_target' => 'No target specified.',
	'pdtest_page_missing' => 'The specified page was not found in the database.',
	'pdtest_no_changes' => 'No changes detected.',
	'pdtest_time_report' => '<b>$1</b> took $2 seconds, <b>$3</b> took $4 seconds.',
	'pdtest_title' => 'Context title:',
	'pdtest_text' => 'Input text:',
	'pdtest_ok' => 'OK',
	'pdtest_get_text' => 'Get text from page',
	'pdtest_diff' => 'Differences',
	'pdtest_side_by_side' => 'Output comparison',
	'pdt_comparing_page' => 'Comparing parser output from [[$1]]',
);

/** Arabic (العربية)
 * @author Meno25
 */
$messages['ar'] = array(
	'parserdifftest'      => 'اختبار فرق البارسر',
	'pdtest_no_target'    => 'لا هدف تم تحديده.',
	'pdtest_page_missing' => 'الصفحة المحددة لم يتم العثور عليها في قاعدة البيانات.',
	'pdtest_no_changes'   => 'لا تغييرات تم تبينها.',
	'pdtest_time_report'  => '<b>$1</b> استغرق $2 ثانية، <b>$3</b> استغرق $4 ثانية.',
	'pdtest_title'        => 'عنوان السياق:',
	'pdtest_text'         => 'النص المدخل:',
	'pdtest_ok'           => 'موافق',
	'pdtest_get_text'     => 'الحصول على النص من الصفحة',
	'pdtest_diff'         => 'الفروقات',
	'pdtest_side_by_side' => 'مقارنة الناتج',
	'pdt_comparing_page'  => 'مقارنة ناتج البارسر من [[$1]]',
);

/** Czech (Česky)
 * @author Li-sung
 */
$messages['cs'] = array(
	'parserdifftest'      => 'Test rozdílu parserů',
	'pdtest_no_target'    => 'Není určen cíl.',
	'pdtest_page_missing' => 'Určená stránka nebyla v databázi nalezena.',
	'pdtest_no_changes'   => 'Neprojevily se žádné změny.',
	'pdtest_title'        => 'Název stránky kvůli kontextu:',
	'pdtest_text'         => 'Vstupní text:',
	'pdtest_get_text'     => 'Použít text ze stránky',
	'pdtest_diff'         => 'Rozdíly',
	'pdtest_side_by_side' => 'Porovnání výstupu',
	'pdt_comparing_page'  => 'Porovnání výstupu parserů pro stránku [[$1]]',
);

$messages['he'] = array(
	'parserdifftest' => 'בדיקת השינויים במפענח',
	'pdtest_no_target' => 'לא נבחר יעד.',
	'pdtest_page_missing' => 'הדף המבוקש לא נמצא במסד הנתונים.',
	'pdtest_no_changes' => 'לא נמצאו שינויים.',
	'pdtest_time_report' => '<b>$1</b> לקח $2 שניות, <b>$3</b> לקח $4 שניות.',
	'pdtest_title' => 'כותרת הדף:',
	'pdtest_text' => 'טקסט לבדיקה:',
	'pdtest_ok' => 'שליחה',
	'pdtest_get_text' => 'שימוש בטקסט מהדף',
	'pdtest_diff' => 'הבדלים',
	'pdtest_side_by_side' => 'השוואת הפלט',
	'pdt_comparing_page' => 'משווה את פלט המפענחים מהדף [[$1]]',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'pdtest_no_target'    => 'Žadyn cil podaty.',
	'pdtest_page_missing' => 'Podata strona njebu w datowej bance namakana.',
	'pdtest_no_changes'   => 'Žane změny wotkryte.',
	'pdtest_time_report'  => '<b>$1</b> traješe $2 {{PLURAL:$2|sekunda|sekundźe|sekundy|sekundow}}, <b>$3</b> traješe $4 {{PLURAL:$4|sekunda|sekundźe|sekundy|sekundow}}.',
	'pdtest_title'        => 'Titul konteksta:',
	'pdtest_text'         => 'Tekst zapodaća:',
	'pdtest_ok'           => 'W porjadku',
	'pdtest_get_text'     => 'Tekst ze strony wzać',
	'pdtest_diff'         => 'Rozdźěle',
	'pdtest_side_by_side' => 'Přirunanje wudaća',
	'pdt_comparing_page'  => 'Wudaće parsera z [[$1]] so přirunuje',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'parserdifftest'      => 'Parserverschillentest',
	'pdtest_no_target'    => 'Geen doel aangegeven.',
	'pdtest_page_missing' => 'De aangegeven pagina is niet aangetroffen in de database.',
	'pdtest_no_changes'   => 'Geen wijzigingen geconstateerd.',
	'pdtest_time_report'  => '<b>$1</b> duurde $2 seconden, <b>$3</b> duurde $4 seconden.',
	'pdtest_title'        => 'Contexttitel:',
	'pdtest_text'         => 'Invoertekst:',
	'pdtest_ok'           => 'OK',
	'pdtest_get_text'     => 'Tekst van pagina ophalen',
	'pdtest_diff'         => 'Verschillen',
	'pdtest_side_by_side' => 'Uitvoervergelijking',
	'pdt_comparing_page'  => 'Vergelijk van parseruitvoer van [[$1]]',
);

/** Occitan (Occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'pdtest_diff' => 'Diferéncias',
);

/** Russian (Русский)
 * @author .:Ajvol:.
 */
$messages['ru'] = array(
	'parserdifftest'      => 'Проверка изменений синтаксического анализатора',
	'pdtest_no_target'    => 'Не указана цель.',
	'pdtest_page_missing' => 'Указанная страница не найдена в базе данных.',
	'pdtest_no_changes'   => 'Изменений не обнаружено.',
	'pdtest_time_report'  => '<b>$1</b> заняло $2 секунд, <b>$3</b> заняло $4 секунд.',
	'pdtest_title'        => 'Название страницы:',
	'pdtest_text'         => 'Входной текст:',
	'pdtest_ok'           => 'OK',
	'pdtest_get_text'     => 'Получить текст со страницы',
	'pdtest_diff'         => 'Различия',
	'pdtest_side_by_side' => 'Сравнение вывода',
	'pdt_comparing_page'  => 'Сравнение вывода синтаксического анализатора для [[$1]]',
);

/** Slovak (Slovenčina)
 * @author Helix84
 */
$messages['sk'] = array(
	'parserdifftest'      => 'Test rozdielov syntaktického analyzátora',
	'pdtest_no_target'    => 'Nebol zadaný cieľ.',
	'pdtest_page_missing' => 'Zadaná stránka nebola nájdená v databáze.',
	'pdtest_no_changes'   => 'Neboli zistené žiadne zmeny.',
	'pdtest_time_report'  => '<b>$1</b> trval $2 sekúnd, <b>$3</b> trval $4 sekúnd.',
	'pdtest_title'        => 'Kontextový názov:',
	'pdtest_text'         => 'Vstupný text:',
	'pdtest_ok'           => 'OK',
	'pdtest_get_text'     => 'Získať text zo stránky',
	'pdtest_diff'         => 'Rozdiely',
	'pdtest_side_by_side' => 'Porovnanie výstupu',
	'pdt_comparing_page'  => 'Porovnáva sa výstup syntaktického analyzátora z [[$1]]',
);

/** Swedish (Svenska)
 * @author Lejonel
 */
$messages['sv'] = array(
	'parserdifftest'      => 'Parserskillnadstest',
	'pdtest_no_target'    => 'Ingen målsida angavs.',
	'pdtest_page_missing' => 'Den angivna sidan hittades inte i databasen.',
	'pdtest_no_changes'   => 'Inga ändringar hittades.',
	'pdtest_time_report'  => '<b>$1</b> tog $2 sekunder, <b>$3</b> tog $4 sekunder.',
	'pdtest_title'        => 'Sidtitel:',
	'pdtest_text'         => 'Text som ska parsas:',
	'pdtest_ok'           => 'Jämför',
	'pdtest_get_text'     => 'Hämta text från sida',
	'pdtest_diff'         => 'Skillnader',
	'pdtest_side_by_side' => 'Jämförelse av resultat',
	'pdt_comparing_page'  => 'Jämför parsningsresultat av [[$1]]',
);


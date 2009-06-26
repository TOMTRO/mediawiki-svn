<?php
/**
 * Internationalisation for Usability Initiative OptIn extension
 *
 * @file
 * @ingroup Extensions
 */

$messages = array();

/** English
 * @author Roan Kattouw
 */
$messages['en'] = array(
	'optin' => 'Usability Initiative opt in',
	'optin-desc' => 'Allow users to opt in to the Usability Initiative\'s usability enhancements',
	'optin-title' => 'Usability Intitiative enhancements',
	'optin-needlogin' => 'You need to [$1 log in] to opt in to the Usability Initiative\'s usability enhancements.',
	'optin-intro' => 'The Wikipedia Usability Initiative has developed a new skin and a new edit toolbar intended to enhance the usability of Wikipedia. These enhancements have not been enabled for all users yet, but you can opt in to them by clicking "{{int:optin-submit-in}}" below.',
	'optin-success-in' => 'You have successfully opted in to the Usability Initiative\'s usability enhancements.
You can opt back out at any time by clicking "{{int:optin-submit-out}}" below.',
	'optin-success-out' => 'You have successfully opted out of the Usability Initiative\'s usability enhancements.
You can opt back in at any time by clicking {{int:optin-submit-in}} below.',
	'optin-submit-in' => 'Opt in',
	'optin-submit-out' => 'Opt out',
	'optin-survey-intro' => "Thank you for trying the Usability Initiative's usability enhancements.
You can opt out by clicking \"{{int:optin-submit-out}}\" at the bottom of this page.

We would like to know what you think about our new interface, so we would appreciate it if you filled out the optional survey below before clicking \"{{int:optin-submit-out}}\".",
	'optin-survey-question-whyoptout' => 'Why are you opting out of this interface?',
	'optin-survey-answer-whyoptout-didntlike' => 'I do not like the design.',
	'optin-survey-answer-whyoptout-hard' => 'It was too hard to edit a page.',
	'optin-survey-answer-whyoptout-didntwork' => 'It did not function properly.',
	'optin-survey-answer-whyoptout-other' => 'Other reason:',
	'optin-survey-question-browser' => 'Which browser do you use?',
	'optin-survey-answer-browser-ie5' => 'Internet Explorer 5',
	'optin-survey-answer-browser-ie6' => 'Internet Explorer 6',
	'optin-survey-answer-browser-ie7' => 'Internet Explorer 7',
	'optin-survey-answer-browser-ie8' => 'Internet Explorer 8',
	'optin-survey-answer-browser-ff1' => 'Firefox 1',
	'optin-survey-answer-browser-ff2' => 'Firefox 2',
	'optin-survey-answer-browser-ff3' => 'Firefox 3',
	'optin-survey-answer-browser-cb' => 'Google Chrome Beta',
	'optin-survey-answer-browser-c1' => 'Google Chrome 1',
	'optin-survey-answer-browser-c2' => 'Google Chrome 2',
	'optin-survey-answer-browser-s3' => 'Safari 3',
	'optin-survey-answer-browser-s4' => 'Safari 4',
	'optin-survey-answer-browser-o9' => 'Opera 9',
	'optin-survey-answer-browser-o9.5' => 'Opera 9.5',
	'optin-survey-answer-browser-o10' => 'Opera 10',
	'optin-survey-answer-browser-other' => 'Other browser:',
	'optin-survey-question-os' => 'Which operating system do you use?',
	'optin-survey-answer-os-windows' => 'Windows',
	'optin-survey-answer-os-macos' => 'Mac OS',
	'optin-survey-answer-os-linux' => 'Linux',
	'optin-survey-answer-os-other' => 'Other:',
	'optin-survey-question-res' => 'What is the resolution of your screen?',
	'optin-survey-question-feedback' => 'Please let us know your feedback:',
);

/** Message documentation (Message documentation)
 * @author EugeneZelenko
 */
$messages['qqq'] = array(
	'optin-survey-answer-whyoptout-other' => '{{Identical|Other reason}}',
	'optin-survey-answer-os-other' => '{{Identical|Other}}',
);

/** Belarusian (Taraškievica orthography) (Беларуская (тарашкевіца))
 * @author EugeneZelenko
 * @author Jim-by
 */
$messages['be-tarask'] = array(
	'optin' => 'Удзел у Ініцыятыве па паляпшэньню зручнасьці і прастаты выкарыстаньня',
	'optin-desc' => 'Дазваляе ўдзельнікам далучыцца ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня',
	'optin-title' => 'Паляпшэньні ў рамках ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня',
	'optin-needlogin' => 'Вам неабходна [$1 увайсьці ў сыстэму] каб далучыцца да ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня.',
	'optin-intro' => 'У рамках ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня Вікіпэдыі былі распрацаваныя новае афармленьне і новая панэль інструмэнтаў рэдагаваньняў з намерам павышэньня зручнасьці і прастаты выкарыстаньня Вікіпэдыі. Гэтыя паляпшэньні яшчэ не ўключаныя для ўсіх удзельнікаў, яле Вы можаце пачаць выкарыстоўваць іх націснуўшы кнопку «{{int:optin-submit-in}}» ніжэй.',
	'optin-success-in' => 'Вы пасьпяхова далучыліся да паляпшэньняў зробленых у рамках ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня.
Вы можаце пакінуць адлучыцца ў любы час націснуўшы кнопку «{{int:optin-submit-out}}» ніжэй.',
	'optin-success-out' => 'Вы пасьпяхова адлучыліся ад праграмы паляпшэньняў ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня.
Вы можаце зноў далучыцца да яе націснуўшы кнопку «{{int:optin-submit-in}}» ніжэй.',
	'optin-submit-in' => 'Далучыцца',
	'optin-submit-out' => 'Адлучыцца',
	'optin-survey-intro' => 'Дзякуй за ўдзел у праграме паляпшэньняў ініцыятывы па паляпшэньню зручнасьці і прастаты выкарыстаньня.
Вы можаце адлучыцца ад гэтай праграмы ў любы час націснуўшы кнопку «{{int:optin-submit-out}}» у нізу  гэтай старонцы.

Мы жадаем ведаць, што Вы мяркуеце пра новы інтэрфэйс, з-за гэтага мы былі б удзячныя, калі б Вы прынялі ўдзел у неабавязковым апытаньні, перад тым як Вы націсьніце «{{int:optin-submit-out}}».',
	'optin-survey-question-whyoptout' => 'Чаму Вы вырашылі адключыць гэты інтэрфэйс?',
	'optin-survey-answer-whyoptout-didntlike' => 'Мне не падабаецца дызайн.',
	'optin-survey-answer-whyoptout-hard' => 'Занадта складана рэдагаваць старонкі.',
	'optin-survey-answer-whyoptout-didntwork' => 'Ён не працуе належным чынам.',
	'optin-survey-answer-whyoptout-other' => 'Іншая прычына:',
	'optin-survey-question-browser' => 'Якім браўзэрам Вы карыстаецеся?',
	'optin-survey-answer-browser-other' => 'Іншы браўзэр:',
	'optin-survey-question-os' => 'Якой апэрацыйнай сыстэмай Вы карыстаецеся?',
	'optin-survey-answer-os-other' => 'Іншая:',
	'optin-survey-question-res' => 'Якое разрозьненьне Вашага манітора?',
	'optin-survey-question-feedback' => 'Калі ласка, паведаміце нам Вашае меркаваньне:',
);

/** Bosnian (Bosanski)
 * @author CERminator
 */
$messages['bs'] = array(
	'optin-survey-answer-whyoptout-didntlike' => 'Ne sviđa mi se dizajn.',
	'optin-survey-answer-whyoptout-hard' => 'Isuviše je teško uređivati stranicu.',
	'optin-survey-answer-whyoptout-didntwork' => 'Nije pravilno funkcioniralo.',
	'optin-survey-answer-whyoptout-other' => 'Ostali preglednici:',
	'optin-survey-question-browser' => 'Koji preglednik koristite?',
	'optin-survey-answer-browser-other' => 'Ostali preglednici:',
	'optin-survey-answer-os-other' => 'Ostalo:',
);

/** Lower Sorbian (Dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'optin' => 'Iniciatiwa wužywajobnosći wubraśe',
	'optin-desc' => 'Zmóžnja wužywarjam pólěpšenja wužywajobnosći iniciatiwy wužywajobnosći wubraś',
	'optin-title' => 'Pólěpšenja iniciatiwy wužywajobnosći',
	'optin-needlogin' => 'Musyš se [$1 pśizjawiś], aby pólěpšenja wužywajobnosći iniciatiwy wužywajobnosći wubrał.',
	'optin-intro' => 'Iniciatiwa wužywajobnosći Wikipedije jo nowu suknju a nowu wobźěłowańsku kšomu wuwył, aby wužywajobnosć Wikipedije pólěpšyła. Toś te pólěpšenja hyšći njejsu za wšych wužywarjow zmóznjone, ale móžoš je pśez kliknjenje na "{{int:optin-submit-in}}" dołojce wubraś.',
	'optin-success-in' => 'Sy wuspěšnje pólěpšenja wužywajobnosći iniciatiwy wužywajobnosći wubrał.
Móžoš je kuždy cas pśez kliknjenje na "{{int:optin-submit-out}}" dołojce wótwóliś.',
	'optin-success-out' => 'Sy wuspěšnje pólěpšenja wužywajobnosći iniciatiwy wužywajobnosći wótwólił.
Móžoš je kuždy cas pśez kliknjenje na "{{int:optin-submit-in}}" dołojce wubraś.',
	'optin-submit-in' => 'Wubraś',
	'optin-submit-out' => 'Wótwóliś',
	'optin-survey-intro' => 'Źěkujomy se za wuproběrowanje pólěpšenjow wužywajobnosći iniciatiwy wužywajobnosći.
Móžoš je pśez kliknjenje na "{{int:optin-submit-out}}" dołojce na boku wótwóliś.

My by rady wěźeli, co mysliš wó našem nowem wužywarskem pówjerchu, togodla my by se wjaselili, jolic ty by wupołnił opcionalny napšašnik, nježli až kliknjoš na "{{int:optin-submit-out}}".',
	'optin-survey-question-whyoptout' => 'Cogodla wótwólujoš toś ten wužywarski pówjerch?',
	'optin-survey-answer-whyoptout-didntlike' => 'Design se mě njespódoba.',
	'optin-survey-answer-whyoptout-hard' => 'Wobźěłowanje boka jo pśeśěžko było.',
	'optin-survey-answer-whyoptout-didntwork' => 'Njejo pórědnje funkcioněrowało.',
	'optin-survey-answer-whyoptout-other' => 'Druga pśicyna:',
	'optin-survey-question-browser' => 'Kótary wobglědowak wužywaš?',
	'optin-survey-answer-browser-other' => 'Drugi wobglědowak:',
	'optin-survey-question-os' => 'Kótary źěłowy system wužywaš?',
	'optin-survey-answer-os-other' => 'Drugi:',
	'optin-survey-question-res' => 'Kótare jo rozeznaśe twójeje wobrazowki?',
	'optin-survey-question-feedback' => 'Pšosym daj nam swóje měnjenja k wěsći:',
);

/** Greek (Ελληνικά)
 * @author Crazymadlover
 */
$messages['el'] = array(
	'optin-survey-answer-browser-ie5' => 'Internet Explorer 5',
	'optin-survey-answer-browser-ie6' => 'Internet Explorer 6',
	'optin-survey-answer-browser-ie7' => 'Internet Explorer 7',
	'optin-survey-answer-browser-ie8' => 'Internet Explorer 8',
	'optin-survey-answer-browser-ff1' => 'Firefox 1',
	'optin-survey-answer-browser-ff2' => 'Firefox 2',
	'optin-survey-answer-browser-ff3' => 'Firefox 3',
	'optin-survey-answer-browser-c1' => 'Google Chrome 1',
	'optin-survey-answer-browser-c2' => 'Google Chrome 2',
	'optin-survey-answer-browser-s3' => 'Safari 3',
	'optin-survey-answer-browser-s4' => 'Safari 4',
	'optin-survey-answer-browser-o9' => 'Opera 9',
	'optin-survey-answer-browser-o9.5' => 'Opera 9.5',
	'optin-survey-answer-browser-o10' => 'Opera 10',
	'optin-survey-answer-os-windows' => 'Windows',
	'optin-survey-answer-os-macos' => 'Mac OS',
	'optin-survey-answer-os-linux' => 'Linux',
);

/** Esperanto (Esperanto)
 * @author Yekrats
 */
$messages['eo'] = array(
	'optin-survey-question-whyoptout' => 'Kial vi ne volas uzi ĉi tiun interfacon?',
	'optin-survey-answer-whyoptout-didntlike' => 'La apero ne plaĉas al mi.',
	'optin-survey-answer-whyoptout-hard' => 'Ĝi estis tro malfacila redakti paĝon.',
	'optin-survey-answer-whyoptout-didntwork' => 'Ĝi ne funkciis ĝuste.',
	'optin-survey-answer-whyoptout-other' => 'Alia kialo:',
	'optin-survey-question-browser' => 'Kiun retumilon vi uzas?',
	'optin-survey-answer-browser-other' => 'Alia retumilo:',
	'optin-survey-question-os' => 'Kiun operaciumon vi uzas?',
	'optin-survey-answer-os-other' => 'Alia:',
	'optin-survey-question-res' => 'Kio estas la distingivo de via ekrano?',
	'optin-survey-question-feedback' => 'Bonvolu diri al ni viajn rimarkojn:',
);

/** Finnish (Suomi)
 * @author Cimon Avaro
 * @author Str4nd
 */
$messages['fi'] = array(
	'optin' => 'Käytettävyyshankkeen valinnanvarainen käyttöönotto',
	'optin-desc' => 'Salli käyttäjien ottaa käyttöön käytettävyyshankkeen käytettävyyttä parantavat lisäykset',
	'optin-title' => 'Käytettävyyshankkeen parannukset',
	'optin-needlogin' => 'Sinun tulee [$1 kirjautua sisään] ottaaksesi käyttöön käytettävyyshankkeen käytettävyyttä lisäävät parannukset.',
	'optin-intro' => 'Wikipedian käytettävyyshanke on kehittänyt uuden ulkonäön ja uuden työkalupalkin muokkaukseen Wikipedian käytettävyyden parantamiseksi. Nämä parannukset eivät ole vielä kaikilla käyttäjillä, mutta voit ottaa ne käyttöön ”{{int:optin-submit-in}}” -painikkeesta.',
	'optin-success-in' => 'Olet ottanut onnistuneesti käyttöön käytettävyyshankkeen käytettävyyttä lisäävät parannukset.
Voit poistaa parannukset käytöstä milloin tahansa ”{{int:optin-submit-out}}” -painikkeesta.',
	'optin-success-out' => 'Olet onnistuneesti poistanut käytöstä käytettävyyshankkeen käytettävyyttä lisäävät parannukset.
Voit ottaa parannukset käyttöön milloin tahansa ”{{int:optin-submit-in}}” -painikkeesta.',
	'optin-submit-in' => 'Ota käyttöön',
	'optin-submit-out' => 'Poista käytöstä',
	'optin-survey-intro' => 'Kiitos käytettävyyshankkeen käytettävyyttä lisäävien parannusten kokeilusta.
Voit ottaa parannukset pois käytöstä ”{{int:optin-submit-out}}” -painikkeella tämän sivun lopusta.

Haluaisimme tietää mitä mieltä olet uudesta käyttöliittymästä, joten arvostaisimme jos täyttäisit vapaaehtoisen kyselyn ennen ”{{int:optin-submit-out}}” -painikkeen napsautusta.',
	'optin-survey-question-whyoptout' => 'Miksi kytket tämän käyttöliittymän pois käytöstä?',
	'optin-survey-answer-whyoptout-didntlike' => 'En pidä ulkoasusta.',
	'optin-survey-answer-whyoptout-hard' => 'Sivun muokkaus oli liian vaikeaa.',
	'optin-survey-answer-whyoptout-didntwork' => 'Se ei toiminut oikein.',
	'optin-survey-answer-whyoptout-other' => 'Muu syy',
	'optin-survey-question-browser' => 'Mitä selainta käytät?',
	'optin-survey-answer-browser-other' => 'Muu selain',
	'optin-survey-question-os' => 'Mitä käyttöjärjestelmää käytät?',
	'optin-survey-answer-os-other' => 'Muu',
	'optin-survey-question-res' => 'Mikä on näyttösi resoluutio?',
	'optin-survey-question-feedback' => 'Anna meille palautetta',
);

/** French (Français)
 * @author IAlex
 */
$messages['fr'] = array(
	'optin' => "Participer à l'initiative d'utilisabilité",
	'optin-desc' => "Permet aux utilisateurs de participer aux améliorations de l'initiative d'utilisabilité",
	'optin-title' => "Améliorations de l'initiative d'utilisabilité",
	'optin-needlogin' => "Vous devez vous [$1 connecter] pour participer aux améliorations de l'initiative d'utilisabilité.",
	'optin-intro' => "L'initiative d'utilisabilité de Wikipédia a développé un nouvel habillage et une nouvelle bare d'outils de modification pour améliorer l'utilisabilité de Wikipédia. Ces améliorations ne sont pas activées pour tous les utilisateurs, mais vous pouvez les utiliser en cliquant sur le bouton « {{int:optin-submit-in}} » ci-dessous.",
	'optin-success-in' => "Vous participez dès maintenant aux améliorations de l'initiative d'utilisabilité de Wikipédia.
Vous pouvez ne plus participer en cliquant sur « {{int:optin-submit-out}} » ci-dessous.",
	'optin-success-out' => "Vous participez plus aux améliorations de l'initiative d'utilisabilité de Wikipédia.
Vous pouvez de nouveau participer à tout moment en cliquant sur « {{int:optin-submit-in}} » ci-dessous.",
	'optin-submit-in' => 'Participer',
	'optin-submit-out' => 'Ne plus participer',
	'optin-survey-intro' => "Merci pour essayer les amélioration de l'initiative d'utilisabilité.
Vous pouvez ne plus participer en cliquant sur « {{int:optin-submit-out}} » ci-dessous.

Nous aimerions savoir ce que vous pensez de notre nouvelle interface, nous apprécierions si vous remplissiez le sondage optionnel avant de cliquer sur « {{int:optin-submit-out}} ».",
	'optin-survey-question-whyoptout' => 'Pourquoi ne voulez-vous plus participer à cette interface ?',
	'optin-survey-answer-whyoptout-didntlike' => "Je n'aime pas le design.",
	'optin-survey-answer-whyoptout-hard' => 'Il est trop difficile de modifier une page.',
	'optin-survey-answer-whyoptout-didntwork' => 'Ça ne fonctionne pas correctement.',
	'optin-survey-answer-whyoptout-other' => 'Autre raison :',
	'optin-survey-question-browser' => 'Quel navigateur utilisez-vous ?',
	'optin-survey-answer-browser-other' => 'Autre navigateur :',
	'optin-survey-question-os' => "Quel système d'exploitation utilisez-vous ?",
	'optin-survey-answer-os-other' => 'Autre :',
	'optin-survey-question-res' => 'Quelle est la résolution de votre écran ?',
	'optin-survey-question-feedback' => 'Donnez-nous votre réaction :',
);

/** Galician (Galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'optin' => 'Participar na Iniciativa de usabilidade',
	'optin-desc' => 'Permite que os usuarios participen nas melloras da Iniciativa de usabilidade',
	'optin-title' => 'Melloras da Iniciativa de usabilidade',
	'optin-needlogin' => 'Ten que [$1 acceder ao sistema] para participar nas melloras da Iniciativa de usabilidade.',
	'optin-intro' => 'A Iniciativa de usabilidade da Wikipedia desenvolveu unha nova apariencia e unha nova barra de ferramentas de edición destinadas a mellorar a usabilidade da Wikipedia. Estas melloras non foron habilitadas para todos os usuarios, pero pode optar por elas premendo no botón "{{int:optin-submit-in}}" que aparece a continuación.',
	'optin-success-in' => 'Optou por participar nas melloras da Iniciativa de usabilidade.
Pode saír en calquera momento facendo clic no botón "{{int:optin-submit-out}}" que aparecerá a continuación.',
	'optin-success-out' => 'Optou por non participar nas melloras da Iniciativa de usabilidade.
Pode participar en calquera momento facendo clic no botón "{{int:optin-submit-in}}" que aparecerá a continuación.',
	'optin-submit-in' => 'Participar',
	'optin-submit-out' => 'Non participar',
	'optin-survey-intro' => 'Grazas por probar as melloras da Iniciativa de usabilidade.
Pode optar por saír premendo no botón "{{int:optin-submit-out}}" que aparecerá na parte inferior desta páxina.

Gustaríanos saber o que pensa sobre a nosa nova interface, de forma que lle agradeceriamos que enchese a enquisa opcional de embaixo antes de premer en "{{int:optin-submit-out}}".',
	'optin-survey-question-whyoptout' => 'Por que estás a saír desta interface?',
	'optin-survey-answer-whyoptout-didntlike' => 'Non me gusta o deseño.',
	'optin-survey-answer-whyoptout-hard' => 'Foi moi difícil editar unha páxina.',
	'optin-survey-answer-whyoptout-didntwork' => 'Non funcionou correctamente.',
	'optin-survey-answer-whyoptout-other' => 'Outro motivo:',
	'optin-survey-question-browser' => 'Que navegador usa?',
	'optin-survey-answer-browser-other' => 'Outro navegador:',
	'optin-survey-question-os' => 'Que sistema operativo usa?',
	'optin-survey-answer-os-other' => 'Outros:',
	'optin-survey-question-res' => 'Cal é a resolución da súa pantalla?',
	'optin-survey-question-feedback' => 'Por favor, déixenos a súa opinión:',
);

/** Swiss German (Alemannisch)
 * @author Als-Holder
 */
$messages['gsw'] = array(
	'optin' => 'Benutzerfrejndligkeits-Initiative uuswehle',
	'optin-desc' => 'Benutzer erlaube d Verbesserige vu dr Benutzerfrejndligkeits-Initiative uuszwehle',
	'optin-title' => 'Verbesserige vu dr Benutzerfrejndligkeits-Initiative',
	'optin-needlogin' => 'Du muesch Di [$1 aamälde] go d Verbesserige vu dr Benutzerfrejndligkeits-Initiative uuswehle.',
	'optin-intro' => 'D Wikipedia-Benutzerfrejndligkeits-Initiative het e neji Benutzertoberflächi entwicklet un e neje Bearbeitigs-Wärchzygchaschte plant go d Benutzerfreindligkeit vu dr Wikipedia z verbessere. Die Verbesserige sin nonig fir alli Benutzer megli, aber Du chasch si uuswehle dur e Klick unte uf „{{int:optin-submit-in}}“.',
	'optin-success-in' => 'Du hesch erfolgrych d  Verbesserige vu dr Benutzerfrejndligkeits-Initiative uusgwehlt. Du chasch s wider ruckgängig mache dur e Klick unte uf „{{int:optin-submit-out}}“.',
	'optin-success-out' => 'Du hesch erfolgrych d  Verbesserige vu dr Benutzerfrejndligkeits-Initiative abgstellt. Du chasch s wider ruckgängig mache dur e Klick unte uf „{{int:optin-submit-in}}“.',
	'optin-submit-in' => 'Uuswehle',
	'optin-submit-out' => 'Abstelle',
	'optin-survey-intro' => 'Dankschen, ass Du d Verbesserige vu dr Benutzefrejndligkeits-Initiative uusprobiersch. 
Du chasch si wider abstelle dur e Klick uf „{{int:optin-submit-out}}“ unte uf däre Syte.

Mir wisste gärn, was Du iber di nej Benutzeroberflächi dänksch. Wäge däm deete mer is freie, wänn Du di frejwillig Umfrog deetsch uusfille, voreb Du uf „{{int:optin-submit-out}}“ klicksch.',
	'optin-survey-question-whyoptout' => 'Wurum wettsch du die Benutzeroberflächi wider abstelle?',
	'optin-survey-answer-whyoptout-didntlike' => 'Mir gfallt s Design nit.',
	'optin-survey-answer-whyoptout-hard' => 'S isch z schwirig gsi e Syte z bearbeite.',
	'optin-survey-answer-whyoptout-didntwork' => 'Si het nit rächt funktioniert.',
	'optin-survey-answer-whyoptout-other' => 'Andere Grund:',
	'optin-survey-question-browser' => 'Wele Browser bruchsch Du?',
	'optin-survey-answer-browser-other' => 'Àndere Browser:',
	'optin-survey-question-os' => 'Wel Betribssyschtem bruchsch Du?',
	'optin-survey-answer-os-other' => 'Anders:',
	'optin-survey-question-res' => 'Was fir e Uflesig het Dyy Bildschirm?',
	'optin-survey-question-feedback' => 'Gib is bitte e Ruckmäldig:',
);

/** Hebrew (עברית)
 * @author Rotem Liss
 */
$messages['he'] = array(
	'optin' => 'הרשמה ליוזמת השימושיות',
	'optin-desc' => 'אפשרות למשתמשים להירשם כדי לקבל את שיפורי השימושיות של יוזמת השימושיות',
	'optin-title' => 'השיפורים של יוזמת השימושיות',
	'optin-needlogin' => 'עליכם [$1 להיכנס לחשבון] כדי להירשם לקבלת שיפורי השימושיות של יוזמת השימושיות.',
	'optin-intro' => 'יוזמת השימושיות של ויקיפדיה פיתחה עיצוב חדש וסרגל עריכה חדש כדי לשפר את השימושיות של ויקיפדיה. שיפורים אלה טרם הופעלו לכל המשתמשים, אבל באפשרותכם להירשם אליהם באמצעות לחיצה על הכפתור "{{int:optin-submit-in}}" שלהלן.',
	'optin-success-in' => 'נרשמתם בהצלחה לקבלת שיפורי השימושיות של יוזמת השימושיות.
באפשרותכם לבטל את הרשמתכם בכל זמן באמצעות לחיצה על הכפתור "{{int:optin-submit-out}}" שלהלן.',
	'optin-success-out' => 'ביטלתם בהצלחה את הרשמתכם לקבלת שיפורי השימושיות של יוזמת השימושיות.
באפשרותכם להירשם שוב בכל זמן באמצעות לחיצה על הכפתור "{{int:optin-submit-out}}" שלהלן.',
	'optin-submit-in' => 'הרשמה',
	'optin-submit-out' => 'ביטול הרשמה',
	'optin-survey-intro' => 'תודה לכם על שאתם מנסים את שיפורי השימושיות של יוזמת השימושיות.
באפשרותכם לבטל את הרשמתכם באמצעות לחיצה על הכפתור "{{int:optin-submit-out}}" בתחתית הדף.

נרצה לדעת מה אתם חושבים על הממשק החדש, לכן נעריך זאת אם תמלאו את הסקר האופציונלי שלהלן לפני לחיצה על הכפתור "{{int:optin-submit-out}}".',
	'optin-survey-question-whyoptout' => 'למה אתם מבטלים את הרשמתכם לממשק זה?',
	'optin-survey-answer-whyoptout-didntlike' => 'הממשק לא מצא חן בעיני.',
	'optin-survey-answer-whyoptout-hard' => 'היה קשה מדי לערוך דף.',
	'optin-survey-answer-whyoptout-didntwork' => 'הוא לא פעל כפי שצריך.',
	'optin-survey-answer-whyoptout-other' => 'סיבה אחרת:',
	'optin-survey-question-browser' => 'באיזה דפדפן אתם משתמשים?',
	'optin-survey-answer-browser-other' => 'דפדפן אחר:',
	'optin-survey-question-os' => 'באיזו מערכת הפעלה אתם משתמשים?',
	'optin-survey-answer-os-other' => 'אחרת:',
	'optin-survey-question-res' => 'מהי רזולוציית המסך שלכם?',
	'optin-survey-question-feedback' => 'אנא העבירו לנו משוב:',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'optin' => 'Iniciatiwa wužiwajomnosće wuzwolenje',
	'optin-desc' => 'Zmóžnja wužiwarjam polěpšenja wužiwajomnosće iniciatiwy wužiwajomnosće wuzwolić',
	'optin-title' => 'Polěpšenja iniciatiwy wužiwajomnosće',
	'optin-needlogin' => 'Dyrbiš so [$1 přizjewić], zo by polěpšenja wužiwajomnosće iniciatiwy wužiwajomnosće wubrał.',
	'optin-intro' => 'Iniciatiwa wužiwajomnosće Wikipedije je nowy šat a nowu wobdźěłowansku gratowu lajstu wuwiła, kotrejž stej za to myslenej, wužiwajomnosć Wikipedije polěpšić. Tute polěpšenja hišće za wšěch wužiwarjow zmóžnjene njejsu, ale móžeš je přez kliknjenje na "{{int:optin-submit-in}}" deleka wuzwolić.',
	'optin-success-in' => 'Sy wuspěšnje polěpšenja wužiwajomnosće iniciatiwy wužiwajomnosće wuzwolił. Móžeš je kóždy čas přez kliknjenje na "{{int:optin-submit-out}}" deleka wotwolić.',
	'optin-success-out' => 'Sy wuspěšnje polěpšenja wužiwajomnosće iniciatiwy wužiwajomnosće wotwolił. Móžeš je kóždy čas přez kliknjenje na "{{int:optin-submit-in}}" deleka wuzwolić.',
	'optin-submit-in' => 'Wuzwolić',
	'optin-submit-out' => 'Wotwolić',
	'optin-survey-intro' => 'Dźakujemy so za wuprobowanje polěpšenjow wužiwajomnosće iniciatiwy wužiwajomnosće. Móžeš je přez kliknjenje na "{{int:optin-submit-out}}" deleka na stronje wotwolić.

Bychmy rady wědźeli, što mysliš wo našim nowym wužiwarskim powjerchu, bychmy so wjeselili, jeli by opcionelny naprašnik deleka wupjelnił, prjedy hač kliknješ na  "{{int:optin-submit-out}}".',
	'optin-survey-question-whyoptout' => 'Čehodla wuzwoluješ tutón powjerch?',
	'optin-survey-answer-whyoptout-didntlike' => 'Design so mi njespodoba.',
	'optin-survey-answer-whyoptout-hard' => 'Wobdźěłowanje strony je přećežko było.',
	'optin-survey-answer-whyoptout-didntwork' => 'To njeje porjadnje fungowało.',
	'optin-survey-answer-whyoptout-other' => 'Druha přičina:',
	'optin-survey-question-browser' => 'Kotry wobhladowak wužiwaš?',
	'optin-survey-answer-browser-other' => 'Druhi wobhladowak:',
	'optin-survey-question-os' => 'Kotry dźěłowy system wužiwaš?',
	'optin-survey-answer-os-other' => 'Druhi:',
	'optin-survey-question-res' => 'Kotre je rozeznaće twojeje wobrazowki?',
	'optin-survey-question-feedback' => 'Zdźěl nam prošu swoje měnjenja:',
);

/** Interlingua (Interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'optin' => 'Participar in le Initiativa de Usabilitate',
	'optin-desc' => 'Permitter al usatores de participar in le meliorationes del Initiativa de Usabilitate',
	'optin-title' => 'Meliorationes sub le Initiativa de Usabilitate',
	'optin-needlogin' => 'Tu debe [$1 aperir un session] pro activar le meliorationes del Initiativa de Usabilitate.',
	'optin-intro' => 'Le Initiativa de Usabilitate de Wikipedia ha disveloppate un nove apparentia graphic e un nove instrumentario de modification concipite pro augmentar le usabilitate de Wikipedia. Iste meliorationes non ha ancora essite activate pro tote le usatores, ma tu pote optar pro activar los per cliccar "{{int:optin-submit-in}}" hic infra.',
	'optin-success-in' => 'Tu ha con successo optate pro activar le meliorationes del Initiativa de Usabilitate.
Tu pote disactivar los a omne tempore con le button "{{int:optin-submit-out}}" hic infra.',
	'optin-success-out' => 'Tu ha con successo disactivate le meliorationes del Initiativa de Usabilitate.
Tu pote reactivar los a omne tempore con le button "{{int:optin-submit-in}}" hic infra.',
	'optin-submit-in' => 'Activar',
	'optin-submit-out' => 'Disactivar',
	'optin-survey-intro' => 'Gratias pro essayar le meliorationes del Initiativa de Usabilitate.
Tu pote disactivar los con le button "{{int:optin-submit-out}}" al fundo de iste pagina.

Nos volerea saper lo que tu pensa super nostre nove interfacie, e nos appreciarea si tu completa le sequente questionario optional ante de cliccar super "{{int:optin-submit-out}}".',
	'optin-survey-question-whyoptout' => 'Proque prefere tu disactivar iste interfacie?',
	'optin-survey-answer-whyoptout-didntlike' => 'Le apparentia graphic non me place.',
	'optin-survey-answer-whyoptout-hard' => 'Esseva troppo difficile modificar un pagina.',
	'optin-survey-answer-whyoptout-didntwork' => 'Non functionava correctemente.',
	'optin-survey-answer-whyoptout-other' => 'Altere motivo:',
	'optin-survey-question-browser' => 'Qual navigator usa tu?',
	'optin-survey-answer-browser-other' => 'Altere navigator:',
	'optin-survey-question-os' => 'Qual systema de operation usa tu?',
	'optin-survey-answer-os-other' => 'Altere:',
	'optin-survey-question-res' => 'Qual es le resolution de tu schermo?',
	'optin-survey-question-feedback' => 'Da nos tu reaction:',
);

/** Indonesian (Bahasa Indonesia)
 * @author Bennylin
 * @author Rex
 */
$messages['id'] = array(
	'optin' => 'Bergabung dengan Proyek Inisiatif Kebergunaan',
	'optin-desc' => 'Memungkinkan pengguna untuk bergabung dengan peningkatan kebergunaan dalam Proyek Inisiatif Kebergunaan',
	'optin-title' => 'Proyek Inisiatif Kebergunaan',
	'optin-needlogin' => 'Anda harus [$1 masuk log] untuk dapat bergabung dengan peningkatan kebergunaan dari Proyek Inisiatif Kebergunaan.',
	'optin-intro' => 'Proyek Inisiatif Kebergunaan Wikipedia telah mengembangkan sebuah skin baru dan batang alat penyuntingan baru yang ditujukan untuk meningkatkan kebergunaan Wikipedia. Peningkatan ini belum diaktifkan untuk semua pengguna, tapi Anda dapat bergabung dengan Proyek ini dengan mengklik "{{int:optin-submit-in}}" di bawah ini.',
	'optin-success-in' => 'Anda telah berhasil bergabung dengan peningkatan kebergunaan dari Proyek Inisiatif Kebergunaan.
Anda dapat keluar kapan saja dengan mengklik "{{int:optin-submit-out}}" di bawah ini.',
	'optin-success-out' => 'Anda telah berhasil keluar dari Proyek Inisiatif Kebergunaan.
Anda dapat bergabung kembali kapan saja dengan mengklik "{{int:optin-submit-in}}" di bawah ini.',
	'optin-submit-in' => 'Bergabung',
	'optin-submit-out' => 'Keluar',
	'optin-survey-intro' => 'Terima kasih untuk menguji coba peningkatan kebergunaan dari Proyek Inisiatif Kebergunaan.
Anda dapat keluar dengan mengklik "{{int:optin-submit-out}}" pada bagian bawah halaman ini.

Kami ingin mengetahui bagaimana pendapat Anda mengenai antarmuka baru kami, karenanya kami akan sangat menghargai jika Anda mengisi survei opsional berikut sebelum mengklik "{{int:optin-submit-out}}".',
	'optin-survey-question-whyoptout' => 'Mengapa Anda keluar dari antarmuka ini?',
	'optin-survey-answer-whyoptout-didntlike' => 'Saya tidak menyukai desainnya.',
	'optin-survey-answer-whyoptout-hard' => 'Terlalu sulit untuk menyunting halaman.',
	'optin-survey-answer-whyoptout-didntwork' => 'Tidak berfungsi dengan baik.',
	'optin-survey-answer-whyoptout-other' => 'Alasan lain:',
	'optin-survey-question-browser' => 'Penjelajah web apa yang Anda gunakan?',
	'optin-survey-answer-browser-other' => 'Penjelajah web lainnya:',
	'optin-survey-question-os' => 'Sistem operasi apa yang Anda gunakan?',
	'optin-survey-answer-os-other' => 'Lain-lain:',
	'optin-survey-question-res' => 'Berapa besar resolusi layar Anda?',
	'optin-survey-question-feedback' => 'Beritahukan kami tanggapan Anda:',
);

/** Japanese (日本語)
 * @author Aotake
 * @author Fryed-peach
 * @author 青子守歌
 */
$messages['ja'] = array(
	'optin' => 'ユーザビリティー改善への参加',
	'optin-desc' => 'Usability Initiative を使って利用者参加型のユーザビリティー改善を行う',
	'optin-title' => 'Usability Intitiative による改善',
	'optin-needlogin' => 'Usability Intitiative によるユーザビリティー改善に参加するには[$1 ログイン]している必要があります。',
	'optin-intro' => 'Wikipedia Usability Initiative は、ウィキペディアのユーザビリティーを改善させるための新しいスキンと編集ツールバーを開発しました。これらの改善はまだ全ての利用者に対して有効化されてはいませんが、以下の「{{int:optin-submit-in}}」をクリックすると個別に有効化できます。',
	'optin-success-in' => 'Usability Initiative のユーザビリティー改善への参加に成功しました。
以下の「{{int:optin-submit-out}}」をクリックすると、いつでも参加を取りやめることができます。',
	'optin-success-out' => 'Usability Initiative のユーザビリティー改善への参加取りやめに成功しました。
以下の「{{int:optin-submit-in}}」をクリックすると、いつでも参加しなおすことができます。',
	'optin-submit-in' => '加わる',
	'optin-submit-out' => '離れる',
	'optin-survey-intro' => 'Usability Initiative のユーザビリティー改善をお試しいただきありがとうございます。このページ末尾の「{{int:optin-submit-out}}」をクリックすることで参加を取りやめることができます。

よろしければこの新しいインタフェースについてご意見をお聞かせください。「{{int:optin-submit-out}}」をクリックする前に以下の任意調査にご協力いただければ幸いです。',
	'optin-survey-question-whyoptout' => 'なぜこのインターフェースから離れるのですか？',
	'optin-survey-answer-whyoptout-didntlike' => 'そのデザインが好きではありません。',
	'optin-survey-answer-whyoptout-hard' => 'ページを編集するのが困難です。',
	'optin-survey-answer-whyoptout-didntwork' => 'それは正常に機能しませんでした。',
	'optin-survey-answer-whyoptout-other' => 'その他の理由:',
	'optin-survey-question-browser' => '利用しているブラウザはどれですか？',
	'optin-survey-answer-browser-other' => 'その他のブラウザ:',
	'optin-survey-question-os' => '利用しているOSはどれですか？',
	'optin-survey-answer-os-other' => 'その他:',
	'optin-survey-question-res' => '画面の解像度はいくつですか？',
	'optin-survey-question-feedback' => 'フィードバックをお願いします:',
);

/** Ripoarisch (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'optin' => 'Op de <i lang="en">Usability Initiative</i> ier Verschöönerunge jon.',
	'optin-desc' => 'Määt et müjjelesch för de Metmaacher, sesch för de <i lang="en">Usability Initiative</i> ier Verschöönerunge ze entscheide.',
	'optin-title' => 'De <i lang="en">Usability Initiative</i> ier Verschöönerunge',
	'optin-needlogin' => 'Do mööts alld [$1 enjelogg senn], öm de <i lang="en">Usability Initiative</i> ier Verschöönerunge vun de Ovverflääsch för Desch enschallde ze künne.',
	'optin-intro' => 'De <i lang="en">Usability Initiative</i> vun de Wikipedia hät en neu Ovverflääsch entweckeld un en neu Reih met Werkzüch dohzoh, öm de Wikipedia besser zom Bedeene ze maache för de Metmaacher. Dä ier Verschöönerunge sin noch nit för alle Metmaacher aanjeschalldt woode, ävver Do kanns se för Desch ald enschallde, endämm dat De onge op „{{int:optin-submit-in}}“ klecks.',
	'optin-success-in' => 'Do häß för Desch enjeschalldt, dat De de <i lang="en">Usability Initiative</i> ier Verschöönerunge hann wells.
Do kanns doh emmer wider eruß kumme, endämm dat De onge op „{{int:optin-submit-out}}“ klecks.',
	'optin-success-out' => 'Do häß de <i lang="en">Usability Initiative</i> ier Verschöönerunge verlohße.
Do kanns emmer wider zerök kumme, endämm dat De onge op „{{int:optin-submit-in}}“ klecks.',
	'optin-submit-in' => 'Erenn jonn',
	'optin-submit-out' => 'Eruß jonn',
	'optin-survey-intro' => 'Mer bedangke uns doför, dat De de <i lang="en">Usability Initiative</i> ier Verschönerunge ußprobeere deihß. Do kann domet widder ophüüre, endämm dat De op „{{int:optin-submit-out}}“ aam ongere Engk vun he dä Sigg klecks.

Mer dääte jähn weße wat De övver uns neu Ovverflääsch meins. Dröm dääte mer uns freue, wann de unge op e paa kleine Froore antwoote dääts, ih dat de op „{{int:optin-submit-out}}“ klecks.',
	'optin-survey-question-whyoptout' => 'Woröm deihß de hee di Ovverflääsch nit (mieh) bruche?',
	'optin-survey-answer-whyoptout-didntlike' => 'Wi et ußsooch jefeel mer nit.',
	'optin-survey-answer-whyoptout-hard' => 'Et woh mer ze schwiiresch, en Sigg ze ändere.',
	'optin-survey-answer-whyoptout-didntwork' => 'Et hät nit öhndlesch jeflup, wi et sullt.',
	'optin-survey-answer-whyoptout-other' => 'Ene andere Jrond:',
	'optin-survey-question-browser' => 'Wat för ene Brauser bes De am bruche?',
	'optin-survey-answer-browser-ie5' => 'De Version 5 vum <i lang="en">Internet Explorer</i>',
	'optin-survey-answer-browser-ie6' => 'De Version 6 vum <i lang="en">Internet Explorer</i>',
	'optin-survey-answer-browser-ie7' => 'De Version 7 vum <i lang="en">Internet Explorer</i>',
	'optin-survey-answer-browser-ie8' => 'De Version 8 vum <i lang="en">Internet Explorer</i>',
	'optin-survey-answer-browser-ff1' => 'De Version 1 vum <i lang="en">Firefox</i>',
	'optin-survey-answer-browser-ff2' => 'De Version 2 vum <i lang="en">Firefox</i>',
	'optin-survey-answer-browser-ff3' => 'De Version 3 vum <i lang="en">Firefox</i>',
	'optin-survey-answer-browser-cb' => 'De Betta-Version vum <i lang="en">Google Chrome</i>',
	'optin-survey-answer-browser-c1' => 'De Version 1 vum <i lang="en">Google Chrome</i>',
	'optin-survey-answer-browser-c2' => 'De Version 2 vum <i lang="en">Google Chrome</i>',
	'optin-survey-answer-browser-s3' => 'De Version 3 vum <i lang="en">Safari</i>',
	'optin-survey-answer-browser-s4' => 'De Version 4 vum <i lang="en">Safari</i>',
	'optin-survey-answer-browser-o9' => 'De Version 9 vum <i lang="en">Opera</i>',
	'optin-survey-answer-browser-o9.5' => 'De Version 9.5 vum <i lang="en">Opera</i>',
	'optin-survey-answer-browser-o10' => 'De Version 10 vum <i lang="en">Opera</i>',
	'optin-survey-answer-browser-other' => 'ene andere Brauser:',
	'optin-survey-question-os' => 'Wat förr en Zoot Bedriifß_Süßteem beß De aam bruche?',
	'optin-survey-answer-os-windows' => '<i lang="en">Windows</i>',
	'optin-survey-answer-os-macos' => '<i lang="en">Mac OS</i>',
	'optin-survey-answer-os-linux' => '<i lang="en">Linux</i>',
	'optin-survey-answer-os-other' => 'En ander Zoot:',
	'optin-survey-question-res' => 'Wie es Dingem Beldscherrem sing Oplüüsung?',
	'optin-survey-question-feedback' => 'Beß esu joot un loß uns Ding Röckmeldunge han:',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'optin' => 'Benotzerfrëndlechkeets-Initiative matmaachen',
	'optin-desc' => "Erlaabt et de Benotzer fir d'Verbesserunge vun der Benotzerfrëndlechkeets-Initiative ze benotzen",
	'optin-title' => "Verbesserungen duerch d'Benotzerfrëndlechkeets-Initiative",
	'optin-submit-in' => 'Matmaachen',
	'optin-submit-out' => 'Net méi matmaachen',
	'optin-survey-question-whyoptout' => 'Firwat wëllt Dir dësen Interface net méi benotzen?',
	'optin-survey-answer-whyoptout-didntlike' => 'Ech hunn deen Design net gären.',
	'optin-survey-answer-whyoptout-hard' => "Et war ze komplizéiert fir eng Säit z'änneren.",
	'optin-survey-answer-whyoptout-didntwork' => 'Et huet net richteg fonctionnéiert.',
	'optin-survey-answer-whyoptout-other' => 'Anere Grond:',
	'optin-survey-question-browser' => 'Watfir e Browser benotzt Dir?',
	'optin-survey-answer-browser-other' => 'Anere Browser:',
	'optin-survey-question-os' => 'Wafir e Betriibssystem benotzt Dir?',
	'optin-survey-answer-os-other' => 'Aneren:',
	'optin-survey-question-res' => "Wéi ass d'Opléisung vun ärem Ecran?",
	'optin-survey-question-feedback' => 'Sot eis w.e.g. Är Meenung:',
);

/** Nedersaksisch (Nedersaksisch)
 * @author Servien
 */
$messages['nds-nl'] = array(
	'optin-survey-answer-whyoptout-other' => 'Aandere rejen:',
	'optin-survey-answer-os-other' => 'Aanders:',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'optin' => 'Opt-in bruikbaarheidsinitiatief',
	'optin-desc' => 'Maakt het mogelijk voor gebruikers om de verbeteringen van het Bruikbaarheidsinitiatief in te schakelen via opt-in',
	'optin-title' => 'Verbeteringen Bruikbaarheidsinitiatief',
	'optin-needlogin' => 'U moet [$1 aanmelden] voordat u de verbeteringen van het Bruikbaarheidsinitiatief kunt inschakelen.',
	'optin-intro' => 'Het Wikipedia Bruikbaarheidsinitiatief heeft een nieuwe vormgeving en nieuwe bewerkingshulpmiddelen ontwikkeld om de bruikbaarheid van Wikipedia te verbeteren.
Deze verbeteringen zijn nog niet voor alle gebruikers ingeschakeld, maar u kunt deze inschakelen door hieronder op "{{int:optin-submit-in}}" te klikken.',
	'optin-success-in' => 'U hebt aangegeven de verbeteringen van het Bruikbaarheidsinitiatief te willen gebruiken.
U kunt deze instellingen op elk gewenst moment weer verwijderen door hieronder op "{{int:optin-submit-out}}" te klikken.',
	'optin-success-out' => 'U hebt de instellingen van het Bruikbaarheidsinitiatief uitgeschakeld.
U kunt deze op elk gewenst moment weer inschakelen door hieronder op de knop {{int:optin-submit-in}} te klikken.',
	'optin-submit-in' => 'Inschakelen',
	'optin-submit-out' => 'Uitschakelen',
	'optin-survey-intro' => 'Dank u wel voor het uitproberen van de verbeteringen van het Bruikbaarheidsinitiatief.
U kunt alle functionaliteit weer uitschakelen door te klikken op de knop "{{int:optin-submit-out}}" onderaan deze pagina.
We willen graag weten wat u vindt van deze nieuwe interface, dus wilt u alstublieft de korte vragenlijst invullen voordat u op "{{int:optin-submit-out}}" klikt?',
	'optin-survey-question-whyoptout' => 'Waarom wilt u deze interface weer uitschakelen?',
	'optin-survey-answer-whyoptout-didntlike' => 'Het ontwerp staat me niet aan.',
	'optin-survey-answer-whyoptout-hard' => 'Een pagina bewerken was te moeilijk.',
	'optin-survey-answer-whyoptout-didntwork' => 'De wijzigingen functioneerden niet correct.',
	'optin-survey-answer-whyoptout-other' => 'Andere reden:',
	'optin-survey-question-browser' => 'Welke browser gebruikt u?',
	'optin-survey-answer-browser-other' => 'Andere browser:',
	'optin-survey-question-os' => 'Welk besturingssysteem gebruikt u?',
	'optin-survey-answer-os-other' => 'Ander:',
	'optin-survey-question-res' => 'Wat is uw beeldschermresolutie?',
	'optin-survey-question-feedback' => 'Laat ons alstublieft weten wat u vindt:',
);

/** Norwegian Nynorsk (‪Norsk (nynorsk)‬)
 * @author Gunnernett
 * @author Harald Khan
 */
$messages['nn'] = array(
	'optin-needlogin' => 'Du må [$1 logga inn] for å ta i bruk "Usability Initiative" sine utvidingar.',
	'optin-survey-question-whyoptout' => 'Kvifor vel du å ikkje nytta dette oppsettet?',
	'optin-survey-answer-whyoptout-didntlike' => 'Eg likar ikkje oppsettet.',
	'optin-survey-answer-whyoptout-hard' => 'Det var for vanskeleg å redigera ei side.',
	'optin-survey-answer-whyoptout-didntwork' => 'Det fungerte ikkje på rett vis.',
	'optin-survey-answer-whyoptout-other' => 'Anna årsak:',
	'optin-survey-question-browser' => 'Kva for ein nettlesar nyttar du?',
	'optin-survey-answer-browser-other' => 'Annan nettlesar:',
	'optin-survey-question-os' => 'Kva for operativsystem nyttar du?',
	'optin-survey-answer-os-other' => 'Anna:',
	'optin-survey-question-res' => 'Kva er oppløysinga på skjermen din?',
	'optin-survey-question-feedback' => 'Ver venleg og send ei tilbakemelding:',
);

/** Norwegian (bokmål)‬ (‪Norsk (bokmål)‬)
 * @author Nghtwlkr
 */
$messages['no'] = array(
	'optin-survey-answer-whyoptout-didntlike' => 'Jeg liker ikke designet.',
	'optin-survey-answer-whyoptout-hard' => 'Det var for vanskelig å redigere en side.',
	'optin-survey-answer-whyoptout-didntwork' => 'Den virket ikke ordentlig.',
	'optin-survey-answer-whyoptout-other' => 'Annen årsak:',
	'optin-survey-question-browser' => 'Hvilken nettleser bruker du?',
	'optin-survey-answer-browser-other' => 'Annen nettleser:',
	'optin-survey-question-os' => 'Hvilket operativsystem bruker du?',
	'optin-survey-answer-os-other' => 'Annet:',
	'optin-survey-question-res' => 'Hva er skjermoppløsningen din?',
	'optin-survey-question-feedback' => 'Vennligst gi oss dine tilbakemeldinger:',
);

/** Occitan (Occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'optin' => "Participar a l'iniciativa d'utilizabilitat",
	'optin-desc' => "Permet als utilizaires de participar als melhoraments de l'iniciativa d'utilizabilitat",
	'optin-title' => "Melhoraments de l'iniciativa d'utilizabilitat",
	'optin-needlogin' => "Vos cal vos [$1 connectar] per participar als melhoraments de l'iniciativa d'utilizabilitat.",
	'optin-intro' => "L'iniciativa d'utilizabilitat de Wikipèdia a desvolopat un abilhatge novèl e una barra d'espleches de modificacion novèla per melhorar l'utilizabilitat de Wikipèdia. Aqueles melhoraments son pas activats per totes los utilizaires, mas los podètz utilizar en clicant sul boton « {{int:optin-submit-in}} » çaijós.",
	'optin-success-in' => "Participatz tre ara als melhoraments de l'iniciativa d'utilizabilitat de Wikipèdia.
Podètz participar pas mai en clicant sus « {{int:optin-submit-out}} » çaijós.",
	'optin-success-out' => "Participatz pas mai als melhoraments de l'iniciativa d'utilizabilitat de Wikipèdia.
Podètz participar tornamai a tot moment en clicant sus « {{int:optin-submit-in}} » çaijós.",
	'optin-submit-in' => 'Participar',
	'optin-submit-out' => 'Participar pas mai',
	'optin-survey-intro' => "Mercés per ensajar los melhoraments de l'iniciativa d'utilizabilitat.
Podètz participar pas mai en clicant sus « {{int:optin-submit-out}} » çaijós.

Nos agradariá de saber çò que pensatz de nòstra interfàcia novèla, nos agradariá se emplenèssetz l'escandalhatge opcional abans de clicar sus « {{int:optin-submit-out}} ».",
	'optin-survey-question-whyoptout' => 'Perqué volètz pas mai participar a aquesta interfàcia ?',
	'optin-survey-answer-whyoptout-didntlike' => "M'agrada pas lo design.",
	'optin-survey-answer-whyoptout-hard' => 'Es tròp complicat de modificar una pagina.',
	'optin-survey-answer-whyoptout-didntwork' => 'Aquò fonciona pas corrèctament.',
	'optin-survey-answer-whyoptout-other' => 'Autra rason :',
	'optin-survey-question-browser' => 'Quin navigador utilizatz ?',
	'optin-survey-answer-browser-other' => 'Autre navigador :',
	'optin-survey-question-os' => 'Quin sistèma operatiu utilizatz ?',
	'optin-survey-answer-os-other' => 'Autre :',
	'optin-survey-question-res' => 'Quina es la resolucion de vòstre ecran ?',
	'optin-survey-question-feedback' => 'Balhatz-nos vòstra reaccion :',
);

/** Polish (Polski)
 * @author Sp5uhe
 */
$messages['pl'] = array(
	'optin-survey-answer-whyoptout-didntlike' => 'Nie podoba mi się wygląd strony.',
	'optin-survey-answer-whyoptout-other' => 'Inny powód',
	'optin-survey-question-browser' => 'Z jakiej korzystasz przeglądarki?',
	'optin-survey-answer-browser-ie5' => 'Internet Explorer 5',
	'optin-survey-answer-browser-ie6' => 'Internet Explorer 6',
	'optin-survey-answer-browser-ie7' => 'Internet Explorer 7',
	'optin-survey-answer-browser-ie8' => 'Internet Explorer 8',
	'optin-survey-answer-browser-ff1' => 'Firefox 1',
	'optin-survey-answer-browser-ff2' => 'Firefox 2',
	'optin-survey-answer-browser-ff3' => 'Firefox 3',
	'optin-survey-answer-browser-cb' => 'Google Chrome Beta',
	'optin-survey-answer-browser-c1' => 'Google Chrome 1',
	'optin-survey-answer-browser-c2' => 'Google Chrome 2',
	'optin-survey-answer-browser-s3' => 'Safari 3',
	'optin-survey-answer-browser-s4' => 'Safari 4',
	'optin-survey-answer-browser-o9' => 'Opera 9',
	'optin-survey-answer-browser-o9.5' => 'Opera 9.5',
	'optin-survey-answer-browser-o10' => 'Opera 10',
	'optin-survey-answer-browser-other' => 'Inna przeglądarka',
	'optin-survey-question-os' => 'Którego systemu operacyjnego używasz?',
	'optin-survey-answer-os-windows' => 'Windows',
	'optin-survey-answer-os-macos' => 'Mac OS',
	'optin-survey-answer-os-linux' => 'Linux',
	'optin-survey-answer-os-other' => 'Inny',
	'optin-survey-question-res' => 'Z jakiej rozdzielczości ekranu korzystasz?',
);

/** Portuguese (Português)
 * @author Malafaya
 */
$messages['pt'] = array(
	'optin-survey-answer-whyoptout-hard' => 'Foi demasiado difícil editar uma página.',
	'optin-survey-answer-whyoptout-other' => 'Outro motivo:',
	'optin-survey-question-os' => 'Que sistema operativo utiliza?',
	'optin-survey-answer-os-other' => 'Outro:',
	'optin-survey-question-res' => 'Qual é a resolução do seu ecrã?',
);

/** Romanian (Română)
 * @author KlaudiuMihaila
 */
$messages['ro'] = array(
	'optin-survey-answer-whyoptout-other' => 'Alt motiv:',
	'optin-survey-answer-browser-other' => 'Alt browser:',
);

/** Russian (Русский)
 * @author Ferrer
 * @author Александр Сигачёв
 */
$messages['ru'] = array(
	'optin' => 'Участие в Инициативе юзабилити',
	'optin-desc' => 'Позволяет участникам приобщиться к улучшениям движка, сделанным в ходе Инициативы юзабилити',
	'optin-title' => 'Улучшения в рамках Инициативы юзабилити',
	'optin-needlogin' => 'Вам нужно [$1 представиться] чтобы включиться в использование улучшений Инициативы юзабилити',
	'optin-intro' => 'В рамках Инициативы юзабилити Википедии разработана новая тема оформления и панель инструментов редактирования, предназначенные для повышения удобства использования Википедии. Эти усовершенствования пока ещё не включены для всех участников, но вы можете начать использовать нововведения, нажав на кнопку «{{int:optin-submit-in}}».',
	'optin-success-in' => 'Вы успешно подключились к программе усовершенствований, сделанных в рамках Инициативы юзабилити.
В можете отключиться от программы в любое время, нажав  «{{int:optin-submit-out}}» ниже.',
	'optin-success-out' => 'Вы успешно отключились от программы усовершенствований, сделанных в рамках Инициативы юзабилити.
В можете подключиться обратно к программе в любое время, нажав  «{{int:optin-submit-in}}» ниже.',
	'optin-submit-in' => 'Включиться',
	'optin-submit-out' => 'Отключиться',
	'optin-survey-intro' => 'Благодарим вас участие в программе использования улучшений Инициативы юзабилити.
В можете отключиться от программы в любое время, нажав на «{{int:optin-submit-out}}» ниже на этой странице.

Нам бы хотелось знать что вы думаете о новом интерфейсе, поэтому мы были бы признательны, если бы вы приняли участие в приведённом ниже опросе, перед тем, как нажмёте «{{int:optin-submit-out}}».',
	'optin-survey-question-whyoptout' => 'Почему вы решили выключить этот интерфейс?',
	'optin-survey-answer-whyoptout-didntlike' => 'Мне не нравится дизайн.',
	'optin-survey-answer-whyoptout-hard' => 'Он очень сложен для правки страниц.',
	'optin-survey-answer-whyoptout-didntwork' => 'Он не работает должным образом.',
	'optin-survey-answer-whyoptout-other' => 'Другая причина:',
	'optin-survey-question-browser' => 'Какой браузер вы используете?',
	'optin-survey-answer-browser-ie5' => 'Internet Explorer 5',
	'optin-survey-answer-browser-ie6' => 'Internet Explorer 6',
	'optin-survey-answer-browser-ie7' => 'Internet Explorer 7',
	'optin-survey-answer-browser-ie8' => 'Internet Explorer 8',
	'optin-survey-answer-browser-ff1' => 'Firefox 1',
	'optin-survey-answer-browser-ff2' => 'Firefox 2',
	'optin-survey-answer-browser-ff3' => 'Firefox 3',
	'optin-survey-answer-browser-cb' => 'Google Chrome Beta',
	'optin-survey-answer-browser-c1' => 'Google Chrome 1',
	'optin-survey-answer-browser-c2' => 'Google Chrome 2',
	'optin-survey-answer-browser-s3' => 'Safari 3',
	'optin-survey-answer-browser-s4' => 'Safari 4',
	'optin-survey-answer-browser-o9' => 'Opera 9',
	'optin-survey-answer-browser-o9.5' => 'Opera 9.5',
	'optin-survey-answer-browser-o10' => 'Opera 10',
	'optin-survey-answer-browser-other' => 'Другой браузер:',
	'optin-survey-question-os' => 'Какую операционную систему вы используете?',
	'optin-survey-answer-os-windows' => 'Windows',
	'optin-survey-answer-os-macos' => 'Mac OS',
	'optin-survey-answer-os-linux' => 'Linux',
	'optin-survey-answer-os-other' => 'Другая:',
	'optin-survey-question-res' => 'Каково разрешение вашего монитора?',
	'optin-survey-question-feedback' => 'Пожалуйста, сообщите нам своё мнение:',
);

/** Slovak (Slovenčina)
 * @author Helix84
 */
$messages['sk'] = array(
	'optin' => 'Prihlásenie do Iniciatívy použiteľnosti',
	'optin-desc' => 'Umožňuje používateľom prihlásiť sa do programu rozšírení použiteľnosti Iniciatíva použiteľnosti',
	'optin-title' => 'rozšírenia Iniciatíva použiteľnosti',
	'optin-needlogin' => 'Ak sa chcete prihlásiť do rozšírení použiteľnosti Iniciatíva použiteľnosti, musíte sa najskôr [$1 prihlásiť].',
	'optin-intro' => 'Iniciatíva použiteľnosti projektu Wikipédia vyvinula novú tému vzhľadu a nový panel na úpravy s cieľom rozšíriť použiteľnosť Wikipédie. Tieto rozšírenia zatiaľ neboli zapnuté všetkým používateľom, ale môžete sa prihlásiť na ich používanie kliknutím na „{{int:optin-submit-in}}“ nižšie.',
	'optin-success-in' => 'Úspešne ste sa prihlásili na používanie rozšírení použiteľnosti Iniciatíva použiteľnosti.
Kedykoľvek sa môžete sa odhlásiť od ich používania kliknutím na „{{int:optin-submit-out}}“ nižšie.',
	'optin-success-out' => 'Úspešne ste sa odhlásili od používania rozšírení použiteľnosti Iniciatíva použiteľnosti.
Kedykoľvek sa môžete sa prihlásiť na ich používanie kliknutím na „{{int:optin-submit-in}}“ nižšie.',
	'optin-submit-in' => 'Prihlásiť sa',
	'optin-submit-out' => 'Odhlásiť sa',
	'optin-survey-intro' => 'Ďakujeme, že skúšate rozšírenia použiteľnosti Iniciatívy použiteľnosti.
Môžete sa odhlásiť od ich používania kliknutím na „{{int:optin-submit-out}}“ dolu na tejto stránke.

Chceli by sme vedieť, čo si myslíte o novom rozhraní, takže by sme ocenili keby ste vyplnili tento nepovinný prieskum po kliknutí na „{{int:optin-submit-out}}“ nižšie.',
	'optin-survey-question-whyoptout' => 'Prečo sa odhlasujete od používania tohto rozhrania?',
	'optin-survey-answer-whyoptout-didntlike' => 'Nepáči sa mi ako je navrhnuté.',
	'optin-survey-answer-whyoptout-hard' => 'Bolo príliš ťažké upravovať stránku.',
	'optin-survey-answer-whyoptout-didntwork' => 'Nefungovalo správne.',
	'optin-survey-answer-whyoptout-other' => 'Iný dôvod:',
	'optin-survey-question-browser' => 'Ktorý prehliadač používate?',
	'optin-survey-answer-browser-other' => 'Iný prehliadač:',
	'optin-survey-question-os' => 'Ktorý operačný systém používate?',
	'optin-survey-answer-os-other' => 'Iný:',
	'optin-survey-question-res' => 'Aké je rozlíšenie vašej obrazovky?',
	'optin-survey-question-feedback' => 'Ak máte ďalšie komentáre, napíšte ich prosím:',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'optin-survey-answer-whyoptout-other' => 'ఇతర కారణం:',
	'optin-survey-answer-browser-other' => 'ఇతర విహారిణి:',
	'optin-survey-answer-os-other' => 'ఇతర:',
);

/** Turkish (Türkçe)
 * @author Joseph
 */
$messages['tr'] = array(
	'optin' => 'Kullanılabilirlik Girişimi katılım',
	'optin-desc' => "Kullanıcıların, Kullanılabilirlik Girişimi'nin kullanılabilirlik geliştirmelerine katılmalarına izin verir",
	'optin-title' => 'Kullanılabilirlik Girişimi geliştirmeleri',
	'optin-needlogin' => "Kullanılabilirlik Girişimi'nin kullanılabilirlik geliştirmelerine katılabilmek için [$1 giriş yapmalısınız].",
	'optin-intro' => 'Vikipedi Kullanılabilirlik Girişimi, Vikipedi\'nin kullanılabilirliğini geliştirmek amacıyla yeni bir tema ve yeni bir araç çubuğu geliştirdi. Bu geliştirmeler tüm kullanıcılar için etkinleştirilmedi, ama siz aşağıdaki "{{int:optin-submit-in}}"a tıklayarak katılabilirsiniz.',
	'optin-success-in' => 'Kullanılabilirlik Girişimi\'nin kullanılabilirlik geliştirmelerine başarıyla katıldınız.
Aşağıdaki "{{int:optin-submit-out}}" düğmesine tıklayarak istediğiniz zaman ayrılabilirsiniz.',
	'optin-success-out' => "Kullanılabilirlik Girişimi'nin kullanılabilirlik geliştirmelerinden başarıyla kayrıldınız.
Aşağıdaki {{int:optin-submit-in}} düğmesine tıklayarak istediğiniz zaman tekrar katılabilirsiniz.",
	'optin-submit-in' => 'Katıl',
	'optin-submit-out' => 'Katılma',
	'optin-survey-intro' => 'Kullanılabilirlik Girişimi\'nin kullanılabilirlik geliştirmelerini denediğiniz için teşekkürler.
Bu sayfanın en altındaki "{{int:optin-submit-out}}" düğmesine tıklayarak istediğiniz zaman ayrılabilirsiniz.

Yeni arayüzümüz konusunda ne düşündüğünüzü bilmek isteriz, o yüzden "{{int:optin-submit-out}}" düğmesine tıklamadan önce isteğe bağlı anketimizi doldurursanız memnun kalırız.',
	'optin-survey-question-whyoptout' => 'Neden bu arayüzden ayrılıyorsunuz?',
	'optin-survey-answer-whyoptout-didntlike' => 'Tasarımı beğenmiyorum.',
	'optin-survey-answer-whyoptout-hard' => 'Bir sayfayı değiştirmek çok zor.',
	'optin-survey-answer-whyoptout-didntwork' => 'Düzgün çalışmadı.',
	'optin-survey-answer-whyoptout-other' => 'Diğer sebep:',
	'optin-survey-question-browser' => 'Hangi tarayıcıyı kullanıyorsunuz?',
	'optin-survey-answer-browser-other' => 'Diğer tarayıcı:',
	'optin-survey-question-os' => 'Hangi işletim sistemini kullanıyorsunuz?',
	'optin-survey-answer-os-other' => 'Diğer:',
	'optin-survey-question-res' => 'Ekran çözünürlüğünüz nedir?',
	'optin-survey-question-feedback' => 'Lütfen geribeslemenizi bildirin:',
);

/** Ukrainian (Українська)
 * @author AS
 */
$messages['uk'] = array(
	'optin-survey-question-whyoptout' => 'Чому ви вирішили відмовитися від цього інтерфейсу?',
	'optin-survey-answer-whyoptout-didntlike' => 'Мені не подобається оформлення.',
	'optin-survey-answer-whyoptout-hard' => 'Надто складно редагувати сторінки.',
	'optin-survey-answer-whyoptout-didntwork' => 'Він не працює належним чином.',
	'optin-survey-answer-whyoptout-other' => 'Інша причина:',
	'optin-survey-question-browser' => 'Яким оглядачем ви користуєтесь?',
	'optin-survey-answer-browser-other' => 'Інший:',
	'optin-survey-question-os' => 'Якою операційною системою ви користуєтесь?',
	'optin-survey-answer-os-other' => 'Інша:',
	'optin-survey-question-res' => 'Яка роздільність вашого монітора?',
	'optin-survey-question-feedback' => 'Будь ласка, висловіть своє судження:',
);


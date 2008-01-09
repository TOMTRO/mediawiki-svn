<?php
/** Russian (Русский)
 * @author .:Ajvol:.
 */
$messages = array(
	'editor'                      => 'редактор',
	'group-editor'                => 'редакторы',
	'group-editor-member'         => 'редактор',
	'grouppage-editor'            => '{{ns:project}}:Редактор',
	'reviewer'                    => 'рецензент',
	'group-reviewer'              => 'рецензенты',
	'group-reviewer-member'       => 'рецензент',
	'grouppage-reviewer'          => '{{ns:project}}:Рецензент',
	'revreview-current'           => 'черновик',
	'tooltip-ca-current'          => 'Просмотреть текущий черновик этой страницы',
	'revreview-edit'              => 'Править черновик',
	'revreview-source'            => 'исходный текст черновика',
	'revreview-stable'            => 'Чистовик',
	'tooltip-ca-stable'           => 'Просмотреть чистовик этой страницы',
	'revreview-oldrating'         => 'Была оценена:',
	'revreview-noflagged'         => "У этой страницы нет отрецензированных версий, вероятно, её качество '''не''' [[{{MediaWiki:Validationpage}}|оценивалось]].",
	'stabilization-tab'           => '(кк)',
	'tooltip-ca-default'          => 'Настройки контроля качества',
	'validationpage'              => '{{ns:help}}:Проверка статьи',
	'revreview-quick-none'        => "'''Текущая''' (нет отрецензированных версий)",
	'revreview-quick-see-quality' => "'''Черновик''' [[{{fullurl:{{FULLPAGENAMEE}}|stable=1}} см. чистовик]]  
($2 [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} {{plural:$2|правка|правки|правок}}])",
	'revreview-quick-see-basic'   => "'''Черновик''' [[{{fullurl:{{FULLPAGENAMEE}}|stable=1}} см. чистовик]]  
($2 [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} {{plural:$2|правка|правки|правок}}])",
	'revreview-quick-basic'       => "'''[[{{MediaWiki:Validationpage}}|Просмотренная]]''' [[{{fullurl:{{FULLPAGENAMEE}}|stable=0}} см. черновик]]  
($2 [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} {{plural:$2|правка|правки|правок}}])",
	'revreview-quick-quality'     => "'''[[{{MediaWiki:Validationpage}}|Качественная]]''' [[{{fullurl:{{FULLPAGENAMEE}}|stable=0}} см. черновик]]  
($2 [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} {{plural:$2|правка|правки|правок}}])",
	'revreview-newest-basic'      => '[{{fullurl:{{FULLPAGENAMEE}}|stable=1}} Последняя просмотренная версия]  
([{{fullurl:Special:Stableversions|page={{FULLPAGENAMEE}}}} список всех]) была [{{fullurl:Special:Log|type=review&page={{FULLPAGENAMEE}}}} отмечена]
<i>$2</i>. [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} $3 {{plural:$3|правка|правки|правок}}] {{plural:$3|требует|требуют|требуют}} просмотра.',
	'revreview-newest-quality'    => '[{{fullurl:{{FULLPAGENAMEE}}|stable=1}} Последняя качественная версия]  
([{{fullurl:Special:Stableversions|page={{FULLPAGENAMEE}}}} список всех]) была [{{fullurl:Special:Log|type=review&page={{FULLPAGENAMEE}}}} отмечена]
<i>$2</i>. [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} $3 {{plural:$3|правка|правки|правок}}] {{plural:$3|требует|требуют|требуют}} просмотра.',
	'revreview-basic'             => 'Это последняя [[{{MediaWiki:Validationpage}}|просмотренная]] версия,  
[{{fullurl:Special:Log|type=review&page={{FULLPAGENAMEE}}}} отмеченная] <i>$2</i>. Возможно, [{{fullurl:{{FULLPAGENAMEE}}|stable=0}} черновик]  
уже [{{fullurl:{{FULLPAGENAMEE}}|action=edit}} изменён]; [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} $3 {{plural:$3|правка|правки|правок}}] {{plural:$3|ожидает|ожидают|ожидают}} просмотра.',
	'revreview-quality'           => 'Это последняя [[{{MediaWiki:Validationpage}}|качественная]] версия,  
[{{fullurl:Special:Log|type=review&page={{FULLPAGENAMEE}}}} отмеченная] <i>$2</i>. Возможно, [{{fullurl:{{FULLPAGENAMEE}}|stable=0}} черновик]  
уже [{{fullurl:{{FULLPAGENAMEE}}|action=edit}} изменён]; [{{fullurl:{{FULLPAGENAMEE}}|oldid=$1&diff=cur&editreview=1}} $3 {{plural:$3|правка|правки|правок}}] {{plural:$3|ожидает|ожидают|ожидают}} просмотра.',
	'revreview-static'            => "Это [[{{MediaWiki:Validationpage}}|отрецензированная]] версия '''[[:$3|$3]]''',  
[{{fullurl:Special:Log/review|page=$1}} отмеченная] <i>$2</i>.",
	'revreview-toggle'            => '(+/-)',
	'revreview-note'              => '[[Участник:$1]] сделал следующее замечание, [[{{MediaWiki:Validationpage}}|рецензирую]] эту версию:',
	'revreview-update'            => 'Пожалуйста, отрецензируйте любую правку (показаны ниже), сделанную после принятия статуса чистовика. Некоторые шаблоны или изображения были обновлены:',
	'revreview-update-none'       => 'Пожалуйста, просмотрите изменения (показаны ниже), сделанные после установки чистовой версии.',
	'revreview-auto'              => '(автоматически)',
	'revreview-auto-w'            => "Вы правите чистовую версию, все изменения будут '''автоматически отмечены как проверенные'''. Возможно, перед записью страницы следует воспользоваться предпросмотром.",
	'revreview-auto-w-old'        => "Вы правите старую версию, все изменения будут '''автоматически отмечены как проверенные'''. Возможно, перед записью страницы следует воспользоваться предпросмотром.",
	'revreview-patrolled'         => 'Выбранная версия [[:$1|$1]] была отмечена как патрулированная.',
	'hist-stable'                 => '[осмотрена]',
	'hist-quality'                => '[качественная]',
	'flaggedrevs'                 => 'Отмеченные версии',
	'review-logpage'              => 'Журнал рецензий',
	'review-logpagetext'          => 'Это журнал изменений статусов версий страниц.',
	'review-logentry-app'         => 'отрецензирована [[$1]]',
	'review-logentry-dis'         => 'устаревшая версия [[$1]]',
	'review-logaction'            => 'идентификатор версии $1',
	'stable-logpage'              => 'Журнал чистовых страниц',
	'stable-logpagetext'          => 'Это журнал изменений настроек чистовых страниц.',
	'stable-logentry'             => 'установка чистового версионирования для [[$1]]',
	'stable-logentry2'            => 'сброс чистового версионирования для [[$1]]',
	'revisionreview'              => 'Рецензирование версий',
	'revreview-main'              => 'Вы должны выбрать одну из версий страницы для рецензирования.

См. список неотрецензированных страниц на [[Special:Unreviewedpages]].',
	'revreview-selected'          => "Выбранная версия '''$1:'''",
	'revreview-text'              => 'По умолчаю установлен показ чистовых версий страниц, а не наиболее новых.',
	'revreview-toolow'            => 'Вы должны указать для всех значений уровень выше, чем «неподтверждённая», чтобы версия страницы считалась отрецензированной. Чтобы сбросить флаг рецензирования, установите все значения в «неподтверждённая».',
	'revreview-flag'              => 'Рецензировать эту версию (#$1)',
	'revreview-legend'            => 'Оценки содержания версии',
	'revreview-notes'             => 'Наблюдения и замечания для отображения:',
	'revreview-accuracy'          => 'Точность',
	'revreview-accuracy-0'        => 'неподтверждённая',
	'revreview-accuracy-1'        => 'осмотрена',
	'revreview-accuracy-2'        => 'точная',
	'revreview-accuracy-3'        => 'с источниками',
	'revreview-accuracy-4'        => 'избранная',
	'revreview-depth'             => 'Полнота',
	'revreview-depth-0'           => 'неподтверждённая',
	'revreview-depth-1'           => 'базовая',
	'revreview-depth-2'           => 'средняя',
	'revreview-depth-3'           => 'высокая',
	'revreview-depth-4'           => 'избранная',
	'revreview-style'             => 'Читаемость',
	'revreview-style-0'           => 'неподтверждённая',
	'revreview-style-1'           => 'приемлемая',
	'revreview-style-2'           => 'хорошая',
	'revreview-style-3'           => 'немногословно',
	'revreview-style-4'           => 'избранная',
	'revreview-log'               => 'Примечание:',
	'revreview-submit'            => 'Отправить рецензию',
	'revreview-changed'           => "'''Запрошенное действие не может быть выполнено с этой версией.'''

Возможно, шаблон или изображение были запрошены без указания конкретной версии. Это могло случиться, если динамический шаблон включает другой шаблон или изображение, зависящие от переменной, которая изменилась с момента начала рецензирования. Обновите страницу и начните рецензирование заново, проблема может исчезнуть.",
	'stableversions'              => 'Чистовые версии',
	'stableversions-leg1'         => 'Список отрецензированных версий страницы',
	'stableversions-page'         => 'Название страницы:',
	'stableversions-none'         => '«[[:$1]]» не имеет выверенных версий.',
	'stableversions-list'         => 'Следующие версии страницы «[[:$1]]» были отрецензированны:',
	'stableversions-review'       => 'Отрецензированна <i>$1</i> участником $2',
	'review-diff2stable'          => 'Разность с чистовой версией',
	'unreviewedpages'             => 'Неотрецензированные страницы',
	'viewunreviewed'              => 'Список непроверенных страниц с материалами',
	'unreviewed-outdated'         => 'Показывать страницы, имеющие неотрецензированные версии, а не чистовые версии.',
	'unreviewed-category'         => 'Категори:',
	'unreviewed-diff'             => 'изменения',
	'unreviewed-list'             => 'На этой странице перечислены статьи, которые не были отрецензированны, или имеют новые, неотрецензированные версии.',
);

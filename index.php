<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';

 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!doctype html>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>





        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link href="css/style.css" rel="stylesheet">


    </head>

    <body id="home">
		
		<!-- include Navbar -->
		<?php
			include ("php/include/navbar.php");
		?>

		


        <!-- _________________________Content________________________________-->
        <br>
        <br>
        <br>
        <br>

        <!-- every content should be nested in a way like the example below   -->

        <!-- nested columns -->
        <div class="row first-after-navbar">
            <form>
                <!-- first nested column -->
                <div class="col-md-12">
                    <p id="input-textarea">                                                                                                               
   
1. alzheimer demenz
„die alzheimer-krankheit ist eine hirnorganische krankheit. sie ist nach dem deut-
schen neurologen alois alzheimer (1864 - 1915) benannt, der die krankheit erstmals
im jahre 1906 wissenschaftlich beschrieben hat. die alzheimer-krankheit ist ein
durch fehlerhafte stoffwechselvorgänge hervorgerufener, langsam fortschreitender
verlust von nervenzellen. die folge hiervon ist die schrumpfung des gehirns um bis
zu 20 prozent. durch den untergang der nervenzellen werden auch die der infor-
mationsweiterleitung und -verarbeitung dienenden übertragungsstellen zwischen
den nervenzellen zerstört. das typische der alzheimer-krankheit besteht darin,
dass das absterben von nervenzellen mit der bildung von abnorm veränderten ei-
weiß bruchstücken einhergeht, die sich im gehirn ablagern. betroffen vom nerven-
zell-verlust sind vor allem jene abschnitte des gehirns, die für das gedächtnis und
die denkfähigkeit wichtig sind“1 .alzheimer

„die krankheit macht keinen unterschied hinsichtlich der sozialen herkunft oder
des geschlechts. nur im hohen alter sind frauen häufiger betroffen als männer. das
hängt einerseits mit ihrer höheren lebenserwartung zusammen, möglicherweise
spielen aber auch die hormonellen veränderungen in dieser altersstufe eine
Rolle.“ alzheimer

„die ursachen der erkrankung sind erst teilweise bekannt. sicher ist, dass mehrere
faktoren zusammenwirken. wichtigster risikofaktor ist das alter. an zweiter stelle
steht eine bestimmte variante der blutfett regulierung, die die ablagerung von
amyloid, einer schwer löslichen eiweißsubstanz, begünstigt. krankheit begünsti-
gend wirken auch eine mangelnde schulbildung und spärliche soziale kontakte. in
einigen familien können veränderungen des erbgutes vorliegen, die allein ausrei-
chen, um eine alzheimer krankheit hervorzurufen. es handelt sich hierbei um fa-
milien, die durch mehrere früh, also in der regel vor dem 60. lebensjahr erkrankte
personen gekennzeichnet sind.“3
                                                                               
häufige symptome von alzheimer sind der verlust der selbstständigkeit, da aktivitäten des tägli-
chen lebens, wie z.b. das ankleiden oder essen, vergessen werden, verlust der
sprache, von zu beginn fehlenden worte hin zum völligen sprachverlust, orientie-
rungslosigkeit und verlust über die körperkontrolle, welche sich durch krämpfe
oder inkontinenz äußert.

für alzheimer gibt es keine heilung. jedoch können antidementiva je nach stadi-
um der krankheit den fortschritt verzögern4. darüber hinaus ist eine pflege des
betroffenen notwendig. in dieser gibt es jedoch mehrere ansätze und übungen, die
den krankheitsverlauf verzögern. besonders kritisch ist dabei der fokus auf noch
vorhandene fähigkeiten des erkrankten mit alzheimer, damit diese so lange wie möglich noch
selbstständig ausgeführt werden können, da dies auch die würde und selbstwert-
gefühl des betroffenen stärkt. daher leiden oftmals personen, die kontaktsportarten,
wie z.b. boxen, betreiben oder soldaten an ihr.

1.1 die eurobiologischen grundlagen der alzheimer-krankheit

makroskopische veränderungen

die klinischen symptome der alzheimer-krankheit werden durch einen fortschrei-
tenden verlust von nervenzellen hervorgerufen. folge hiervon ist die schrumpfung
des gehirns um bis zu 20%, und eine damit verbundene vertiefung der windungfur-
chen an der hirnoberfläche sowie eine erweiterung der hirnkammern. in mittleren
und fortgeschrittenen krankheitsstadien kann diese schrumpfung durch bildgeben-
de verfahren wie computertomographie (ct) oder magnetresonanztomographie
(mrt) sichtbar gemacht werden. diese untersuchungen können dabei helfen, ande-
re krankheiten abseits von alzheimer abzugrenzen, die mit einem ähnlichen klinischen erscheinungsbild
einhergehen. dazu zählen zerebrovaskuläre krankheiten, degenerationen des
stirnhirns, die lewy-körperchen-krankheit und die parkinson-krankheit.

mikroskopische veränderungen

der verlust von nervenzellen tritt bei alzheimer nicht nur in der hirnrinde auf, sondern auch in
tiefer liegenden hirnstrukturen. durch den untergang der nervenzellen werden
auch die der informationsweiterleitung und -verarbeitung dienenden übertragungs-
stellen zwischen den nervenzellen zerstört. gleichzeitig kommt es zu einer wu-
cherung von stützzellen. eine tiefer liegende hirn- struktur, die besonders frühzei-
tig nervenzelluntergänge aufweist, ist der meynertbasalkern, dessen nerven- zel-
len den überträgerstoff acetylcholin erzeugen. infolge des absterbens von zellen
in diesem kern kommt es zu einer erheblichen verminderung des überträgerstoffs
in der hirnrinde. diese veränderung bewirkt störungen der in- formationsverarbei-
tung und ist ursächlich am gedächtnisverlust beteiligt. das typische der alzheimer-
krankheit besteht darin, dass das absterben

von nervenzellen mit der bildung von abnorm veränderten eiweißbruchstücken
einhergeht, die sich in form von fäserchen im gehirn ablagern. dabei handelt es
sich erstens um die von alois alzheimer beschriebenen neurofibrillenbündel. diese
innerhalb vieler nervenzellen nachweisbaren knäuel bestehen aus tau-protein, ei-
nem normalen bestandteil des zellskeletts.

bei der alzheimer-krankheit wird das tau-protein jedoch übermäßig mit phosphat-
gruppen beladen. dadurch kommt es in der zelle zu störungen von stabilisierungs-
und transportprozessen, die letztlich zum absterben der zelle führen.

die zweite für die alzheimer-krank-heit charakteristische pathologische
eiweiß-ablagerung sind die zwischen den nervenzellen zu findenden plaques.
sie bestehen aus einem zen- tralen amyloidkern, der von pathologisch veränderten
nervenzellfortsätzen und stützzellen umgeben wird. bei zahlreichen alzheimer patienten
lagert sich das amyloid auch in der wand kleiner blut- gefäße ab. dadurch verschlechtert
sich ihre durchlässigkeit und es kommt zu störungen der sauerstoff- und energieversorgung
des gehirns. das amyloid ist ein spaltprodukt eines größeren eiweißmoleküls, dessen
funktion bis- her nicht genau bekannt ist. in seltenen fällen werden sie durch
veränderungen des erbgutes auf den chromosomen 1, 14 oder 21 hervorgerufen

1.2 die genetik der alzheimer-krankheit

krankheitsrisiko bei verwandten
genetische faktoren sind verantwort- lich für gehäuftes auftreten der alzheimer-
krankheit in familien. deshalb finden sich bei ungefähr 30 % aller alzheimer pati-
enten weitere betroffene in der engeren verwandtschaft. verwandte ersten grades
(eltern, geschwister, kinder) haben im durchschnitt ein vierfach erhöhtes erkran-
kungsrisiko. das entspricht einer wahrscheinlichkeit von fast 20%, irgendwann im
leben die krankheit zu bekommen. für verwandte zweiten grades (großeltern,
onkel, tanten, neffen, nichten etc.) ist diese wahrscheinlichkeit mit 10 % gegen-
über dem bevölkerungsdurchschnitt verdoppelt. diese werte beruhen auf einer
durchschnittlichen lebenserwartung von 72 jahren für männer und von 78 jahren
für frauen. im höheren lebens- alter steigt die gefahr alzheimer zu bekommen an, bleibt jedoch deutlich
unter 50%. sind mehrere personen in einer familie erkrankt, er- höht sich das wie-
derholungsrisiko für verwandte weiter. außerdem ist ein früher krankheitsbeginn
des ausgangspatienten (vor dem 60. lebensjahr) mit einem höheren wiederho-
lungsrisiko für verwandte verbunden als ein späterer.

risikofaktoren

das alter ist der wichtigste risikofaktor für die entwicklung der alzheimerkrank-
heit. so beträgt die wahrscheinlichkeit zu erkranken unter berücksichtigung meh-
rerer studien für 65-74jährige personen etwa 1,7%, für 75-84jährige etwa 11% und
für personen über 84 jahre etwa 30%.

es gibt auch gene, die das auftreten der alzheimer-krankheit begünstigen, jedoch
alleine als ursache nicht ausreichen. von diesen genetischen risikofaktoren ist bis-
her erst die variante ε4 des gens für apolipoprotein e (apoe) gesichert. das apoe-
gen kommt in drei häufigen varianten vor, die man

als allele ε2, ε3 und ε4 bezeichnet. die häufigkeit des ε4-allels beträgt 10% bei ge-
sunden personen, aber 30-42% bei alzheimer-patienten. das vorliegen von einer
oder zwei kopien des ε4-allels erhöht also die wahrscheinlichkeit, die alzheimer-
krankheit zu bekommen. allerdings stellt das ε4-allel weder eine notwendige noch
eine hinreichende voraussetzung für die krankheit dar. deswegen kann die be-
stimmung des ε4-allels nicht für prognostische zwecke herangezogen werden. bestimmungen
von apoe sind allenfalls von begrenztem nutzen für diagnostische fragestellungen

erbliche formen der alzheimer- krankheit

weniger als 2 % aller fälle von alzheimer-krankheit werden dominant vererbt. dies
bedeutet, dass die veränderung (mutation) eines einzigen gens für die entstehung
der krankheit aus- reicht und dass statistisch gesehen die hälfte der nachkommen
eines betroffenen ebenfalls erkranken. bisher sind drei gene bekannt, die bei au-
tosomal dominant vererbten formen der alzheimer-krankheit mutiert sein können.
es handelt sich um die gene präsenilin 1 und präsenilin 2 auf den chromosomen 14
bzw. 1, sowie um das auf chromosom 21 gelegene gen für das amyloid-vorläufer-
molekül (siehe informationsblatt 2 zur neurobiologie). patienten mit mutationen in
einem dieser drei gene erkranken in der regel unter 60 jahren. das erkrankungsal-
ter ist bei mutationen im amyloid-vorläufer-gen besonders niedrig (um das 40. le-
bensjahr), bei präsenilin-2-mutationen kann es in manchen fällen auch jenseits des
70. lebensjahres liegen. 

genetische tests

wenn der familienstammbaum eines früh erkrankten patienten anhaltspunkte für
die vererbung der alzheimer-krankheit nach mendelschen regeln ergibt, kann in
seinem blut festgestellt werden, ob er träger einer mutation in einem der drei ge-
genwärtig bekannten gene ist. selbstverständlich muss der patient dafür nach
gründlicher aufklärung sein einverständnis geben. falls bei ihm eine mutation
nachgewiesen werden kann, ist es grundsätzlich auch möglich, bei seinen gesun-
den verwandten nach dieser mutation zu suchen. von besonderer bedeutung bei alzheimer ist
dies in der regel für 

die kinder. ein solcher prädiktiver gentest wirft aber erhebliche ethische probleme
auf. vor allem gibt es gegenwärtig noch keine möglichkeit für eine vorbeugende
behandlung.

2. krankheiten alzheimer-demenz
die häufigste form der demenzerkrankungen ist die alzheimer-demenz, die in ihrer
häufigsten form bei personen über dem 65. lebensjahr auftritt und durch zuneh-
mende demenz gekennzeichnet ist. sie ist für ungefähr 60 prozent der weltweit
etwa 24 millionen demenzerkrankungen verantwortlich. alzheimer ist eine erkran-
kung des gehirns, die vorrangig vom fortschreitenden verlust des gedächtnisses
geprägt ist. im verlauf der alzheimer erkrankung verlieren die erkrankten aber nach und nach
auch andere geistige fähigkeiten wie z.b. ihr orientierungsvermögen oder das
sprachverständnis.

2.1 ursachen

aus bisher noch nicht vollständig geklärtem grund kommt es bei morbus alzheimer
zu einem fortschreitenden verlust von nervenzellen und in weiterer folge zu ei-
nem deutlichen schrumpfen der hirnmasse. durch den untergang der nervenzellen
werden auch die übertragungsstellen zwischen den nervenzellen zerstört, die der
informationsweiterleitung und –verarbeitung dienen. ebenso verringert sich bei alzheimer die
konzentration wichtiger neuronaler botenstoffe (vor allem acetylcholin), woraus
störungen der informationsverarbeitung und die typischen lern- und gedächtnis-
probleme resultieren.

die bruchstücke der zugrunde gegangenen nervenzellen werden nicht vollständig
abgebaut und bilden zusammen mit anderen eiweißen die für die krankheit cha-
rakteristischen ablagerungen im gehirn (alzheimer-fibrillen und -plaques).

der wichtigste risikofaktor für die entwicklung einer alzheimer-demenz ist das le-
bensalter. ab dem 60.lebensjahr verdoppelt sich die demenzhäufigkeit alle fünf
jahre. auch genetische faktoren spielen in der entstehung eine ursächliche rolle.
bei etwa 30% aller alzheimer-patienten finden sich in der engeren verwandtschaft
weitere betroffene. das erkrankungsrisiko ist bei verwandten 1. grades gegenüber
dem normalwert mehr als vierfach erhöht. es sind gene bekannt, die das auftreten
von morbus alzheimer begünstigen, als alleinige ursache aber nicht ausreichen, um
die krankheit auszulösen. dazu zählt eine bestimmte variante des gens für
apolipoprotein e.
daneben gibt es erbliche formen der alzheimer-krankheit, die dominant vererbt
werden, das heißt, dass die veränderung eines einzigen gens für die entstehung
der krankheit ausreicht. etwa zwei prozent aller alzheimer-erkrankungen gehören
zu dieser gruppe. die gene, die dabei eine rolle spielen, sind präsenilin 1 und
präsenilin 2 (chromosom 14) sowie das gen für das amyloid-vorläufer-molekül
(chromosom 21). tritt die alzheimer-demenz vor dem 60. lebensjahr auf, ist dies
fast immer genetisch bedingt.
daneben gibt es erbliche formen der alzheimer-krankheit, die dominant vererbt
werden, das heißt, dass die veränderung eines einzigen gens für die entstehung
der krankheit ausreicht. etwa zwei prozent aller alzheimer-erkrankungen gehören
zu dieser gruppe. die gene, die dabei eine rolle spielen, sind präsenilin 1 und
präsenilin 2 (chromosom 14) sowie das gen für das amyloid-vorläufer-molekül
(chromosom 21). tritt die alzheimer-demenz vor dem 60. lebensjahr auf, ist dies
fast immer genetisch bedingt.
auch bestimmte krankheitsbilder gehen mit einem gesteigerten risiko für eine
beeinträchtigung der gedächtnisfunktion bei alzheimer patienten einher, darunter die
schilddrüsenunterfunktion, die depression sowie schwere gehirnverletzungen in
der vergangenheit. diese ursachen gehören zu den sogenannten psychoorganischen
erkrankungen, also krankheiten, bei denen entweder erkrankungen der psyche den
körper schädigen oder erkrankungen des körpers die psyche negativ beeinflussen.
menschen mit guten sozialen kontakten erkranken seltener an einer alzheimer-
demenz als andere. ob die ursache dafür eine durch vereinsamung entstandene
depressive verstimmung ist oder andere ursachen bzw. folgen der sozialen isolati-
on für diesen zusammenhang verantwortlich sind, ist nicht klar.
frauen erkranken an alzheimer etwa doppelt so häufig wie männer. ein grund dafür ist die
höhere lebenserwartung von frauen. derzeit wird erforscht, ob auch andere
ursachen für diesen geschlechterunterschied verantwortlich sein könnten.
weitere mögliche risikofaktoren bei alzheimer sind:
bluthochdruck
alkoholkonsum
rauchen
diabetes mellitus
übergewicht
erhöhter cholesterinspiegel (hypercholesterinämie)
chronischer stress
hohe aufnahme gesättigter fettsäuren
evtl. hyperhomocysteinämie
eine ansteckungsgefahr besteht nicht.

die alzheimer-krankheit verläuft nicht bei jedem patienten in gleicher weise. die
art und ausprägung der symptome können sich unterscheiden. die krankheit lässt
sich trotzdem in drei grundlegende stadien einteilen: frühes stadium, mittleres
stadium und spätes stadium

2.2 verlauf

der verlauf der alzheimer-erkrankung

alzheimer ist eine fortschreitende erkrankung. sie führt zu einem zunehmenden
verlust von geistigen fähigkeiten und hirnfunktionen. dadurch sind die erkrankten
irgendwann nicht mehr in der lage, selbstständig für sich zu sorgen. sie werden
dauerhaft von betreuung und pflege abhängig. alzheimer im spätstadium tre-
ten neben dem geistigen abbau körperliche beschwerden auf, die die patienten
bettlägerig und anfällig für alterskrankheiten wie z. b. lungenentzündung machen.
trotz großer wissenschaftlicher anstrengungen lässt sich alzheimer bis heute
nicht heilen. der verlauf kann jedoch durch medikamente und andere behand-
lungsverfahren günstig beeinflusst und verzögert werden. auch vorübergehende
besserungen des zustands sind möglich. darüber hinaus wurden methoden entwi-
ckelt, die den betroffenen und angehörigen alzheimer patienten helfen können, besser mit den auswir-
kungen der erkrankung umzugehen.

der verlauf von alzheimer kann grob in drei stadien eingeteilt werden. die über-
gänge sind jedoch fließend und die stadien können nicht immer klar voneinander
abgegrenzt werden. auch ist die entwicklung der erkrankung von patient zu patient
unterschiedlich. der verlauf kann im einzelfall deshalb von dem hier vorgestellten
schema abweichen.

2.3 spätes stadium

je länger ein alzheimer andauert, desto weniger fähigkeiten bleiben dem betroffe-
nen menschen. die patienten scheinen in einer welt zu leben, die immer kleiner und
doch unübersichtlicher wird. menschen des alzheimers im späten stadium sind bei
allen tätigkeiten auf hilfe angewiesen. alzheimer patienten im spätstudium verlieren
zuletzt auch die kontrolle über ihre körperfunktionen.

alzheimerkranke im späten stadium können kein gespräch mehr führen. alzheimer-
kranke im späten stadium reagieren kaum und reihen allenfalls einzelne wörter oder
laute aneinander. viele verstummen völlig bei alzheimerkranke im spätstudium.
dies bedeutet aber nicht automatisch, dass keinerlei kommunikation mehr möglich
ist. die brücke der gefühle trägt länger als worte.

kommunikation

oft staunen pflegende angehörige darüber, wie empfindsam ihr alzheimerkrankes
familienmitglied zum beispiel auf sanfte berührung reagiert. auch bestimmte ge-
sichter können angenehme emotionen auslösen – obwohl der oder die kranke
selbst enge verwandte nicht mehr erkennt. weitere türen in die welt von alzheimer
im spätstudium können musik, gebete und gerüche sein. viele patienten im spät-
studium lauschen gern den melodien, die zu ihrer jugendzeit populär waren. das
vaterunser haben die meisten alten menschen in früher kindheit gelernt und ein le-
ben lang immer wieder gesprochen und gehört. es laut am bett zu beten, kann posi-
tive gefühle wecken. das gleiche gilt bei alzheimer für düfte: das rasierwasser, das der demenz-
kranke großvater schon als junger mann benutzt hat, oder das parfüm, ohne das
mutter nie aus dem haus ging, zaubern manchmal ein seliges lächeln auf die lip-
pen.

auffälliges verhalten

in einer übergangsphase von der mittleren zur späten alzheimer demenz schlägt die stim-
mung mancher patienten mitunter jäh um: stundenlang kann ein demenzkranker
mensch reglos am fenster sitzen – um dann urplötzlich aufzustehen und lange in
der wohnung auf und ab zu gehen. angehörige sollten sicherstellen, dass die woh-
nungstür gut verschlossen ist. verirren sich alzheimerkranke auf die straße, finden sie
kaum zurück – und sind den gefahren des autoverkehrs ausgeliefert. dieses ziellos
wirkende umherirren kann auch mitten in der nacht auftreten, da demenzkranke
das zeitgefühl verlieren. vergangenheit, gegenwart und zukunft verschwimmen.

spätes stadium: körperlicher verfall

ein alzheimer im spätstudium lassen sich blase und darm nicht mehr kontrollieren.
ohnehin gehen die kranken im spätstudium nicht mehr von selbst zur toilette – sie
können die signale des körpers nicht mehr deuten. viele patienten im spätstudium von alzheimer
leiden darüber hinaus unter verstärkter muskelspannung, die sie nicht beeinflussen
können. mit der zeit wirkt sich dies auf die gelenke aus. sie werden steif. einen löf-
fel zum mund zu führen, ist unter diesen umständen kaum mehr möglich. auch das
schlucken fällt immer schwerer. am ende ihres lebens bedürfen demenzkranke ei-
ner pflege rund um die uhr. patienten im spätstudium sind bettlägerig.

das wichtigste in kürze

   • aktivitäten des täglichen lebens für spät alzheimer kranken sind nicht mehr
      selbstständig zu bewältigen
   • spät alzheimer kranken sind totale abhängigkeit
   • spät alzheimer kranken haben gar keine oder sehr geringe kommunikation
      möglich
   • spät alzheimer kranken verlieren der kontrolle über den körper z.b. inkon-
      tinenz
   • erhöhte anfälligkeit für infektionen für spät alzheimer kranken
   • starre gesichtszüge für spät alzheimer kranken
   • krämpfe und krampfanfälle für spät alzheimer kranken

2.4 woran sterben menschen mit einer alzheimer?

das ist eine frage, die sich viele angehörige stellen. verkürzt ein alzheimer die le-
benserwartung? oder in schlimmen fällen: was erlöst die betroffenen?

tatsächlich ist es so, dass die alzheimer-erkrankung selbst, also der verlust an ner-
venzellen im gehirn, das leben nicht direkt bedroht. man kann also nicht an einer
demenz sterben.

allerdings ist das nur die halbe wahrheit. denn bei einer fortgeschrittenen demenz
oder einer alzheimer-erkrankung ist die lebenserwartung letztlich doch oft verkürzt.

das hängt vor allem mit der irgendwann entstehenden bettlägerigkeit zusammen.
auch der verlust von körperfunktionen – in spätstadien kann es zum beispiel vor-
kommen, dass die alzheimer betroffenen nicht mehr kauen können oder ihren stuhl nicht mehr
kontrollieren können – spielt hier eine wichtige rolle.

all das resultiert in einer höheren anfälligkeit für schwere infektionen. nicht wenige
demenz-kranke im spätstudium sterben an einer lungenentzündung.

3. behandlung des späte alzheimer

3.1 die medikamentöse behandlung des späte alzheimer

die pharmakotherapie richtet sich primär auf die linderung der alzheimer-sym-
ptome und die behandlung möglicher begleiterkrankungen. die geistige leistungs-
fähigkeit der patienten soll verbessert und ihre alltagsbewältigung erleichtert wer-
den, zudem sollen mögliche verhaltensauffälligkeiten oder depressionen gemildert
werden. welche wirkung – also auch neben- oder wechselwirkungen – medikamen-
te haben, ist individuell verschieden. denn so wie sich die bedürfnisse des an alzheimer erkrank-
ten mit dem krankheitsverlauf verändern, so kann sich die verträglichkeit von mit-
teln ändern.

während der beginn einer alzheimer-demenz eher durch leichte gedächtnis- und
orientierungsschwierigkeiten geprägt ist, stellt sich in ihrem verlauf häufig unruhe
oder eine veränderung des wesens ein. stimmungsschwankungen können bei alzheimer auftre-
ten, es kann zu übertriebenem misstrauen, zu zornesausbrüchen oder auch zu de-
pressionen kommen. deshalb gilt: um diesen unterschiedlichen phasen gerecht zu
werden, ist es wichtig, die medikamentöse behandlung kontinuierlich durch den
behandelnden arzt kontrollieren und anpassen zu lassen. auch die angehörigen sind
gefragt, wenn es darum geht, die regelmäßige einnahme der medikamente im blick
zu behalten.

die basistherapie der alzheimer-demenz sieht derzeit drei arten von wirkstoffen
vor: antidementiva, neuroleptika und antidepressiva. darüber hinaus können hirn-
leistungsfördernde wirkstoffe wie ginkgo zum einsatz kommen. neue medikamente
sind in der entwicklung.

1. antidementiva

antidementiva werden gegen die hauptsymptome der alzheimer-krankheit einge-
setzt. sie sollen kognitiven einbußen entgegenwirken und eine verzögerung des
krankheitsverlaufs bewirken. in deutschland sind derzeit vier wirkstoffe zur thera-
pie der alzheimer-krankheit zugelassen. memantine (u.a. axura®, ebixa®) ist ein
glutamat-rezeptorantagonist und wird für späte und mittlere alzheimer-krankheit
eingesetzt. alle medikamente sind verschreibungspflichtig. sie liegen in tabletten-
form vor, rivastigmin gibt es darüber hinaus auch als pflaster. mittlerweile sind auch
erste generika auf dem markt.

glutamat-antagonist

der botenstoff glutamat ist unverzichtbar für lernen und gedächtnis alzheimer erkrankten. die nervenzel-
len von alzheimer-patienten werden jedoch durch zu viel glutamat belastet und
können dadurch absterben. der glutamat-antagonist schützt nervenzellen vor dem
übermäßigen einstrom von glutamat. die krankheit im mittleren bis späten stadium
können lernfähigkeit und gedächtnisleistungen des alzheimer patienten so länger aufrechterhalten werden.
bei patienten mit leichter kognitiver beeinträchtigung wird keine wirkung beobachtet
und daher von einer behandlung abgeraten. bei alzheimer eingesetzt wird der wirk-
stoff memantin, welcher ebenfalls unter verschiedenen namen gehandelt wird. als
nebenwirkungen können unruhe, schlafstörungen oder kopfschmerzen auftreten.

2. neuroleptika

neuroleptika werden gegen begleitsymptome der späten alzheimer-krankheit ein-
gesetzt. sie haben eine beruhigende und antipsychotische wirkung. bei menschen
mit spätem alzheimer finden sie anwendung bei problematischen verhaltensweisen.
dazu können zum beispiel wahnvorstellungen, aggressivität oder auch schlafstö-
rungen zählen. der einsatz von neuroleptika ist nicht zuletzt aufgrund der neben-
wirkungen umstritten und sollte sich immer am tatsächlichen nutzen für den patien-
ten und sein direktes umfeld orientieren. da beim fortschreiten der alzheimer-
krankheit die behandelten symptome wieder abklingen können, muss regelmäßig
kontrolliert werden, ob eine einnahme noch erforderlich ist.

3.2 die nicht-medikamentöse behandlung des späte alzheimer

nicht-medikamentöse therapien können helfen, die teilnahme der patienten am
gesellschaftlichen leben so lange wie möglich aufrechtzuerhalten, positive auswir-
kungen auf die gemütslage sind ebenfalls dokumentiert. die behandlung wird je
nach symptomatik und grad der alzheimer erkrankung durch geschulte therapeuten einge-
setzt.

bei den emotionsorientierten therapieansätzen wie der validation stehen die die
wertschätzung der gefühle und der erlebenswelt des alzheimer patienten sowie die mobilisie-
rung noch vorhandener ressourcen im mittelpunkt. die kommunikation bezieht sich
weniger auf die faktenerinnerung, sondern zunehmend auf die subjektive erinne-
rung, sichtweise und wahrnehmung des patienten. auch die umgebung spielt hier
eine rolle, so wird zunehmend die herkunft der alzheimer patienten bei der gestaltung der
räumlichkeiten und aktivitäten berücksichtigt. sinnes- und bewegungsbezogene
ansätze zielen mit hilfe der multisensorischen stimulation sowohl auf veränderun-
gen im verhalten, in der interaktion und kommunikation mit anderen, sowie im er-
leben der alzheimer betroffenen ab.

der schlaf-wach-rhythmus kann durch eine strukturierte soziale aktivierung und
familienähnliche esssituationen verbessert werden.

einen besonderen stellenwert nimmt das training des alzheimer pflegepersonals und der
pflegenden angehörigen ein. das verständnis für die defizite von demenzpatienten
soll hier ebenso geschult werden wie das fördern noch vorhandener ressourcen
und die verbesserung kommunikativer fähigkeiten seitens der alzheimer patienten. durch an-
gehörigentraining scheint sich die unterbringung von demenz-patienten in einem
pflegeheim deutlich herauszögern zu lassen. in diesem rahmen werden auch ein-
zel- und gruppengespräche eingesetzt, in denen der informations- und erfahrungs-
austausch im vordergrund stehen.
realitäts-orientierungs-training: realitäts-orientierungs-training ist für früh bis
spät alzheimer studium und unterstützt die räumliche und zeitliche orientierung der patien-
ten. den patienten werden aktiv informationen zu zeit und ort angeboten, jedoch
ohne sie zu überfordern.

musiktherapie: gemeinsames musizieren, singen und tanzen gehören in diese ka-
tegorie. positive effekte der behandlung der musiktherapie sind auch in späteren
stadien der alzheimer-krankheit spürbar, da sich deren wirkung auf emotionaler
ebene abspielt.

tiergestützte therapie: hier kommen ausgebildete kleintiere, aber auch hunde
oder schweine zum einsatz. der kontakt mit tieren soll alzheimer patienten aktivieren und
die soziale interaktion fördern, selbst wenn keine verbale kommunikation mehr
möglich ist. tiergestützte therapie ist auch in späteren stadien nützlich.

snoezelen und aromatherapie: snoezelen (aus dem niederländischen, sprich:
„snuselen“) bezeichnet eine reihe von aktivitäten auf der sensorischen ebene. da-
bei kommen licht, klang, berührung, geschmack oder duft zum einsatz. möglich
ist. tiergestützte therapie ist auch in späteren stadien nützlich. snoezelen und
aromatherapie ist für spät, früh und mittler studium geeignet und hat zumindest
geringe positive effekte auf allgemeine verhaltenssymptome der alzheimer patienten.

4 tipps für pfleger
hilfe ist gefragt – das spätstadium

die alzheimer-erkrankung im spätstudium sind die erkrankten vollständig von be-
treuung und pflege abhängig. gedächtnis des späten alzheimer kranken ist nicht mehr in der
lage, neue informationen zu speichern. auch nahe angehörige von patienten im
Alzheimer spätstudium werden nun oft nicht mehr erkannt. die sprache von patienten im
spätstudium ist auf wenige wörter reduziert.

unruhe, depressionen, ängste und wahnvorstellungen treten in später alzheimer phase nicht
mehr auf. zunehmend verlieren die erkrankten jedoch die kontrolle über ihren
körper. viele patienten im spätstudium können nur noch in kleinen, schleppenden
schritten, häufig aber auch gar nicht mehr gehen. sie bewegen sich nur noch auf
aufforderung, nicht mehr aus eigenem antrieb. selbst die fähigkeit, aufrecht zu
sitzen, kann bei alzheimer verloren gehen. die mimik ist eingeschränkt. schlucken wird unmög-
lich. blase und darm können nicht mehr von patienten im spätstudium kontrolliert
werden. unter umständen treten krampfanfälle auf. die patienten im spätstudium von alzheimer
sind teilnahmslos und nehmen ihre umgebung ebenso wie sich selbst kaum noch
wahr.

menschen, die alzheimer-patienten im spätstudium pflegen, sind auch einem
enormen druck ausgesetzt und tragen große verantwortung. die arbeit, die sie
leisten, ist körperlich wie seelisch aufreibend. wenn die krankheit fortschreitet,
müssen sich pflegeleistende dem ständigen wechsel anpassen, den die patienten
krankheitsbedingt durchlaufen. im gleichen maße müssen sie eigene fähigkeiten
angleichen, die für die pflege notwendig sind.

4.1 kommunikation

wenn die spät alzheimer-krankheit fortschreitet, kann der patient nicht klar ver-
stehen, was um ihn herum passiert oder was von ihm verlangt wird. das ist ein
schwieriges problem - sowohl für späte patienten als auch für pflegende angehöri-
ge. einige kommunikationstechniken können helfen:

        •    sprechen sie den späten alzheimer patienten direkt an, sehen sie ihn an, um si-
cherzustellen, dass er sie gehört hat.

        •    sprechen sie langsam und mit ruhiger stimme.

        •    benutzen sie kurze sätze mit jeweils einer einzigen aussage. anstatt den
Alzheimer patienten zu fragen, was er möchte, nutzen sie feststellende sätze wie „es ist nun
zeit zu essen.“

        •    versuchen sie nicht, themen zu diskutieren, an die sich der patient
nicht mehr erinnern kann. ermutigen sie zu gesprächen über vertraute dinge und
zeiten.

        •    vermeiden sie ironische bemerkungen und bildhafte, missverständliche
redewendungen wie „grüner daumen“.

        •    schalten sie störungen wie radio oder fernseher aus, während sie
 mit dem alzheimer sprechen. es kann für den patienten schwierig sein, die geräuschquellen auseinander
zu halten.

4.2 tägliche pflege

hin und wieder kann sich ihr spät alzheimer patient weigern zu baden. der grund dafür kann
sein, dass baden für ihn zu kompliziert geworden ist, dass der spät patient angst
vor dem wasser bekommt, oder dass schamgefühle aufkommen. auch probleme
mit dem sehen machen es schwierig, die umrisse der dusche oder wanne zu unter-
scheiden. der betroffene kann vergessen haben, wie die wasserhähne funktionie-
ren oder er kann sich nicht mehr erinnern, was er mit seife und waschlappen an-
fangen soll. das fortschreiten der alzheimer-krankheit zieht auch die koordination
in mitleidenschaft, was zusätzlich zu sicherheitsrisiken führt.

       •   vermeiden sie es mit dem späten alzheimer patienten darüber zu diskutieren, ob
ein bad nötig ist oder nicht. sagen sie einfach „es ist badezeit“. noch effektiver
kann dies sein, wenn sie zu einer festgelegten, regelmäßigen zeit und an einem
bestimmten platz das bad ankündigen.

       •   denken sie daran, den schlüssel aus der badezimmertür und rasierer
sowie elektrische geräte wie fön oder lockenstab aus den schränken zu entfer-
nen.

hier einige tipps, die helfen können, die badezeit problemloser zu gestalten:

       •   halten sie alles griffbereit, bevor sie beginnen. das verhindert unter-
brechungen.

       •   stellen sie sicher, dass der raum warm genug ist.

       •   füllen sie die wanne nur wenige handbreit mit wasser. prüfen sie die
temperatur des wassers.

       •   vermeiden sie badeöle oder andere zusatzstoffe, die die wanne rutschig
machen.

       •   teilen sie den badevorgang in einzelne schritte auf. versuchen sie es
zum beispiel so: „hier ist der waschlappen. wasch’ deinen arm.“

       •   seien sie ruhig und freundlich, aber bestimmt. vermeiden sie ablenkun-
gen oder diskussionen. es ist das beste, die aufmerksamkeit immer auf die aktuelle
aufgabe zu richten.

       •   hetzen sie nie.
       •     schauen sie nach hautausschlägen oder wunden stellen.

       •     legen sie ein handtuch über die schultern des badenden, es vermittelt
ihm ein warmes gefühl und privatsphäre.
       •     seien sie flexibel. wenn ihr angehöriger sich weigert, in die wanne zu
steigen, waschen sie ihn mit schwamm und badeschüssel im schlafzimmer.

4.3 ankleiden

patienten im alzheimer spätstudium sollten ermutigt werden sich selbst anzukleiden, so lange
sie dazu in der lage sind. dabei sollte man berücksichtigen, welche gewohnheiten
der späten patient in der vergangenheit hatte. routine funktioniert meist am bes-
ten bei alltäglichen aktivitäten. hier einige vorschläge, die die unabhängigkeit ih-
Res alzheimer späten patienten erhöhen können:

   • legen/hängen sie alle kleidungsstücke in der reihenfolge zurecht, in der sie
angezogen werden sollen.

      •     kennzeichnen sie schubladen und kommoden mit kleidung. sie können
zum beispiel bilder aus zeitschriften verwenden.

      •     fragen sie nicht, welche kleidung ihr patient bevorzugt.

      •     entfernen sie selten getragene kleidungsstücke, um die auswahl zu be-
grenzen.

      •     hetzen sie den patienten nie.

      •     nutzen sie einfache kleidungsstücke. klettband kann viele verschlüsse
ersetzen.

      •     strickjacken sind einfacher anzuziehen als pullover. auch jogging-anzü-
ge sind bequem und gleichzeitig modisch.

      •     legen sie bürsten und kämme übersichtlich hin.

      •     kleidung kann zu einem risiko werden, wenn sie nicht richtig passt.
stellen sie sicher, dass die kleidungsstücke, die getragen werden, ihren patienten
nicht behindern.

4.4 essenszeit

mahlzeiten können der höhepunkt des tages im leben eines späten alzheimer-pati-
enten sein. sie können die freude darüber erhöhen, indem sie eine regelmäßige
routine etablieren, störungen auf ein minimum beschränken und geschirr bereit-
stellen, das die einschränkungen des patienten berücksichtigt. hier einige strate-
gien, die helfen können:



      •    servieren sie jeweils nur ein essen, damit ihr alzheimer-patient nicht
entscheiden muss, was er zuerst essen will.

      •    benutzen sie einen tiefen teller oder eine schüssel, um kleckern zu ver-
hindern.

      •    um die frustration zu minimieren, schneiden sie das essen in mundge-
rechte stücke.

      •    hat ihr alzheimer-patient vergessen, wie man eine gabel benutzt? zu
beobachten, wie sie die technik demonstrieren, kann ihm diese fertigkeit zurück-
bringen. wenn nicht, bieten sie dem patienten einen löffel an oder erwägen sie,
ihm nahrhaftes finger food (häppchen, die er mit den fingern essen kann) anzu-
bieten.

      •    ein kleinerer löffel ermöglicht es ihm, kleinere bissen zu nehmen und
verhindert, dass er zu viel hinunterwürgt oder sich verschluckt.

      •    eine vorgebundene serviette und eine tischdecke aus plastik erleichtern
das reinigen.

      •    vermeiden sie sehr heiße speisen, um das risiko des verbrühens zu ver-
hindern.

andere mögliche probleme: manche alzheimer-patienten vergessen, dass sie gera-
de eben gegessen haben und verlangen nach essen. dies werden sie durch einen
fixen ablaufplan in den griff bekommen. argumentieren sie nicht – finden sie
stattdessen eine ablenkung. zum beispiel die, dass sie ihren alzheimer patienten bitten, zu-
nächst gemeinsam mit ihnen eine arbeit fertig zu machen. die aktivität wird die
aufmerksamkeit vom essen ablenken.

was ist mit den alzheimer patienten, die über den kühlschrank herfallen? sie sollten diesen
abschließen, vor allem, wenn er nahrungsmittel enthält, die aus medizinischen
gründen verboten sind. vielleicht finden sie auch einen anderen platz, um be-
stimmte nahrungsmittel zu verstauen – zum beispiel einen kleinen kühlschrank im
keller. versuchen sie gesunde snacks bereitzuhalten.

teilweise essen die alzheimer patienten auch zu wenig, sie haben das hungergefühl verloren.
bereiten sie die lieblingsspeisen des patienten zu. falls probleme mit dem schlu-
cken auftreten sind weiche oder pürierte speisen leichter zu essen. erinnern sie zu
festgelegten zeiten an das essen. stellen sie teller mit kleinen häppchen auf, die
der alzheimer patient gerne isst und auf die er jederzeit zugreifen kann.

erinnern sie den patienten daran, regelmäßig zu trinken. süße fruchtsäfte oder
limonaden können kalorien zuführen und werden oft lieber getrunken als wasser.

4.5 schlafprobleme

wenn die alzheimer-krankheit fortschreitet, wird der patient im von mittler bis
spätstudium möglicherweise ein verändertes schlafverhalten entwickeln. ruhe-
und schlaflosigkeit in der nacht sind nicht ungewöhnlich und können für pflegeper-
sonen stressig sein, wenn dies zu dem wanderverhalten führt, das weiter unten auf
dieser seite beschrieben wird. einige tipps, die schlafprobleme von alzheimer kranken verkleinern, sind:

        •   verhindern sie nickerchen am tage, wenn der patient nachts nicht
durchschläft.

        •   nutzen sie dessen überschüssige energien für ein paar tägliche übungen.

        •   fragen sie den arzt des patienten, ob die medikamente, die er be-
kommt, eventuell schlaflosigkeit verursachen können.

        •   vermeiden sie nach möglichkeit koffein in jeder form.

        •   stellen sie sicher, dass ihr patient auf der toilette war, bevor er ins bett
geht.

        •   versuchen sie eine feste zeit und normale routine für das zubettgehen
einzuhalten.

4.6 toilettengang

manchmal haben alzheimer-patienten im spätstudium schwierigkeiten, rechtzeitig
zur toilette zu kommen. durch eine körperliche untersuchung kann ein arzt fest-
stellen, ob ein medizinisches problem vorliegt.

handelt es sich nicht um ein medizinisches problem, werden die „unfälle“ durch
die verwirrung hervorgerufen, die mit der alzheimer-krankheit einhergeht. patien-
ten können probleme haben, sich daran zu erinnern, was zu tun ist, wenn der
harndrang auftritt. manche patienten haben schwierigkeiten sich zu erinnern, wo
das badezimmer ist oder denken nicht rechtzeitig daran dort hinzugehen. folgen-
des kann bei alzheimer patienten helfen:

      •      führen sie einen regelmäßigen zeitplan für die toilettengänge des pati-
enten ein.

      •      beginnen sie im zweistunden-intervall mit einem ersten gang am mor-
gen. planen sie zusätzlich einen gang nach jedem nickerchen ein. passen sie die
intervalle so an, wie es notwendig ist.

      •      bringen sie nachtlichter im schlafzimmer, korridor und badezimmer an.

      •      streichen sie die badezimmertür in leuchtender farbe oder bringen sie
ein motiv als blickfang auf ihr an.

      •      versuchen sie es mit sicheren bettauflagen für erwachsene (in sanitäts-
häusern erhältlich, auch professionelles pflegepersonal kann ihnen helfen, diese
produkte auszuwählen).

      •      ab einem gewissen punkt im verlauf der erkrankung ihres patienten
werden sie den einsatz von erwachsenenwindeln einplanen müssen.

4.7 verletzendes verhalten

wenn die krankheit voranschreitet, treten veränderungen im gehirn und im körper
auf. zeitweilig werden alzheimer-patienten von verwirrung überwältigt und sind
dann extrem aufgebracht. oftmals treten verhaltensprobleme am abend auf. viel-
leicht hat die verwirrung, die der patient durchleidet oder eine bedrohlich er-
scheinende umwelt, die er den ganzen tag hindurch erleben musste, ihn müde
gemacht und negative gefühle an die oberfläche befördert. wenn ihr alzheimer patient ver-
letzend reagiert:

      •   bleiben sie gelassen und führen sie den patienten ruhig aus der aufge-
regten situation.

      •   erinnern sie sich daran, dass anfeindungen aus der frustration über ein-
schränkungen, dem unverständnis über das, was in der umgebung vor sich geht
oder einfach aus dem vergessen des angemessenen verhaltens resultieren können.

      •   versuchen sie festzustellen, was diese reaktion verursacht. gibt es ein
muster?

      •   vermeiden sie diskussionen oder beweisführung und bieten sie ein
freundliches wort oder eine nette berührung.

      •   suchen sie den arzt ihres patienten auf. reizbarkeit und feindseligkeit
können direkt aus einigen körperlichen beschwerden resultieren, die der patient
nicht beschreiben kann.





					</p>
                </div>

                <!-- second nested column -->
                <div class="col-md-12">
                    <!-- column content -->
                    <button type="button" id="berechnen">GetKeywords</button>
					<button type="button" id="berechnen2">GetKeywords_New_Version</button>
                    <button type="button" id="cbr">CBR Auswertung</button>

                </div>

                <!-- third nested column -->
                <div class="col-md-12">
                    <label>
                        <output id="output-textarea"></output>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>
                        <output id="CBRtestfeld"></output>
                    </label>
                </div>
                
                       </form>
        </div>
		<div><b>Keywords from Database:</b></div>
        <div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="pastHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="cbrhint" style="display:none"><b>CaseBase Data will be displayed here</b></div>

		<br> <br>
		<div><b>Keywords found in Text</b></div>
		<div id="txtKeywords"><b></b></div>
		<br> <br>
        <!--____________________________________________________________________________________________________-->
		 <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?> 
        <form action="php/include/login_process.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <p>If you don't have a login, please <a href="php/register.php">register</a></p>
        <p>If you are done, please <a href="php/include/logout.php">log out</a>.</p>
        <p>You are currently logged <?php echo $logged ?>.</p>

		<br>
		<form action="php/include/AddCase.php"
				method="post" 
				name="addCase_form">
            Name der Krankheit: <input type='text' 
                name='krankheit' 
                id='krankheit' /><br>
			Beschreibung: <input type='text' 
                name='beschreibung' 
                id='beschreibung' /><br>	
            <input type="button" 
                   value="addCase" 
                   onclick="return AddCase_Check(addCase_form);" /> 
        </form>

        <!-- Scripts -->
        <!--<script src="js/german-porter-stemmer.js"></script>-->
		<script src="js/snowball-german.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
		<script src="js/CBR.js"></script>
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
		

    </body>

</html>
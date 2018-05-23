class Weighted_Words {
    constructor(word, weight, katID) {
        this.word = word;
        this.weight = weight;
        this.katID = katID;
    }
};


class KeywordList {
    constructor(word, katID) {
        this.word = word;
        this.katID = katID;
    }
};

function getKeywordsFromDatabase(database)
{
    if (database === "") {
        $("#txtHint").html("Verbindung  konnte nicht aufgebaut werden");
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#txtHint").text(this.responseText);
            }
        };
        xmlhttp.open("GET","http://141.99.248.92/Projektgruppe/getKeywords.php",true);
        xmlhttp.send();
    }
}

function isNegate(word){
    var array_negate_words = new Array("nicht","kein","keine","keinem","keinen","keiner","keines", "nichts","nie");
    for(var i =0; i < array_negate_words.length; i++)
        {
            if(word === array_negate_words[i])
                return true;
            
        }
    return false;
    
}

function negateSentence (array, sentenceNumber){
    for(var i=0; i < array[sentenceNumber].length; i++)
        {
            array[sentenceNumber][i].weight = -1
        }
}

function createFinalKeywordsArray(array)
{
    //TODO use correct keywords from DB
    //var string_keywords = ("Bewusstsein,1;Bewusstheit,1;Besinnung,1;Hinwendung,2;Richtung,2;Orientierung,2;Ausrichtung,2;Geist,3;Gehirn,3;geistig,3;Intellektueller,3;intellektuell,3;gebildet,3;Lebensantrieb,4;motivier,4;Lust,4;Motivation,4;Aufmerksam,5;Achtung,5;anwesend,5;abwesend,5;vergessen,6;vergesslich,6;Gedächtnis,6;Erinnerung,6;konzentrier,7;psychomotrie,7;emotion,7;konzentration,7;emotional,8;gefühlvoll,8;Gefühlszustand,8;Wahrnehmung,9;wahrnehmen,9;merke,9;Gedächtnisleistung,10;Erinnerungsvermögen,10;denk,10;überleg,10;erkenn,11;erfahren,11;Erkennungsfähigkeit,11;reden,12;redet,12;sprech,12;sprach,12;Sprachgewantheit,12;rechne,13;Mathe,13;zähle,13;Kombination,14;Bewegung,14;Kombinatorik,14;Selbstbewusstsein,15;persönlich,15;zeit,15;Sehleistung,16;sehe,16;Sehhilfe,16;Auge,17;Hörgerät,18;höre,18;Hörleistung,18;balance,19;Gleichgewichtsstörung,19;Gleichgewicht,19;Schwindel,20;selbstwahr,21;Reizwahrnehmung,21;empfindlich,22;Gefühl,22;tasten,22;Berührung,22;Sprechen,23;artikulation,23;Ausdruck,23;ausdrück,23;Redefluss,24;rede,24;Herz,25;Vene,26;Ader,26;Blutgefäß,26;Blutdruck,27;Hämatologikum,28;Immunsystem,29;Immunkompetenz,29;atme,30;schnarch,30;Atmung,30;Stuhlgang,31;Stuhlentleerung,31;Darmentleerung,31;Defäkation,31;Kotabsatz,31;Stoffwechsel,32;Verdau,32;Wasser-Elektrolyt-Haushalt,33;Hormonstörung,34;toilette,35;Blasenentleerung,35;Muskel,36;Durchhaltevermögen,37;Ausdauer,37;Reflex,38;reaktion,38;reagiert,38;zucken,39;Zuckung,39;zucken,40;zuckung,40;Willkürbewegungen,40;Willkürbewegungen,41;zucken,41;zuckung,41;gehen,42;Gangbild,42;Gangmuster,42;Auffälligkeiten,43;Gehirn,44;Gehirnstruktur,44;Herzkranzgefäße,45;Blutgefäß,45;Blutkreislauf,45;nachmachen,46;kopieren,46;trainieren,47;üben,47;proben,47;Konzentration,48;aufmerksamkeit,48;konzentrier,48;denk,49;überlegen,49;lesen,50;schreiben,51;notieren,51;rechnen,52;mathe,52;Problem,53;Problembewältigung,53;entscheidung,54;Entscheiden,54;eigenständig,55;Aufgabe,55;eigenständig,56;Aufgabe,56;Routine,57;Tagesablauf,57;versteh,58;Gespräch,58;Kommunikation,58;Mimik,59;Gestik,59;Kommunikation,59;Nachricht,60;lesen,60;Kommunikation,60;Sprach,61;rede,61;spreche,61;Kommunikation,62;Gestik,62;Nachricht,63;schreiben,63;Konversation,64;Diskutier,64;Telefon,65;Handy,65;PC,65;Computer,65;Beweglichkeit,66;Bewegung,66;bewegen,66;Körperhaltung,67;Fingerfertig,68;Gehen,69;Spazieren,69;Reise,70;Besuch,70;Fahrrad,71;Fahren,71;Auto,71;waschen,72;sauber,72;hygiene,73;pflege,73;Toilette,74;WC,74;klo,74;kleidung,75;Anziehen,75;ankleiden,75;essen,76;ernähre,76;hunger,76;kaue,76;schluck,77;trink,77;einkauf,78;shoppen,78;einkaufen,79;mahlzeit,79;zubereiten,79;kochen,79;wäsche,80;Haushalt,80;saugen,80;aufräumen,81;Haushalt,81;helfen,82;Hilfsbereitschaft,82;hilfe,82;Zwischenmenschlichkeit,83;Zwischenmenschlichkeit,84;Information,85;Beziehung,85;Sohn,86;Tocher,86;Familie,86;Partner,86;Beziehung,87;Liebe,87;Liebschaften,87;Gemeinschaft,88;Gemeinschaftsleben,88;Gruppe,88;Freizeit,89;Urlaub,89;Hobby,89;Konsum,90;Alltagsgegenstände,91;Mobilität,92;Kommunikation,93;Euro,94;Vermögen,94;Geld,94;Klima,95;warm,95;kalt,95;Licht,96;hell,96;dunkel,96;dämmerung,96;zeit,97;uhr,97;Veränderung,97;Tochter,98;Sohn,98;Familie,98;Partner,98;Verwandte,99;Enkel,99;Freund,100;Bekanntschaften,101;Kollege,101;Nachbar,101;Polizist,102;Gesetz,102;Priester,102;Autorität,102;Pastor,102;Arzt,102;Assistenten,103;Helfer,103;Caritas,103;Pfleger,103;Krankenschwester,104;Krankenpfleger,104;Pfleger,104;Pflegerin,104;Arzt,104;Familie,105;Sohn,105;Tochter,105;Partner,105;Freunde,106;Freund,106;Kollege,107;Nachbar,107;Bekannte,107;Pfleger,108;Pflegerin,108;Arzt,109;Krankenschwester,109;Krankenpfleger,109;Gesellschaft,110");

    

    var string_keywords = $("#txtHint").text();
    
    //String bei jedem ; splitten und in array packen
    var array_erste_Stufe = string_keywords.split(';');
    
    //Erste Stufe jeden eintrag bei , splitten und in neuen array packen
    var array_zweite_Stufe = new Array();
    for(var i =0; i <array_erste_Stufe.length-1; i++)
    {
        array_zweite_Stufe.push(array_erste_Stufe[i].split(',')); 
    }
    
   
    //Zweite Stufe als Klassen erstellen und in array_keywords speichern
    var array_keywords = new Array();
    for(var i =0; i < array_zweite_Stufe.length; i++)
    {
        array_keywords.push(new KeywordList(array_zweite_Stufe[i][0], array_zweite_Stufe[i][1]));
    }
   
  


    var final_array = new Array();
    for(var i =0; i < array.length; i++)
        {
            for(var j =0; j < array[i].length; j++)
            {
               for(var k = 0; k < array_keywords.length; k++)
                   {
                       if(array[i][j].word.toLowerCase() === array_keywords[k].word.toLowerCase())
                           {
                               
                               final_array.push(new Weighted_Words(array[i][j].word, array[i][j].weight, array_keywords[k].katID));
                           }
                   }
            }
        }
        
    return final_array;
    
    

}

$(document).ready(function () { getKeywordsFromDatabase("cbr"); });

$("#berechnen").click(function() {
    //TODO DELETE IN FINAL
    console.time('test');
    //get text from textarea
    var inputText = $("#input-textarea").text();
    //remove unnecessary whitespace and write everything in lower case
    inputText = inputText.trim();
    //Delete abbrevations consist of maximum 3 letters
    //TODO Error bei words like 'ist' at the end of a sentence
    //inputText = inputText.replace(/[\s][a-zA-Z]{0,3}[.]/gm, "");

    //Remove stopwords
    inputText = inputText.removeStopWords();

    //Split text in sentences
    var sentence_array = inputText.replace(/([.!?,;])\s*(?=[a-zA-Z])/gm, "$1|").split("|");

    //stemm sentences and remove punctuations
    var test_array = [];
    sentence_array.forEach(function(element) {
        element = element.replace(/[.!?:;,]/gm, "");
        test_array.push(stemm(element));
    })


    //split sentences in words add standrad weight 0 ... twodimensional arrays
    //Array [sentence][word, weight]
    var words_in_sentences_with_weight_array = new Array(test_array.length);
    for (var i = 0; i < words_in_sentences_with_weight_array.length; i++) {
        words_in_sentences_with_weight_array[i] = test_array[i].split(" ");
        for (var j = 0; j < words_in_sentences_with_weight_array[i].length; j++) {
            words_in_sentences_with_weight_array[i][j] = new Weighted_Words(words_in_sentences_with_weight_array[i][j], 0, 0);
            
        }
        
        
    }
    
    
    
    //negate whole sentence if sentence is negated
    for (var i = 0; i < words_in_sentences_with_weight_array.length; i++) {
        
        for (var j = 0; j < words_in_sentences_with_weight_array[i].length; j++) {
            if(isNegate(words_in_sentences_with_weight_array[i][j].word))
                {
                    negateSentence(words_in_sentences_with_weight_array, i);
                    //words_in_sentences_with_weight_array[i][j].weight = -1;
                }
        }
        
        
    }
    
    //delete words from array, if they are not keywords used by CBR
    var final_array = createFinalKeywordsArray(words_in_sentences_with_weight_array);

    ///////TESTAUSGABE
    var output = "";
    for (var i = 0; i < final_array.length; i++) {
            output = output + "<br>" +i+ " || "+final_array[i].word+"  "+ final_array[i].weight + " "+final_array[i].katID;
        
    }

    $("#output-textarea").html(output);
    //TODO DELETE IN FINAL
    console.timeEnd('test');


    // fertig getestet
    // lalala 

});
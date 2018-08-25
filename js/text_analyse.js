// Global Array for Textanalysis
var final_Weight = new Array(); // all found keywords
var absolute_final_array = new Array(); // all available categories to which the weight of the individual keywords is added up

var string_keywordsTEXTFROMDB = "";
var string_keywordsPASTFROMDB = "";

//-------Calculation Values-----
var weight_base = 1;
//Past
var weight_past = 1;
var weight_past_reinforced = 2;
var weight_past_negate = 0.25;
var weight_past_negate_reinforced = 0.5;
//Present
var weight_present = 0.25;
var weight_present_negate = 1;
var weight_present_reinforced = 0.125;
var weight_present_negate_reinforced = 2;
//weight for the magic formula
var weight_highest = 2;

//assumed text length
var basic_text_length = 400;
var text_length = 0;

//Classes
class Weighted_Words
{
    constructor( word, weight, katID, katName )
    {
        this.word = word;
        this.weight = weight;
        this.katID = katID;
        this.katName = katName;
    }
}

//Final weight for CBR
class Final_Weight
{
    constructor( katID, weight, katName )
    {
        this.weight = weight;
        this.katID = katID;
        this.katName = katName;
        this.count = 0;
    }
}

class KeywordList
{
    constructor( word, katID, katName )
    {
        this.word = word;
        this.katID = katID;
        this.katName = katName;
    }
}

//Call functions on Page load
$( document ).ready( function ()
{
    //get Keywords and store them in hidden fields
    getKeywordsFromDatabase( "cbr" );
    getKeywordsFromDatabase_Past( "cbr" );
} );

//get all Keywords from DB and save them in #txtHint
//Method is called on page load
function getKeywordsFromDatabase( database )
{
    if ( database === "" )
    {
        $( "#txtHint" ).html( "Verbindung konnte nicht aufgebaut werden" );
        return;
    } else
    {
        if ( window.XMLHttpRequest )
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
        }
        xmlhttp.onreadystatechange = function ()
        {
            if ( this.readyState === 4 && this.status === 200 )
            {
                $( "#txtHint" ).text( this.responseText );
                string_keywordsTEXTFROMDB = this.responseText;
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getKeywords.php", false );
        xmlhttp.send();
    }
}

//Get verbs in past tense from DB and write them into "pastHint"
function getKeywordsFromDatabase_Past( database )
{
    if ( database === "" )
    {
        $( "#pastHint" ).html( "Verbindung konnte nicht aufgebaut werden" );
        return;
    } else
    {
        if ( window.XMLHttpRequest )
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
        }
        xmlhttp.onreadystatechange = function ()
        {
            if ( this.readyState === 4 && this.status === 200 )
            {
                $( "#pastHint" ).text( this.responseText );
                string_keywordsFROMDB = this.responseText;
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getKeywordsPast.php", true );
        xmlhttp.send();
    }
}

//Compare words in two given arrays depending on the start position
function checkWordsAroundGivenWord( arrayWhichContainsGivenWord, wordPosition, arrayWhichContainsWordsToCheck )
{
    //-------------First Word------------------------------
    for ( var z = 0; z < arrayWhichContainsWordsToCheck.length; z++ )
    {
        if ( wordPosition === 0 )
        {
            if ( arrayWhichContainsGivenWord.length >= wordPosition + 3 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 3] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 2 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 1 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
        }
        //---------------------------------------------------------------------

        //-------------Second Word------------------------------
        else if ( wordPosition === 1 )
        {
            if ( arrayWhichContainsGivenWord.length >= wordPosition + 3 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 3] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 2 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 1 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
        }
        //---------------------------------------------------------------------

        //-------------Third Word------------------------------
        else if ( wordPosition === 2 )
        {
            if ( arrayWhichContainsGivenWord.length >= wordPosition + 3 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 3] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 2 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 1 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
        }
        //---------------------------------------------------------------------

        //-------------All after third Word------------------------------
        else
        {
            if ( arrayWhichContainsGivenWord.length >= wordPosition + 3 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 3] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 3] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 2 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 3] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 2] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length >= wordPosition + 1 )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 3] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition + 1] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
            else if ( arrayWhichContainsGivenWord.length === wordPosition )
            {
                if ( arrayWhichContainsGivenWord[wordPosition - 3] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 2] === arrayWhichContainsWordsToCheck[z]
                    || arrayWhichContainsGivenWord[wordPosition - 1] === arrayWhichContainsWordsToCheck[z] )
                {
                    return true;
                }
            }
        }
        //---------------------------------------------------------------------
    }
    return false;
}

//get Keywords from #txtHint.
//Split them and put into array which is returned
function createKeywords()
{
    var i = 0;
    var string_keywords = $( "#txtHint" ).text();
    string_keywords = string_keywordsTEXTFROMDB;

    //String bei jedem ; splitten und in array packen
    var array_erste_Stufe = string_keywords.split( ';' );

    //Erste Stufe jeden eintrag bei , splitten und in neuen array packen
    var array_zweite_Stufe = new Array();
    for ( i = 0; i < array_erste_Stufe.length - 1; i++ )
    {
        array_zweite_Stufe.push( array_erste_Stufe[i].split( ',' ) );
    }

    //Zweite Stufe als Klassen erstellen und in array_keywords speichern
    var array_keywords = new Array();
    for ( i = 0; i < array_zweite_Stufe.length; i++ )
    {
        array_keywords.push( new KeywordList( array_zweite_Stufe[i][0].toLowerCase(), array_zweite_Stufe[i][1], array_zweite_Stufe[i][2] ) );
    }

    return array_keywords;
}

//split verbs into arrays from "pastHint"
function createKeywordsArray_Past()
{
    var i = 0;
    var string_keywords = $( "#pastHint" ).text();
    string_keywords = string_keywordsPASTFROMDB;
    //String bei jedem ; splitten und in array packen
    var array_erste_Stufe = string_keywords.split( ';' );

    array_erste_Stufe.pop();

    return array_erste_Stufe;
}

function extractKeywords( inputText )
{
    var i = 0;
    var j = 0;
    var k = 0;
    var z = 0;

    //get Keywords and Past words
    var keyWords = createKeywords();
    var pastWords = createKeywordsArray_Past();

    var negateWords = new Array( "nicht", "kein", "keine", "keinem", "keinen", "keiner", "keines", "nichts", "nie" );
    var reinforing_words = new Array( "absolut", "äußerst", "ausgesprochen", "besonders", "extrem", "heftig", "höchst", "sehr", "total", "überaus", "ungemein", "ungewöhnlich", "ohne probleme" );

    console.time( "test2" );

    //remove unnecessary whitespace and write everything in lower case
    inputText = inputText.trim();

    text_length_array = inputText.split( /\s/ );
    text_length = text_length_array.length;

    //Delete abbrevations consist of maximum 1 letters, multiple whitespaces, and new lines starting with a space
    inputText = inputText.replace( /[\s][a-zA-Z]{0,1}[.]/gm, "" ).replace( /[\s]{2,}/gmi, "\s" ).replace( /\n /gmi, "\n" ).replace( /[0-9]/, "\s" );

    //Remove stopwords
    inputText = inputText.removeStopWords();

    //Split text in sentences
    var sentence_array = inputText.replace( /([.!?;])\s*(?=[a-zA-Z])/gm, "$1|" ).split( "|" );

    //array for sentences
    var words_in_sentences_array = new Array( sentence_array.length );

    //Split sentence at whitespace to get words
    for ( i = 0; i < sentence_array.length; i++ )
    {
        words_in_sentences_array[i] = sentence_array[i].split( /\s/ );
    }

    //Make everything Lowercase and delete signs
    for ( i = 0; i < words_in_sentences_array.length; i++ )
    {
        for ( j = 0; j < words_in_sentences_array[i].length; j++ )
        {
            words_in_sentences_array[i][j] = words_in_sentences_array[i][j].toLowerCase();
            words_in_sentences_array[i][j] = words_in_sentences_array[i][j].replace( /[.!?;:,+0-9\-]/gm, "" ).replace( /\-/gm, " " );
        }
    }

    //All sentences
    for ( i = 0; i < words_in_sentences_array.length; i++ )
    {
        //All words in the sentence
        for ( j = 0; j < words_in_sentences_array[i].length; j++ )
        {
            //Check all Keywords
            for ( k = 0; k < keyWords.length; k++ )
            {
                //If the Word is one of the Keywords
                if ( keyWords[k].word === stemm2( words_in_sentences_array[i][j] ) )
                {
                    //Check Past Words nearby --> Past
                    if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, pastWords ) )
                    {
                        // Check Negate words nearby
                        if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, negateWords ) )
                        {
                            // Check Reinforcing words nearby
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight past negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_past_negate_reinforced, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight past negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_past_negate, keyWords[k].katName ) );
                            }
                        }
                        else
                        {
                            // Check Reinforcing words nearby
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight past NOT negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_past_reinforced, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight past NOT negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_past, keyWords[k].katName ) );
                            }
                        }
                    }
                    //No Past Word detected --> Present
                    else
                    {
                        // Check Negate words nearby
                        if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, negateWords ) )
                        {
                            // Check Reinforcing words nearby
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight present negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_present_negate_reinforced, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight present negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_present_negate, keyWords[k].katName ) );
                            }
                        }
                        else
                        {
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight present NOT negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_present_reinforced, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight present NOT negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * weight_present, keyWords[k].katName ) );
                            }
                        }
                    }
                }
                words_in_sentences_array[i][j];
            }
        }
    }

    for ( i = 0; i < final_Weight.length; i++ )
    {
        checking = 0;
        for ( j = 0; j < absolute_final_array.length; j++ )
        {
            if ( ( final_Weight[i].katID == absolute_final_array[j].katID ) && checking == 0 )
            {
                absolute_final_array[j].katName = final_Weight[i].katName;
                absolute_final_array[j].weight += final_Weight[i].weight;
                absolute_final_array[j].count++;

                checking = 1;
            }
        }
        if ( checking == 0 )
        {
            absolute_final_array.push( new Final_Weight( final_Weight[i].katID, final_Weight[i].weight, final_Weight[i].katName ) );
            absolute_final_array[absolute_final_array.length - 1].count++;
        }
    }

    for ( i = 0; i < absolute_final_array.length; i++ )
    {
        //MAGIC FORMULA                     Sum of category weight       /              highest possible value for this category
        absolute_final_array[i].weight = absolute_final_array[i].weight / ( absolute_final_array[i].count * weight_highest * weight_base );

        //////calculate a factor based on the assumed text length
        //So that a shorter text has higher rated values
        factor = basic_text_length / text_length;
        absolute_final_array[i].weight = absolute_final_array[i].weight * factor;

        ///ROUNDING THE RESULT
        absolute_final_array[i].weight = Math.round( absolute_final_array[i].weight * 10 ) / 10;

        //Cut the number
        if ( absolute_final_array[i].weight > 1 )
        {
            absolute_final_array[i].weight = 1;
        }
        else if ( absolute_final_array[i].weight < 0 )
        {
            absolute_final_array[i].weight = 0;
        }
    }

    console.timeEnd( 'test2' );
    return absolute_final_array;
}

$( "#02_btn" ).click( function ( event )
{
    doStuffWhenClicked();
}
);
$( "#berechnen2" ).click( function ( event )
{
    doStuffWhenClicked();
}
);
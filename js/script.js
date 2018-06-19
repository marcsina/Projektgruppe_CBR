// Global Array for Textanalysis
var final_Weight = new Array(); // all found keywords
var absolute_final_array = new Array(); // all available categories to which the weight of the individual keywords is added up
var highest_katID = 0;

var weight_base = 1;

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
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getKeywords.php", true );
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

    //save the highest KatID for later calculation

    highest_katID = array_zweite_Stufe[array_zweite_Stufe.length - 1][1];
    return array_keywords;
}

//split verbs into arrays from "pastHint"
function createKeywordsArray_Past()
{
    var i = 0;
    var string_keywords = $( "#pastHint" ).text();

    //String bei jedem ; splitten und in array packen
    var array_erste_Stufe = string_keywords.split( ';' );

    array_erste_Stufe.pop();

    return array_erste_Stufe;
}

//function to call when button is clicked
function doStuffWhenClicked()
{

    var i = 0;
    var j = 0;
    var k = 0;
    var z = 0;



    //get Keywords and Past words
    var keyWords = createKeywords();
    var pastWords = createKeywordsArray_Past();

    var negateWords = new Array( "nicht", "kein", "keine", "keinem", "keinen", "keiner", "keines", "nichts", "nie" );
    var reinforing_words = new Array( "absolut", "äußerst", "ausgesprochen", "besonders", "extrem", "heftig", "höchst", "sehr", "total", "überaus", "ungemein", "ungewöhnlich" );


    console.time( "test2" );

    var inputText = $( "#input-textarea" ).text();

    //WHAT TODO WHAT TODO

    //remove unnecessary whitespace and write everything in lower case
    inputText = inputText.trim();

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
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base * 2 * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight past negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base * 2, keyWords[k].katName ) );
                            }

                        }
                        else
                        {
                            // Check Reinforcing words nearby
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight past NOT negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight past NOT negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base, keyWords[k].katName ) );
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
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * 2 * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight present negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * 2, keyWords[k].katName ) );
                            }
                        }
                        else
                        {
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight present NOT negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight present NOT negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base, keyWords[k].katName ) );
                            }

                        }
                    }
                }
                words_in_sentences_array[i][j];
            }
        }


    }


    absolute_final_array.length = highest_katID;
    //Check all possible categories if Keywords were found in text
    for ( i = 0; i < absolute_final_array.length; i++ )
    {
        //create blank class
        absolute_final_array[i] = new Final_Weight( i, 0.0, "" );

        //Check all found Keywords
        for ( j = 0; j < final_Weight.length; j++ )
        {
            //if an katID exisist with a weight, add it up
            //put katName too
            if ( i === parseInt( final_Weight[j].katID ) )
            {
                absolute_final_array[i].katName = final_Weight[j].katName;
                absolute_final_array[i].weight += final_Weight[j].weight;
                absolute_final_array[i].count++;
            }
        }
    }

    for ( i = 0; i < absolute_final_array.length; i++ )
    {
        //MAGIC FORMULA
        absolute_final_array[i].weight = absolute_final_array[i].weight / ( absolute_final_array[i].count * 2 * 2 * weight_base );

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
    //SHOW STUFF
    var output = "";
    for ( i = 0; i < final_Weight.length; i++ )
    {
        output = output + "<br> \u00A0 \u00A0 " + i + " || " + "\u00A0 \u00A0 \u00A0      Weight:   " + final_Weight[i].weight + "\u00A0 \u00A0 \u00A0     KategorieID:   " + final_Weight[i].katID + "\u00A0 \u00A0 \u00A0   KategorieName:   " + final_Weight[i].katName;

    }
    output = output + "<br><br><br><br><br>";
    for ( i = 0; i < absolute_final_array.length; i++ )
    {
        if ( absolute_final_array[i].katName != "" )
        {
            output = output + "<br> \u00A0 \u00A0 " + i + " || " + "\u00A0 \u00A0 \u00A0      Weight:   " + absolute_final_array[i].weight + "\u00A0 \u00A0 \u00A0   KategorieName:   " + absolute_final_array[i].katName;
        }

    }
    $( "#output-textarea" ).html( output );


    //-------------------------Show detected Words in HTML------------------------------------------
    //split the Text
    var everyWordArray = $( "#input-textarea" ).text().split( /\s/ );

    var showEveryWord = "<b><font color='blue'>Keywords</font> / <font color='red'>Negierung</font> / <font color='green'>Vergangenheit</font></b> <br> <br>";
    var checked = 0;

    //Check every Word in the Text
    for ( i = 0; i < everyWordArray.length; i++ )
    {
        everyWordArray[i] = everyWordArray[i].replace( /[.!?;:,+0-9]/gm, "" ).replace( /\-/gm, " " );

        //Stemm the word 
        //variable so that it wont check twice and wont save the word twice
        checked = 0;

        //check every KeyWord
        for ( j = 0; j < keyWords.length; j++ )
        {
            //if word = keyword highlight it
            if ( stemm2( everyWordArray[i].toLowerCase() ) === keyWords[j].word && checked === 0 )
            {
                //make it bold and blue
                showEveryWord = showEveryWord + " " + "<b><font color='blue'>" + everyWordArray[i] + "</font></b>";

                checked = 1;
            }

        }

        //check every PastWord
        for ( z = 0; z < pastWords.length; z++ )
        {
            //if word = keyword highlight it
            if ( everyWordArray[i].toLowerCase() === pastWords[z] && checked === 0 )
            {
                //make it bold and blue
                showEveryWord = showEveryWord + " " + "<b><font color='green'>" + everyWordArray[i] + "</font></b>";

                checked = 1;
            }

        }

        //check every Negate Word
        for ( k = 0; k < negateWords.length; k++ )
        {
            //if word = keyword highlight it
            if ( everyWordArray[i].toLowerCase() === negateWords[k] && checked === 0 )
            {
                //make it bold and blue
                showEveryWord = showEveryWord + " " + "<b><font color='red'>" + everyWordArray[i] + "</font></b>";

                checked = 1;
            }

        }

        //if the word was not found in the array make it normal
        if ( checked === 0 )
        {
            //make it normal
            showEveryWord = showEveryWord + " " + everyWordArray[i];
        }

    }

    $( "#input-textarea" ).html( showEveryWord );
    //----------------------------------------------------------------------------------

    console.timeEnd( 'test2' );
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
    var reinforing_words = new Array( "absolut", "äußerst", "ausgesprochen", "besonders", "extrem", "heftig", "höchst", "sehr", "total", "überaus", "ungemein", "ungewöhnlich" );

    console.time( "test2" );

    //remove unnecessary whitespace and write everything in lower case
    inputText = inputText.trim();

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
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base * 2 * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight past negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base * 2, keyWords[k].katName ) );
                            }

                        }
                        else
                        {
                            // Check Reinforcing words nearby
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight past NOT negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight past NOT negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base, keyWords[k].katName ) );
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
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * 2 * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight present negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, weight_base * 2, keyWords[k].katName ) );
                            }
                        }
                        else
                        {
                            if ( checkWordsAroundGivenWord( words_in_sentences_array[i], j, reinforing_words ) )
                            {
                                //Todo Weight present NOT negate reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base * 2, keyWords[k].katName ) );
                            }
                            else
                            {
                                //Todo Weight present NOT negate NOT reinforced
                                final_Weight.push( new Final_Weight( keyWords[k].katID, -1 * weight_base, keyWords[k].katName ) );
                            }

                        }
                    }
                }
                words_in_sentences_array[i][j];
            }
        }


    }


    absolute_final_array.length = highest_katID;
    //Check all possible categories if Keywords were found in text
    for ( i = 0; i < absolute_final_array.length; i++ )
    {
        //create blank class
        absolute_final_array[i] = new Final_Weight( i + 1, 0.0, "" );

        //Check all found Keywords
        for ( j = 0; j < final_Weight.length; j++ )
        {
            //if an katID exisist with a weight, add it up
            //put katName too
            if ( i + 1 === parseInt( final_Weight[j].katID ) )
            {
                absolute_final_array[i].katName = final_Weight[j].katName;
                absolute_final_array[i].weight += final_Weight[j].weight;
                absolute_final_array[i].count++;
            }
        }
    }

    for ( i = 0; i < absolute_final_array.length; i++ )
    {
        //MAGIC FORMULA
        absolute_final_array[i].weight = absolute_final_array[i].weight / ( absolute_final_array[i].count * 2 * 2 * weight_base );

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

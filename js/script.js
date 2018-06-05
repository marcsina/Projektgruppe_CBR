// Global Array for Textanalysis
var final_weight_array;
var final_weight_array_TEST;


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

//Finale gewichtung für Olli
class Final_Weight
{
    constructor( katID, weight, katName )
    {
        this.weight = weight;
        this.katID = katID;
        this.katName = katName;
    }
}

class KeywordList
{
    constructor( word, katID , katName)
    {
        this.word = word;
        this.katID = katID;
        this.katName = katName;
    }
}

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

function isNegate( word )
{
    var array_negate_words = new Array( "nicht", "kein", "keine", "keinem", "keinen", "keiner", "keines", "nichts", "nie" );
    for ( var i = 0; i < array_negate_words.length; i++ )
    {
        if ( word === array_negate_words[i] )
            return true;

    }
    return false;

}

function isReinforcing( word )
{
    var array_reinforing_words = new Array( "absolut", "äußerst", "ausgesprochen", "besonders", "extrem", "heftig", "höchst", "sehr", "total", "überaus", "ungemein", "ungewöhnlich" );
    for ( var i = 0; i < array_reinforing_words.length; i++ )
    {
        if ( word === array_reinforing_words[i] )
            return true;

    }
    return false;
}

function negativeWeightDueToNegation( array, sentenceNumber )
{
    for ( var i = 0; i < array[sentenceNumber].length; i++ )
    {
        array[sentenceNumber][i].weight = -1;
    }
}

function positiveWeightDueToReinforcing( array, sentenceNumber )
{
    for ( var i = 0; i < array[sentenceNumber].length; i++ )
    {
        array[sentenceNumber][i].weight += 100;
    }
}

function reinforce_TEST( array, index_of_word, sentenceNumber, lastWord )
{
    if ( lastWord && index_of_word !== 0 )
    {
        array[sentenceNumber][index_of_word - 1].weight += 100;
        array[sentenceNumber][index_of_word].weight += 100;
    }
    else if ( index_of_word === 0 )
    {
        array[sentenceNumber][index_of_word].weight += 100;
        array[sentenceNumber][index_of_word + 1].weight += 100;
    }
    else
    {
        array[sentenceNumber][index_of_word - 1].weight += 100;
        array[sentenceNumber][index_of_word].weight += 100;
        array[sentenceNumber][index_of_word + 1].weight += 100;
    }
}

function negate_TEST( array, index_of_word, sentenceNumber, lastWord )
{
    if ( lastWord && index_of_word !== 0 )
    {
        array[sentenceNumber][index_of_word - 1].weight = -1;
        array[sentenceNumber][index_of_word].weight = -1;
    }
    else if ( index_of_word === 0 )
    {
        array[sentenceNumber][index_of_word].weight = -1;
        array[sentenceNumber][index_of_word + 1].weight = -1;
    }
    else
    {
        array[sentenceNumber][index_of_word - 1].weight = -1;
        array[sentenceNumber][index_of_word].weight = -1;
        array[sentenceNumber][index_of_word + 1].weight = -1;
    }
}

function createFinalKeywordsArray( array )
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
        array_keywords.push(new KeywordList(array_zweite_Stufe[i][0], array_zweite_Stufe[i][1], array_zweite_Stufe[i][2] ) );
    }


    var final_array = new Array();
    for ( i = 0; i < array.length; i++ )
    {
        for ( var j = 0; j < array[i].length; j++ )
        {
            for ( var k = 0; k < array_keywords.length; k++ )
            {
                if ( array[i][j].word.toLowerCase() === array_keywords[k].word.toLowerCase() )
                {

                    final_array.push(new Weighted_Words(array[i][j].word, array[i][j].weight, array_keywords[k].katID, array_keywords[k].katName ) );
                }
            }
        }
    }
    return final_array;
}

$( document ).ready( function ()
{
    getKeywordsFromDatabase( "cbr" );
} );

$( "#berechnen" ).click( function ()
{
    var i = 0;
    var j = 0;
    //TODO DELETE IN FINAL
    console.time( 'test' );

    //get text from textarea
    var inputText = $( "#input-textarea" ).text();

    //remove unnecessary whitespace and write everything in lower case
    inputText = inputText.trim();

    //Delete abbrevations consist of maximum 1 letters, multiple whitespaces, and new lines starting with a space
    inputText = inputText.replace( /[\s][a-zA-Z]{0,1}[.]/gm, "" ).replace( /[\s]{2,}/gmi, "\s" ).replace( /\n /gmi, "\n" ).replace( /[0-9]/, "\s" );

    //Remove stopwords
    inputText = inputText.removeStopWords();

    //Split text in sentences
    var sentence_array = inputText.replace( /([.!?;])\s*(?=[a-zA-Z])/gm, "$1|" ).split( "|" );

    //split sentences in stemmed words add standrad weight 0 ... twodimensional arrays
    //Array [sentence][word, weight, katID]
    var words_in_sentences_with_weight_array = new Array( sentence_array.length );
    var words_in_sentences_with_weight_array_TEST = new Array( sentence_array.length );

    for ( i = 0; i < words_in_sentences_with_weight_array.length; i++ )
    {
        var isNegated = false;
        var isReinforced = false;

        var isNegated_TEST = 0;
        var isReinforced_TEST = 0;

        words_in_sentences_with_weight_array[i] = sentence_array[i].split( /\s/ );
        words_in_sentences_with_weight_array_TEST[i] = sentence_array[i].split( /\s/ );
        for ( j = 0; j < words_in_sentences_with_weight_array[i].length; j++ )
        {
            words_in_sentences_with_weight_array[i][j] = new Weighted_Words( stemm2( words_in_sentences_with_weight_array[i][j] ), 0, 0 ,0 );
            words_in_sentences_with_weight_array_TEST[i][j] = new Weighted_Words( words_in_sentences_with_weight_array[i][j].word, 0, 0, 0 );

            if ( isReinforcing( words_in_sentences_with_weight_array[i][j].word ) )
            {
                isReinforced = true;
                isReinforced_TEST = j;
                //letztes Wort im Satz verstärkt
                if ( isReinforced_TEST === words_in_sentences_with_weight_array.length )
                {
                    reinforce_TEST( words_in_sentences_with_weight_array_TEST, isReinforced_TEST, i, true );
                }
                //vorheriges Wort verstärkt
                else if ( isReinforced_TEST + 1 === j )
                {
                    reinforce_TEST( words_in_sentences_with_weight_array_TEST, isReinforced_TEST, i, false );
                }
            }
            if ( isNegate( words_in_sentences_with_weight_array[i][j].word ) )
            {
                isNegated = true;
                isNegated_TEST = j;
                //letztes Wort im Satz negiert
                if ( isNegated_TEST === words_in_sentences_with_weight_array.length )
                {
                    negate_TEST( words_in_sentences_with_weight_array_TEST, isNegated_TEST, i, true );
                }
                //vorheriges Wort negiert
                else if ( isNegated_TEST + 1 === j )
                {
                    negate_TEST( words_in_sentences_with_weight_array_TEST, isNegated_TEST, i, false );
                }
            }
        }
        if ( isNegated )
        {
            negativeWeightDueToNegation( words_in_sentences_with_weight_array, i );
        }
        else if ( isReinforced )
        {
            positiveWeightDueToReinforcing( words_in_sentences_with_weight_array, i );
        }  
    }

    //delete words from array, if they are not keywords used by CBR
    var final_array = createFinalKeywordsArray( words_in_sentences_with_weight_array );
    var final_array_TEST = createFinalKeywordsArray( words_in_sentences_with_weight_array_TEST );
    
                            //---------------DELETE IN FINAL---------------------
                            var arrayOutputWords = new Array();
                            for ( i = 0; i < final_array.length; i++ )
                            {
                                arrayOutputWords.push( final_array[i].word );

                            }

    //Count duplicates and save into
    final_weight_array = new Array();

    ////ADD Final Weight to categories
    ////
    //Check each word
    for ( j = 0; j < final_array.length; j++ )
    {
        //Check if word was a duplicate of a word before
        if ( final_array[j].word !== 'xXx' )
        {
            //If not compare each kat id and count them
            var count = 0;
            for ( i = 0; i < final_array.length; i++ )
            {

                if ( final_array[j].katID === final_array[i].katID )
                {
                    //if weight is 100 which means a super word then count + 2 
                    //
                    if ( final_array[i].weight >= 100 )
                    {

                        count = count + 25 * ( final_array[i].weight / 100 );

                    }
                    ///every other case, beside -1
                    else if ( final_array[i].weight !== -1 )
                    {

                        count = count + 10;

                    }
                    //-1 case
                    else
                    {

                        count = count - 10;

                    }
                    //set the word to xxx so that it wont be checked again
                    final_array[i].word = 'xXx';
                }

            }
            //Check if the count ist > 1 or < 0
            if ( 0 < count && count < 100 )
            {
                count = count / 100;
            }
            else if ( count >= 100 )
            {
                count = 1;
            }
            else
            {
                count = 0;
            }

            //put the katID and count in the final weight array
            final_weight_array.push(new Final_Weight(final_array[j].katID, count, final_array[j].katName ) );
        }


    }


    final_weight_array_TEST = new Array();

    ////ADD Final Weight to categories
    ////
    //Check each word
    for ( j = 0; j < final_array_TEST.length; j++ )
    {
        //Check if word was a duplicate of a word before
        if ( final_array_TEST[j].word !== 'xXx' )
        {
            //If not compare each kat id and count them
            var count = 0;
            for ( i = 0; i < final_array_TEST.length; i++ )
            {

                if ( final_array_TEST[j].katID === final_array_TEST[i].katID )
                {
                    //if weight is 100 which means a super word then count + 2 
                    //
                    if ( final_array_TEST[i].weight >= 100 )
                    {

                        count = count + 25 * ( final_array_TEST[i].weight / 100 );

                    }
                    ///every other case, beside -1
                    else if ( final_array_TEST[i].weight !== -1 )
                    {

                        count = count + 10;

                    }
                    //-1 case
                    else
                    {

                        count = count - 10;

                    }
                    //set the word to xxx so that it wont be checked again
                    final_array_TEST[i].word = 'xXx';
                }

            }
            //Check if the count ist > 1 or < 0
            if ( 0 < count && count < 100 )
            {
                count = count / 100;
            }
            else if ( count >= 100 )
            {
                count = 1;
            }
            else
            {
                count = 0;
            }

            //put the katID and count in the final weight array
            final_weight_array_TEST.push(new Final_Weight(final_array_TEST[j].katID, count, final_array_TEST[j].katName ) );
        }


    }

    ////////////////////////////////////////////////////////
    ///////TESTAUSGABE
    var output = "<font color='blue'>Keywords</font> / <font color='red'>Negierung</font> / <font color='green'>Positiv</font> <br> <br> Nergierung im kompletten Satz: <br>";
    var txtOutputWords = "";


    for ( i = 0; i < final_weight_array.length; i++ )
    {
        output = output + "<br> \u00A0 \u00A0 " + i + " || " + "\u00A0 \u00A0 \u00A0      Weight:   " + final_weight_array[i].weight + "\u00A0 \u00A0 \u00A0     KategorieID:   " + final_weight_array[i].katID + "\u00A0 \u00A0 \u00A0   KategorieName:   " + final_weight_array[i].katName;

    }
    output = output + "<br><br><br><br><br> Negierung nur 1 Wort entfernt: <br>";
    for ( i = 0; i < final_weight_array_TEST.length; i++ )
    {
        output = output + "<br> \u00A0 \u00A0 " + i + " || " + "\u00A0 \u00A0 \u00A0      Weight:   " + final_weight_array_TEST[i].weight + "\u00A0 \u00A0 \u00A0 KategorieID:   " + final_weight_array_TEST[i].katID + "\u00A0 \u00A0 \u00A0 KategorieName:   " + final_weight_array[i].katName;

    }


    for ( i = 0; i < arrayOutputWords.length; i++ )
    {
        txtOutputWords = txtOutputWords + "<br>" + arrayOutputWords[i];

    }


                                //TODO DELETE IN FINAL
                                $( "#output-textarea" ).html( output );
                                $( "#txtKeywords" ).html( txtOutputWords );

    
                                //-------------------------Show detected Words in Red in HTML------------------------------------------
                                //split the Text
                                var everyWordArray = $( "#input-textarea" ).text().split( ' ' );

                                var showEveryWord = "";
                                var stemmedWord = "";
                                var checked = 0;

                                //Check every Word in the Text
                                for ( i = 0; i < everyWordArray.length; i++ )
                                {
                                    //Stemm the word 
                                    stemmedWord = stemm2( everyWordArray[i] );
                                    //variable so that it wont check twice and wont save the word twice
                                    checked = 0;

                                    //check every found KeyWord
                                    for ( j = 0; j < arrayOutputWords.length; j++ )
                                    {
                                        //if the stemmed version is like the word than save
                                        if ( stemmedWord === arrayOutputWords[j] && checked === 0 )
                                        {
                                            //make it bold and red
                                            showEveryWord = showEveryWord + " " + "<b><font color='blue'>" + everyWordArray[i] + "</font></b>";
                                            checked = 1;
                                        }
                                      
                                    }
                                    //if the word was not found in the KeyWord array than check for negate refactoring
                                    if ( checked === 0 )
                                    {
                                        if (isNegate(stemmedWord)) 
                                        {
                                            //make it bold and red
                                            showEveryWord = showEveryWord + " " + "<b><font color='red'>" + everyWordArray[i] + "</font></b>";
                                        }
                                        else if (isReinforcing(stemmedWord))
                                        {
                                            //make it bold and green
                                            showEveryWord = showEveryWord + " " + "<b><font color='green'>" + everyWordArray[i] + "</font></b>";
                                        }
                                        else
                                        {
                                            //make it normal
                                            showEveryWord = showEveryWord + " " + everyWordArray[i];
                                        }

                                        

                                    }

                                }

                                $( "#input-textarea" ).html( showEveryWord );
    //----------------------------------------------------------------------------------
    
    //TODO DELETE IN FINAL
    console.timeEnd( 'test' );
} );
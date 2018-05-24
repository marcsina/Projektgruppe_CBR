class Weighted_Words
{
    constructor( word, weight, katID )
    {
        this.word = word;
        this.weight = weight;
        this.katID = katID;
    }
}

//Finale gewichtung für Olli
class Final_Weight
{
    constructor(katID, weight )
    {
        this.weight = weight;
        this.katID = katID;
    }
}

class KeywordList
{
    constructor( word, katID )
    {
        this.word = word;
        this.katID = katID;
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
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/getKeywords.php", true );
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
        array[sentenceNumber][i].weight = 100;
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
        array_keywords.push( new KeywordList( array_zweite_Stufe[i][0], array_zweite_Stufe[i][1] ) );
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

                    final_array.push( new Weighted_Words( array[i][j].word, array[i][j].weight, array_keywords[k].katID ) );
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
    inputText = inputText.replace( /[\s][a-zA-Z]{0,1}[.]/gm, "" ).replace( /[ ]{2,}/gmi, " " ).replace( /\n /gmi, "\n" ).replace(/[0-9]/," ");

    //Remove stopwords
    inputText = inputText.removeStopWords();

    //Split text in sentences
    var sentence_array = inputText.replace( /([.!?;])\s*(?=[a-zA-Z])/gm, "$1|" ).split( "|" );

    //split sentences in stemmed words add standrad weight 0 ... twodimensional arrays
    //Array [sentence][word, weight, katID]
    var words_in_sentences_with_weight_array = new Array( sentence_array.length );
    for ( i = 0; i < words_in_sentences_with_weight_array.length; i++ )
    {
        words_in_sentences_with_weight_array[i] = sentence_array[i].split( /\s/ );
        for ( j = 0; j < words_in_sentences_with_weight_array[i].length; j++ )
        {
            words_in_sentences_with_weight_array[i][j] = new Weighted_Words( stemm2( words_in_sentences_with_weight_array[i][j] ), 0, 0 );
        }
    }

    //negate whole sentence if sentence is negated
    for ( i = 0; i < words_in_sentences_with_weight_array.length; i++ )
    {

        for ( j = 0; j < words_in_sentences_with_weight_array[i].length; j++ )
        {
            if ( isReinforcing( words_in_sentences_with_weight_array[i][j].word ) )
            {
                positiveWeightDueToReinforcing( words_in_sentences_with_weight_array, i );
            }
            if ( isNegate( words_in_sentences_with_weight_array[i][j].word ) )
            {
                negativeWeightDueToNegation( words_in_sentences_with_weight_array, i );
            }
        }
    }

    //delete words from array, if they are not keywords used by CBR
    var final_array = createFinalKeywordsArray( words_in_sentences_with_weight_array );

    //Count duplicates and save into
    var final_weight_array = new Array();

    //Check each word
    for ( j = 0; j < final_array.length; j++ )
    {
        //Check if word was a duplicate of a word before
        if(final_array[j].word != 'xXx')
        {
            //If not compare each kat id and count them
            var count = 0;
            for ( i = 0; i < final_array.length; i++ )
            {

                if(final_array[j].katID === final_array[i].katID )
                {
                    count++;
                    final_array[i].word = 'xXx';
                }

            }

            final_weight_array.push( new Final_Weight(final_array[j].katID, count));
        }


    }

    //alert(final_weight_array[1].weight);

    ////////////////////////////////////////////////////////
    ///////TESTAUSGABE
    var output = "";
    for ( i = 0; i < final_weight_array.length; i++ )
    {
        output = output + "<br>" + i + " || " + "____________Count:   " +  final_weight_array[i].weight + "__________Kategorie:   " + final_weight_array[i].katID;

    }

    //TODO DELETE IN FINAL
    $( "#output-textarea" ).html( output );

    //TODO DELETE IN FINAL
    console.timeEnd( 'test' );
} );